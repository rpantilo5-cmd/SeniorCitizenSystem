<x-app-layout>
    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Page Header -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Senior Citizen Benefits & Assistance Dashboard</h2>
                    <p class="text-sm text-slate-500 mt-2 font-medium">Real-time overview and quick monitoring for Barangay Anomar</p>
                </div>
                <div class="inline-flex items-center gap-3 bg-blue-50 border border-blue-200 px-4 py-2 rounded-2xl">
                    <span class="w-3 h-3 bg-blue-600 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold text-blue-900 uppercase tracking-wider">System Active</span>
                </div>
            </div>

            <!-- Enhanced & Larger Metric Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Total Seniors Card -->
                <a href="{{ route('seniors.index') }}" class="group bg-white p-8 rounded-3xl shadow-sm border border-slate-200/80 border-l-8 border-l-blue-600 hover:shadow-xl hover:-translate-y-1 transition duration-200 relative overflow-hidden block">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Seniors</span>
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-5xl font-black text-slate-800 mt-4 tracking-tight">{{ $totalSeniors ?? count($seniors ?? []) }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="inline-block text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-xl">Registered in System</span>
                        <span class="text-xs text-slate-400 group-hover:text-blue-600 font-bold transition">View All &rarr;</span>
                    </div>
                </a>

                <!-- Pending Requests Card -->
                <a href="{{ route('assistance.index') }}" class="group bg-white p-8 rounded-3xl shadow-sm border border-slate-200/80 border-l-8 border-l-amber-500 hover:shadow-xl hover:-translate-y-1 transition duration-200 relative overflow-hidden block">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending Requests</span>
                        <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-5xl font-black text-slate-800 mt-4 tracking-tight">{{ $pendingRequests ?? 0 }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="inline-block text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-xl">Awaiting Verification</span>
                        <span class="text-xs text-slate-400 group-hover:text-amber-600 font-bold transition">View Requests &rarr;</span>
                    </div>
                </a>

                <!-- Benefits Distributed Card -->
                <a href="{{ route('benefits.index') }}" class="group bg-white p-8 rounded-3xl shadow-sm border border-slate-200/80 border-l-8 border-l-emerald-500 hover:shadow-xl hover:-translate-y-1 transition duration-200 relative overflow-hidden block">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Benefits Distributed</span>
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-5xl font-black text-slate-800 mt-4 tracking-tight">{{ $benefitsDistributed ?? 0 }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="inline-block text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-xl">Processed Batches</span>
                        <span class="text-xs text-slate-400 group-hover:text-emerald-600 font-bold transition">View Logs &rarr;</span>
                    </div>
                </a>

                <!-- Active Coverage Card -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200/80 border-l-8 border-l-indigo-600 relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Active Coverage</span>
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-5xl font-black text-slate-800 mt-4 tracking-tight">1</p>
                    <div class="mt-4 pt-3 border-t border-slate-100">
                        <span class="inline-block text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-xl">Barangay Anomar</span>
                    </div>
                </div>

            </div>

            <!-- SUCCESS MESSAGE ALERT -->
            @if(session('success'))
                <div class="p-5 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-2xl text-sm font-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>