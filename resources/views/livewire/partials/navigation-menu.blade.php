<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-4 sm:flex">
                    <x-navbars.nav-link wire:navigate href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Welcome') }}
                    </x-navbars.nav-link>
                </div>
            </div>

            <div class="hidden space-x-4 sm:flex sm:items-center sm:ml-6">
                @hasuser
                    <!-- Options Dropdown -->
                    <div class="relative ml-3">
                        <x-menus.dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <x-buttons.invisible class="inline-flex">
                                        {{ session('user.name') }}

                                        <x-icons icon='chevron-down' class="ml-1" />
                                    </x-buttons.invisible>
                                </span>
                            </x-slot>


                            <x-slot name="content">
                                <!-- Authentication -->
                                <x-menus.dropdown-link class="cursor-pointer" wire:click="logout">
                                    {{ __('Log Out') }}
                                </x-menus.dropdown-link>
                            </x-slot>
                        </x-menus.dropdown>
                    </div>
                @else
                    <x-buttons.invisible-link class="inline-flex" wire:navigate href="{{ route('login') }}">
                        Log in
                        <x-icons class="ml-2" icon="log-in" />
                    </x-buttons.invisible-link>
                @endhasuser
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-navbars.responsive-nav-link wire:navigate href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Welcome') }}
            </x-navbars.responsive-nav-link>
        </div>

        <!-- Responsive Options Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @hasuser
                <div class="flex items-center justify-between px-4">
                    <div>
                        <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ session('user.name') }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">{{ session('user.email') }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <x-navbars.responsive-nav-link wire:click="logout">
                        {{ __('Log Out') }}
                    </x-navbars.responsive-nav-link>
                </div>
            @else
                <div class="space-y-1">
                    <x-navbars.responsive-nav-link wire:navigate href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-navbars.responsive-nav-link>
                </div>
            @endhasuser
        </div>
    </div>
</nav>
