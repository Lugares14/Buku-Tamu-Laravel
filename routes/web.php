<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\tamu;
use Carbon\Carbon;

Route::get('/', [TamuController::class, 'index'])->name('tamu.form');
Route::post('/tamu', [TamuController::class, 'store'])->name('tamu.store');

Route::get('/dashboard', function () {
    $labels = [];
    $counts = [];

    foreach (range(6, 0) as $i) {
        $date = Carbon::now()->subDays($i)->format('d-m');
        $labels[] = $date;
        $counts[] = \App\Models\Tamu::whereDate('created_at', now()->subDays($i)->toDateString())->count();
    }

    return view('admin.dashboard', compact('labels', 'counts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/tamu', [TamuController::class, 'indexAdmin'])->name('tamu.index');
    Route::get('/admin/tamu/{id}/edit', [TamuController::class, 'edit'])->name('tamu.edit');
    Route::put('/admin/tamu/{id}', [TamuController::class, 'update'])->name('tamu.update');
    Route::delete('/admin/tamu/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');

    // Profile settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/admin/tamu/export-pdf', function () {
        $daftarTamu = Tamu::all();
        $pdf = Pdf::loadView('admin.tamu_pdf', compact('daftarTamu'));
        return $pdf->download('daftar_tamu.pdf');
    })->name('tamu.export.pdf');
});

require __DIR__.'/auth.php';
