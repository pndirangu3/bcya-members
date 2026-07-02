<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [MemberController::class, 'create'])
    ->middleware(['auth'])
    ->name('members.create');

Route::post('/register', [MemberController::class, 'store']);

Route::get('/members', [MemberController::class, 'index'])
    ->middleware(['auth'])
    ->name('members.index');

Route::get('/members/{id}', [MemberController::class, 'show']);
Route::get('/members/{id}/approve', [MemberController::class, 'approve']);
Route::get('/members/{id}/reject', [MemberController::class, 'reject']);

Route::get('/members/{id}/edit', [MemberController::class, 'edit'])
    ->middleware(['auth'])
    ->name('members.edit');

Route::put('/members/{id}', [MemberController::class, 'update'])
    ->middleware(['auth'])
    ->name('members.update');

// AJAX - Load Bomas
Route::get('/get-bomas/{payam}', function ($payam) {

    $payamRecord = \App\Models\Payam::where('name', $payam)->first();

    if (!$payamRecord) {
        return response()->json([]);
    }

    return \App\Models\Boma::where('payam_id', $payamRecord->id)
        ->orderBy('name')
        ->get();
});

// Breeze Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Breeze Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
