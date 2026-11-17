<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeniorController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\BenefitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->role === 'resident' ? 'resident.dashboard' : 'dashboard');
    }

    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:resident'])->prefix('resident')->name('resident.')->group(function () {
    Route::view('/dashboard', 'resident.dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    Route::get('/dashboard', function () {
        $seniors = \App\Models\Senior::latest()->get();
        $totalSeniors = $seniors->count();
        $pendingRequests = \App\Models\AssistanceRequest::where('status', 'Pending')->count();
        $benefitsDistributed = \App\Models\BenefitRelease::count();

        return view('dashboard', compact('seniors', 'totalSeniors', 'pendingRequests', 'benefitsDistributed'));
    })->name('dashboard');

    Route::get('/seniors', [SeniorController::class, 'index'])->name('seniors.index');
    Route::post('/seniors', [SeniorController::class, 'store'])->name('seniors.store');

    Route::get('/assistance-requests', [AssistanceController::class, 'index'])->name('assistance.index');
    Route::post('/assistance-requests', [AssistanceController::class, 'store'])->name('assistance.store');

    Route::get('/benefit-releases', [BenefitController::class, 'index'])->name('benefits.index');
    Route::post('/benefit-releases', [BenefitController::class, 'store'])->name('benefits.store');
});

require __DIR__.'/auth.php';