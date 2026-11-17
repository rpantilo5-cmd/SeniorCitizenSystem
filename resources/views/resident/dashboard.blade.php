<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-sm font-bold uppercase tracking-wider text-blue-700">Resident Portal</p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-800">
                    Welcome, {{ Auth::user()->name }}
                </h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600">
                    Manage your account information here. Administrative senior, assistance, and benefit records are not available through resident access.
                </p>
                <a href="{{ route('resident.profile.edit') }}" class="mt-6 inline-flex rounded-xl bg-blue-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-800">
                    View and update my profile
                </a>
            </section>
        </div>
    </div>
</x-app-layout>
