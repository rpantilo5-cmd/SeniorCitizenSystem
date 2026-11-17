<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800 tracking-wide uppercase">Create Account</h2>
        <p class="text-sm text-slate-500 mt-1">Register for System Access</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-slate-300 text-slate-700 focus:border-slate-800 focus:ring-slate-800 text-sm py-2.5 shadow-sm" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-slate-300 text-slate-700 focus:border-slate-800 focus:ring-slate-800 text-sm py-2.5 shadow-sm" required />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <p class="text-xs text-slate-500">New accounts receive resident access. Administrator access is assigned separately.</p>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Password</label>
            <input id="password" type="password" name="password" class="w-full rounded-lg border-slate-300 text-slate-700 focus:border-slate-800 focus:ring-slate-800 text-sm py-2.5 shadow-sm" required />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="w-full rounded-lg border-slate-300 text-slate-700 focus:border-slate-800 focus:ring-slate-800 text-sm py-2.5 shadow-sm" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition duration-150">
                Register Account
            </button>
        </div>

        <!-- Back to Login Link -->
        <div class="text-center pt-3 border-t border-slate-100">
            <p class="text-xs text-slate-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-slate-900 hover:underline">
                    Log in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>