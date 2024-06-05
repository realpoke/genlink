<div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
    <div class="max-w-2xl mx-auto text-center">
        <h2 wire:poll.3s="loadingCheck" class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Loading...
        </h2>
        <p class="max-w-xl mx-auto mt-6 text-lg leading-8 text-gray-600">Checking connection to server</p>
        <div class="flex items-center justify-center mt-10 gap-x-6">
            <a target="_blank" href="{{ config('api.url') . '/up' }}"
                class="text-sm font-semibold leading-6 text-gray-900">Cheack
                health <span aria-hidden="true">→</span></a>
        </div>
    </div>
</div>
