<x-layouts.container>
    <x-sections.card>
        <h1 wire:poll.3s="loadingCheck" class="text-4xl">Loading...</h1>
        <p>Trying to reach our API!</p>
    </x-sections.card>
</x-layouts.container>
