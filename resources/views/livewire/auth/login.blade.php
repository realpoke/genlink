<div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">Sign in to your account
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form wire:submit="login" class="space-y-4 md:space-y-6">
            <div>
                <x-inputs.label for="form.email">Your email</x-inputs.label>
                <x-inputs.text wire:model="form.email" name="form.email" id="form.email" autofocus />
                <x-inputs.error for="form.email" />
            </div>

            <div>
                <x-inputs.label for="form.password">Password</x-inputs.label>
                <x-inputs.text wire:model="form.password" type="password" name="form.password" id="form.password" />
                <x-inputs.error for="form.password" />
            </div>

            <div>
                <x-buttons.main class="w-full">Sign in</x-buttons.main>
            </div>
        </form>
    </div>
</div>
