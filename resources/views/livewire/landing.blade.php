<div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
    <div class="max-w-2xl mx-auto text-center">
        @hasuser
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Hi {{ session('user.name') }}!</h2>
            <p class="max-w-xl mx-auto mt-6 text-lg leading-8 text-gray-600">Your replay files are being watched!</p>
        @else
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Welcome!</h2>
            <p class="max-w-xl mx-auto mt-6 text-lg leading-8 text-gray-600">Login to start watching files!</p>
        @endhasuser
    </div>
</div>
