<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    {{-- @role('admin') --}}
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    <flux:navlist.item icon="users" :href="route('admin.users.index')" :current="request()->routeIs('admin.users.*')" wire:navigate>{{ __('Users') }}</flux:navlist.item>
                    <flux:navlist.item icon="shield-check" :href="route('admin.roles.index')" :current="request()->routeIs('admin.roles.*')" wire:navigate>{{ __('Roles') }}</flux:navlist.item>
                    <flux:navlist.item icon="key" :href="route('admin.permissions.index')" :current="request()->routeIs('admin.permissions.*')" wire:navigate>{{ __('Permissions') }}</flux:navlist.item>
                    <flux:navlist.item icon="cube" :href="route('admin.kiosks.index')" :current="request()->routeIs('admin.kiosks.*')" wire:navigate>Kiosks</flux:navlist.item>
                    <flux:navlist.item icon="bell" :href="route('admin.notification-logs.index')" :current="request()->routeIs('admin.notification-logs.*')" wire:navigate>{{ __('Notification Logs') }}</flux:navlist.item>
                    
                    {{-- @endrole --}}
                    

                    <div class="col-span-full mt-4 mb-2 px-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                        {{ __('API') }}
                    </div>
                    <flux:navlist.item icon="building-storefront" :href="route('admin.restaurants.index')" :current="request()->routeIs('admin.restaurants.*')" wire:navigate>{{ __('Restaurants') }}</flux:navlist.item>
                    <flux:navlist.item icon="calendar-days" :href="route('admin.reservations.list')" :current="request()->routeIs('admin.reservations.*')" wire:navigate>რეზერვაციები</flux:navlist.item>
                    {{-- <flux:navlist.item icon="table-cells-large" :href="route('admin.tables.index')" :current="request()->routeIs('admin.tables.*')" wire:navigate>{{ __('Tables') }}</flux:navlist.item>
                     --}}
          
                    <flux:navlist.item icon="globe-alt" :href="route('admin.cuisines.index')" :current="request()->routeIs('admin.cuisines.*')" wire:navigate>{{ __('Cuisines') }}</flux:navlist.item>
                    <flux:navlist.item icon="cake" :href="route('admin.dishes.index')" :current="request()->routeIs('admin.dishes.*')" wire:navigate>{{ __('Dishes') }}</flux:navlist.item>
                    <flux:navlist.item icon="map-pin" :href="route('admin.spots.index')" :current="request()->routeIs('admin.spots.*')" wire:navigate>{{ __('Spots') }}</flux:navlist.item>
                    <flux:navlist.item icon="building-office" :href="route('admin.spaces.index')" :current="request()->routeIs('admin.spaces.*')" wire:navigate>{{ __('Spaces') }}</flux:navlist.item>
                    <flux:navlist.item icon="building-storefront" :href="route('admin.cities.index')" :current="request()->routeIs('admin.cities.*')" wire:navigate>{{ __('Cities') }}</flux:navlist.item>

                </flux:navlist.group>

                <flux:navlist.group :heading="__('Monitoring & Analytics')" class="grid">
                    <flux:navlist.item icon="chart-bar" :href="route('admin.monitoring.dashboard')" :current="request()->routeIs('admin.monitoring.*')" wire:navigate>
                        <span class="flex items-center">
                            🔥 Real-time Monitoring
                            <span class="ml-2 inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 animate-pulse">Live</span>
                        </span>
                    </flux:navlist.item>
                    <flux:navlist.item icon="queue-list" :href="route('admin.queue.dashboard')" :current="request()->routeIs('admin.queue.*')" wire:navigate>
                        <span class="flex items-center">
                            📊 Queue Dashboard
                            @if(isset($queueStats) && $queueStats['failed'] > 0)
                                <span class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">{{ $queueStats['failed'] }}</span>
                            @endif
                        </span>
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        @stack('scripts')
    </body>
</html>