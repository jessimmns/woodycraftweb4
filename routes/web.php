<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PanierController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('puzzles', PuzzleController::class)->middleware('auth');
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');


Route::middleware('auth')->group(function () {
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter/{puzzle}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::patch('/panier/modifier/{puzzle}', [PanierController::class, 'modifier'])->name('panier.modifier');
    Route::delete('/panier/supprimer/{puzzle}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
});

require __DIR__.'/auth.php';
