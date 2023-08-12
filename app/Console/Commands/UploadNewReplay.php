<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Native\Laravel\Facades\Notification;

class UploadNewReplay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:replay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uploads the latests replay file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO: Make action
        $this->info('Running replay uploader.');
        // TODO: Try to locate the replay folder and if it fails ask user to point to it.
        $disk = Storage::disk('documents');
        $bearerToken = Cache::get('bearer_token', false);
        $filePath = implode(DIRECTORY_SEPARATOR, ['Command and Conquer Generals Zero Hour Data', 'Replays', '00000000.rep']);

        if (! $bearerToken || ! $disk->fileExists($filePath)) {
            $this->info('Failed to find file or token.');

            return false;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Cache::get('bearer_token'),
            'Accept' => 'application/json',
        ])->timeout(3)->get(config('api.url').'/me');

        if (! $response->successful()) {
            $this->info('Failed to use token.');

            return false;
        }

        $lastModifiedTime = $disk->lastModified($filePath);
        $previousLastModifiedTime = Cache::get('replay_file', false);
        Cache::put('replay_file', $lastModifiedTime);

        if ($previousLastModifiedTime != false && $lastModifiedTime !== $previousLastModifiedTime) {
            $this->info('Uploading file.');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$bearerToken,
                'Accept' => 'application/json',
            ])->attach('file', $disk->get($filePath), $filePath)
                ->post(config('api.url').'/upload/game');

            $this->info('Upload response: '.$response->json('message'));

            // TODO: Logout if we fail to upload.
            if ($response->successful()) {
                Notification::title('Upload')
                    ->message($response->json('message'))
                    ->show();
            } else {
                Notification::title('Upload failed!')
                    ->message($response->json('message'))
                    ->show();
            }

            return true;
        }
        $this->info('File is not new.');

        return false;
    }
}
