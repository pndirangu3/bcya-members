<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Models\Boma;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/register', [MemberController::class, 'create']);
Route::post('/register', [MemberController::class, 'store']);
Route::get('/members', [MemberController::class, 'index']);
Route::get('/members/{id}', [MemberController::class, 'show']);
Route::get('/members/{id}/approve', [MemberController::class, 'approve']);

Route::get('/members/{id}/reject', [MemberController::class, 'reject']);
Route::get('/get-bomas/{payam}', function ($payam)
{
    $payamRecord = \App\Models\Payam::where('name', $payam)->first();

    if (!$payamRecord) {
        return response()->json([]);
    }

    return \App\Models\Boma::where('payam_id', $payamRecord->id)
        ->orderBy('name')
        ->get();
});
