<?php

use App\Http\Controllers\FotoController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Models\Foto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome', ['foto' => Foto::all(), 'id' => '1']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/foto/{slug}', [FotoController::class, 'show'])->name('foto.show');
Route::resource('post', FotoController::class);
Route::get('/like/{id}', [LikeController::class, 'like']);
Route::get('/likee/{id}', [LikeController::class, 'likee']);


require __DIR__.'/auth.php';
