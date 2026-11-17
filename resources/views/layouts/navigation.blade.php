<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-700 to-blue-600 border-b border-blue-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-6">
                <!-- Brand Badge -->
                <a href="{{ Auth::user()->role === 'resident' ? route('resident.dashboard') : route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white font-extrabold text-base tracking-wide block leading-tight">OSCA PORTAL</span>
                        <span class="text-blue-200 text-[10px] uppercase font-medium tracking-wider">Barangay Anomar</span>
                    </div>
                </a>

                <!-- Navigation Links for Destinations -->
                @if (in_array(Auth::user()->role, ['admin', 'super_admin'], true))
                    <div class="hidden space-x-2 sm:flex items-center">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 text-xs font-bold uppercase rounded-lg text-white hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-white/20 border border-white/20' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('seniors.index') }}" class="px-3 py-2 text-xs font-bold uppercase rounded-lg text-white hover:bg-white/10 {{ request()->routeIs('seniors.*') ? 'bg-white/20 border border-white/20' : '' }}">
                            Seniors
                        </a>
                        <a href="{{ route('assistance.index') }}" class="px-3 py-2 text-xs font-bold uppercase rounded-lg text-white hover:bg-white/10 {{ request()->routeIs('assistance.*') ? 'bg-white/20 border border-white/20' : '' }}">
                            Assistance Requests
                        </a>
                        <a href="{{ route('benefits.index') }}" class="px-3 py-2 text-xs font-bold uppercase rounded-lg text-white hover:bg-white/10 {{ request()->routeIs('benefits.*') ? 'bg-white/20 border border-white/20' : '' }}">
                            Benefit Releases
                        </a>
                    </div>
                @else
                    <div class="hidden space-x-2 sm:flex items-center">
                        <a href="{{ route('resident.dashboard') }}" class="px-3 py-2 text-xs font-bold uppercase rounded-lg text-white hover:bg-white/10 {{ request()->routeIs('resident.dashboard') ? 'bg-white/20 border border-white/20' : '' }}">
                            My Portal
                        </a>
                        <a href="{{ route('resident.profile.edit') }}" class="px-3 py-2 text-xs font-bold uppercase rounded-lg text-white hover:bg-white/10 {{ request()->routeIs('resident.profile.*') ? 'bg-white/20 border border-white/20' : '' }}">
                            My Profile
                        </a>
                    </div>
                @endif
            </div>

            <!-- User Menu Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-white/20 text-xs font-semibold rounded-lg text-white bg-blue-800/40 hover:bg-blue-800/80 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="Auth::user()->role === 'resident' ? route('resident.profile.edit') : route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>