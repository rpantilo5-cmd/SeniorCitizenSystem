<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Register New Senior Citizen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <form action="{{ route('seniors.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">OSCA ID Number</label>
                            <input type="text" name="osca_id_no" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Barangay</label>
                            <select name="barangay_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                                @foreach($barangays as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">First Name</label>
                            <input type="text" name="first_name" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Middle Name</label>
                            <input type="text" name="middle_name" class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Last Name</label>
                            <input type="text" name="last_name" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Birthdate</label>
                            <input type="date" name="birthdate" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Gender</label>
                            <select name="gender" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Pension Status</label>
                            <select name="pension_status" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                                <option value="Indigent">Indigent</option>
                                <option value="Social Pensioner">Social Pensioner</option>
                                <option value="Private Pensioner">Private Pensioner</option>
                                <option value="None">None</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">Address / Street</label>
                        <textarea name="address" class="w-full border-gray-300 rounded-lg shadow-sm" rows="2" required></textarea>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-500 text-white font-bold rounded-lg">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-blue-800 text-white font-bold rounded-lg shadow hover:bg-blue-900">Save Senior Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>