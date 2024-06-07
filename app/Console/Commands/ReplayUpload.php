<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Native\Laravel\Facades\Notification;

class ReplayUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'replay:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finds and uploads newest replay.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO: Try to locate the replay folder and if it fails ask user to point to it.
        $bearerToken = Cache::get('bearer_token', false);

        if (! $bearerToken) {
            $this->error('Failed to find token.');

            return false;
        }

        $disk = Storage::disk('documents');
        $filePath = implode(DIRECTORY_SEPARATOR, ['Command and Conquer Generals Zero Hour Data', 'Replays', '00000000.rep']);

        if (! $disk->fileExists($filePath)) {
            $this->error('Failed to find file.');

            return false;
        }

        // If first time only save time
        if (! Cache::has('replay_file')) {
            $lastModifiedTime = $disk->lastModified($filePath);
            Cache::put('replay_file', $lastModifiedTime);

            $this->info('First time, no replay_file cache.');

            return false;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Cache::get('bearer_token'),
            'Accept' => 'application/json',
        ])->timeout(3)->get(config('api.url').'/api/me');

        if (! $response->successful()) {
            $this->error('Failed to use token.');

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
            ])->attach('replay', $disk->get($filePath), $filePath)
                ->post(config('api.url').'/api/replay');

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
