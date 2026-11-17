<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrated Senior Citizen Assistance & Benefits Monitoring System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans text-gray-800 antialiased">
    <!-- Header Navigation -->
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white text-blue-900 font-bold p-2 rounded-lg shadow-inner">
                    OSCA
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight">Senior Citizen Assistance & Benefits System</h1>
                    <p class="text-xs text-blue-200">Social Welfare Information Management System</p>
                </div>
            </div>
            <div>
                @if (Route::has('login'))
                    <div class="space-x-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg shadow transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">Register Worker</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero Content -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-blue-800">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full uppercase tracking-wide">Official Barangay & OSCA Portal</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-4">Integrated Senior Citizen Assistance & Benefits Monitoring System</h2>
                <p class="text-gray-600 mt-3 leading-relaxed">
                    Usa ka digital platform nga gidisenyo para ma-organize ug ma-manage ang mga records, hangyo alang sa tabang (assistance requests), ug nadawat nga benepisyo sa mga senior citizens sa matag barangay.
                </p>
            </div>

            <!-- Target Users & Features Grid -->
            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-800 rounded-lg flex items-center justify-center font-bold text-xl mb-4">👴</div>
                    <h3 class="font-bold text-lg text-gray-800">Senior Masterlist</h3>
                    <p class="text-sm text-gray-600 mt-2">Dali nga pag-organize ug pag-retrieve sa records sa mga senior citizen pinaagi sa digitized database.</p>
                </div>

                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 text-green-800 rounded-lg flex items-center justify-center font-bold text-xl mb-4">📋</div>
                    <h3 class="font-bold text-lg text-gray-800">Assistance Tracking</h3>
                    <p class="text-sm text-gray-600 mt-2">Pag-record sa mga hangyo sa tabang (medical, financial, food, burial) ug pag-monitor sa ilang status.</p>
                </div>

                <div class="p-6 bg-slate-50 rounded-xl border border-gray-200 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 text-purple-800 rounded-lg flex items-center justify-center font-bold text-xl mb-4">🎁</div>
                    <h3 class="font-bold text-lg text-gray-800">Anti-Duplication System</h3>
                    <p class="text-sm text-gray-600 mt-2">Pagsiguro nga maayo ug sakto ang paghatag sa ayuda aron malikayan ang pagbalik-balik ug missing records.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>