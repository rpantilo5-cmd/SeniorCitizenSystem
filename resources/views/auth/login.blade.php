<x-guest-layout>
    <!-- Main Floating Card Container -->
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row relative min-h-[580px]">
        
        <!-- LEFT SIDE: Curved Blue Banner with Old Image & Circle Accent -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-700 to-blue-500 text-white p-10 flex flex-col justify-between relative overflow-hidden rounded-r-[80px] md:rounded-r-[140px] z-10 shadow-xl">
            
            <!-- Overlay Image (Lumang Senior Picture Background) -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1581579438747-1dc8d1e2726f?q=80&w=1200&auto=format&fit=crop');"></div>

            <!-- Content -->
            <div class="relative z-20 my-auto">
                <!-- Circular Logo Badge -->
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mb-6 border border-white/30 shadow-inner">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>

                <h1 class="text-4xl font-extrabold tracking-wide uppercase mb-2">WELCOME</h1>
                <p class="text-xl font-medium text-blue-100">Integrated Senior Citizen System</p>
                <p class="text-sm text-blue-200 mt-3 leading-relaxed">
                    Assistance & Benefits Monitoring Portal<br>
                    <span class="text-xs font-semibold uppercase tracking-wider text-blue-300">Barangay Anomar Coverage Area</span>
                </p>
            </div>

            <!-- Decorative Floating Blue Circle inside Banner -->
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-600/40 rounded-full blur-sm"></div>
        </div>

        <!-- RIGHT SIDE: Form Section -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white z-0">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Sign in</h2>
                <p class="text-xs text-slate-400 mt-1">Please enter your account details below</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="role" class="block text-xs font-semibold text-slate-500 uppercase mb-1">Log in as:</label>
                    <select id="role" name="role" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-blue-500 text-sm py-3 shadow-sm transition" required>
                        <option value="admin">Admin</option>
                        <option value="resident">Resident</option>
                    </select>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-500 uppercase mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="user@gmail.com" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-blue-500 text-sm py-3 shadow-sm transition" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-500 uppercase mb-1">Password</label>
                    <input id="password" type="password" name="password" placeholder="••••••••" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-blue-500 text-sm py-3 shadow-sm transition" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-xs text-slate-500">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-xs text-blue-600 hover:text-blue-800 font-semibold transition" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Log In Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-4 bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg hover:shadow-blue-900/30 transition duration-200">
                        Sign in
                    </button>
                </div>

                <!-- Create Account Link -->
                <div class="text-center pt-4">
                    <p class="text-xs text-slate-500">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline">
                            Create an account
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Decorative Bottom Right Curved Blue Shape -->
        <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-blue-500 rounded-full z-0 opacity-80 pointer-events-none"></div>
    </div>
</x-guest-layout>