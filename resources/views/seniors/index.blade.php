<x-app-layout>
    <div x-data="{ openSeniorModal: {{ $errors->any() ? 'true' : 'false' }} }" class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Page Header -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Senior Citizens Directory</h2>
                    <p class="text-xs text-slate-500 mt-1">Full list of registered senior citizens in Barangay Anomar</p>
                </div>
                <button @click="openSeniorModal = true" type="button" class="px-5 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-md transition duration-150 flex items-center gap-2 cursor-pointer">
                    <span>+ Add New Senior</span>
                </button>
            </div>

            <!-- SUCCESS MESSAGE ALERT -->
            @if(session('success'))
                <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-xs font-bold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-800 font-bold text-base leading-none">&times;</button>
                </div>
            @endif

            <!-- ERROR / DUPLICATE WARNING ALERT -->
            @if($errors->any())
                <div class="p-4 bg-rose-100 border border-rose-300 text-rose-800 rounded-xl text-xs font-bold flex items-center justify-between">
                    <div>
                        <p class="font-extrabold uppercase">Registration Failed / Warning:</p>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-800 font-bold text-base leading-none">&times;</button>
                </div>
            @endif

            <!-- SENIORS TABLE LIST -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-[11px] font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">OSCA ID</th>
                                <th class="px-6 py-4">Full Name</th>
                                <th class="px-6 py-4">Birthdate</th>
                                <th class="px-6 py-4">Contact Number</th>
                                <th class="px-6 py-4">Barangay</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($seniors as $senior)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4 font-bold text-blue-600">{{ $senior->osca_id }}</td>
                                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $senior->last_name }}, {{ $senior->first_name }}</td>
                                    <td class="px-6 py-4 text-slate-600 font-medium">{{ $senior->formatted_birthdate }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $senior->contact_number ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-2.5 py-1 text-[11px] font-semibold text-slate-700 bg-slate-100 rounded-lg">
                                            {{ $senior->barangay ?? 'Barangay Anomar' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-slate-400 text-xs">
                                        No senior citizens registered yet. Click <strong>+ Add New Senior</strong> to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- ================= MODAL: REGISTER NEW SENIOR CITIZEN ================= -->
        <div x-show="openSeniorModal" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4" 
             style="display: none;">
            
            <div @click.outside="openSeniorModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 border border-slate-200" x-data="{ month: '{{ old('month', '') }}', day: '{{ old('day', '') }}', year: '{{ old('year', '') }}' }">
                <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-bold text-slate-800">Register New Senior Citizen</h3>
                    <button type="button" @click="openSeniorModal = false" class="text-slate-400 hover:text-slate-600 text-2xl font-bold cursor-pointer leading-none">&times;</button>
                </div>

                <form method="POST" action="{{ route('seniors.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">OSCA ID Number</label>
                        <input type="text" name="osca_id" value="{{ old('osca_id') }}" placeholder="e.g. OSCA-2026-001" 
                               class="w-full rounded-xl text-sm py-2.5 @error('osca_id') border-rose-500 focus:ring-rose-500 @else border-slate-300 @enderror" required>
                        @error('osca_id')
                            <p class="text-xs text-rose-600 font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full rounded-xl border-slate-300 text-sm py-2.5" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full rounded-xl border-slate-300 text-sm py-2.5" required>
                        </div>
                    </div>

                    <!-- SENIOR FRIENDLY BIRTHDATE DROPDOWN SELECTION -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Birthdate</label>
                        <div class="grid grid-cols-3 gap-2">
                            <select x-model="month" class="rounded-xl border-slate-300 text-sm py-2.5" required>
                                <option value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>

                            <select x-model="day" class="rounded-xl border-slate-300 text-sm py-2.5" required>
                                <option value="">Day</option>
                                @for($d = 1; $d <= 31; $d++)
                                    <option value="{{ sprintf('%02d', $d) }}">{{ $d }}</option>
                                @endfor
                            </select>

                            <select x-model="year" class="rounded-xl border-slate-300 text-sm py-2.5" required>
                                <option value="">Year</option>
                                @for($y = 1930; $y <= (date('Y') - 60); $y++)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <input type="hidden" name="birthdate" :value="year && month && day ? year + '-' + month + '-' + day : ''">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Contact Number</label>
                        <input type="text" name="contact_number" value="{{ old('contact_number') }}" placeholder="09xxxxxxxxx" class="w-full rounded-xl border-slate-300 text-sm py-2.5">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Barangay</label>
                        <input type="text" name="barangay" value="Barangay Anomar" class="w-full rounded-xl border-slate-200 bg-slate-100 text-slate-500 text-sm py-2.5" readonly>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                        <button type="button" @click="openSeniorModal = false" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold cursor-pointer">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold uppercase cursor-pointer">Save Senior</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>