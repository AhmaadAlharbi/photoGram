<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home_page') }}">
                        <x-application-logo class="w-32 h-auto block fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:-my-px sm:ms-10">
                    <div class="hidden md:flex md:flex-row space-x-3 items-center justify-center">
                        <x-nav-link :href="route('home_page')" :active="request()->routeIs('home_page')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                @auth
                <div class="flex items-center space-x-3">
                    {{-- Home --}}
                    <a class="text-[1.6rem] rtl:ml-3" href="{{ route('home_page') }}">
                        {!! url()->current() == route('home_page') ? '<i class="bx bxs-home-alt-2"></i>' : '<i
                            class="bx bx-home-alt-2"></i>' !!}
                    </a>

                    {{-- Explore --}}
                    <a class="text-[1.6rem]" href="{{ route('explore') }}">
                        {!! url()->current() == route('explore') ? '<i class="bx bxs-compass"></i>' : '<i
                            class="bx bx-compass"></i>' !!}
                    </a>

                    {{-- Create Post --}}
                    <button onclick="Livewire.emit('openModal', 'create-post-modal')">
                        <i class="bx bx-message-square-add text-[1.6rem]"></i>
                    </button>
                </div>
                @endauth

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <img src="{{ auth()->user()->image }}" alt="" class="w-6 h-6 rounded-full">
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>


        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home_page')" :active="request()->routeIs('home_page')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>