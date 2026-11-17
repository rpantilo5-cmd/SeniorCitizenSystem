<x-app-layout>
    <div x-data="{ openAssistanceModal: {{ $errors->any() ? 'true' : 'false' }} }" class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Page Header -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Assistance Requests</h2>
                    <p class="text-xs text-slate-500 mt-1">Overview and management of all submitted assistance requests</p>
                </div>
                <button @click="openAssistanceModal = true" type="button" class="px-5 py-3 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-md transition duration-150 flex items-center gap-2 cursor-pointer">
                    <span>+ New Assistance Request</span>
                </button>
            </div>

            <!-- SUCCESS MESSAGE ALERT (Page Level) -->
            @if(session('success'))
                <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-xs font-bold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-800 font-bold text-base leading-none">&times;</button>
                </div>
            @endif

            <!-- ASSISTANCE REQUESTS TABLE LIST -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-[11px] font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Senior Name</th>
                                <th class="px-6 py-4">Request Type</th>
                                <th class="px-6 py-4">Details / Remarks</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Date Submitted</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($requests as $req)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4 font-semibold text-slate-800">
                                        {{ $req->senior->last_name ?? 'N/A' }}, {{ $req->senior->first_name ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-emerald-600">{{ $req->request_type }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $req->details ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-2.5 py-1 text-[11px] font-semibold text-amber-700 bg-amber-50 border border-amber-200 rounded-lg">
                                            {{ $req->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">{{ $req->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-slate-400 text-xs">
                                        No assistance requests submitted yet. Click <strong>+ New Assistance Request</strong> to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- ================= MODAL: NEW ASSISTANCE REQUEST ================= -->
        <div x-show="openAssistanceModal" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4" 
             style="display: none;">
            
            <div @click.outside="openAssistanceModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 border border-slate-200">
                <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-bold text-slate-800">New Assistance Request</h3>
                    <button type="button" @click="openAssistanceModal = false" class="text-slate-400 hover:text-slate-600 text-2xl font-bold cursor-pointer leading-none">&times;</button>
                </div>

                <!-- WARNING / FAILED ALERT INSIDE THE FILL UP FORM FOR 100% CONSISTENCY -->
                @if($errors->any())
                    <div class="mb-4 p-3.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs font-medium">
                        <div class="flex items-center gap-2 text-rose-800 font-bold mb-1">
                            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Duplicate / Validation Warning</span>
                        </div>
                        <ul class="list-disc list-inside space-y-0.5 text-[11px] text-rose-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('assistance.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Select Senior Citizen</label>
                        <select name="senior_id" class="w-full rounded-xl border-slate-300 text-sm py-2.5" required>
                            <option value="">-- Choose Senior --</option>
                            @foreach($seniors as $senior)
                                <option value="{{ $senior->id }}" {{ old('senior_id') == $senior->id ? 'selected' : '' }}>
                                    {{ $senior->last_name }}, {{ $senior->first_name }} ({{ $senior->osca_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Request Type</label>
                        <select name="request_type" class="w-full rounded-xl border-slate-300 text-sm py-2.5" required>
                            <option value="Medical Financial Assistance">Medical Financial Assistance</option>
                            <option value="Food & Grocery Relief">Food & Grocery Relief</option>
                            <option value="Emergency Relief Goods">Emergency Relief Goods</option>
                            <option value="Assistive Device (Wheelchair/Cane)">Assistive Device (Wheelchair/Cane)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Details / Remarks</label>
                        <textarea name="details" rows="3" placeholder="Enter request reason or additional details..." class="w-full rounded-xl border-slate-300 text-sm py-2">{{ old('details') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" @click="openAssistanceModal = false" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold cursor-pointer">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold uppercase cursor-pointer">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>