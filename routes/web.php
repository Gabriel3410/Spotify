<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Middleware\CheckUserPreferences;
use App\Http\Controllers\ManagerController as ControllersManagerController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

// dashboard padrão de todos os usuários
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // rotas de escolha de genero musical
    Route::get('/choose-genres', [UserPreferenceController::class, 'index'])->name('choose.genres');
    Route::post('/save-genres', [UserPreferenceController::class, 'store'])->middleware(['auth'])->name('save.genres');
});


Route::middleware(['auth', CheckUserPreferences::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// rotas para o acesso somente dos admins
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/admin/tornar-admin/{id}', [AdminController::class, 'tornarAdmin'])->name('admin.tornarAdmin');

    Route::get('/admin/genres', [GenreController::class, 'index'])->name('admin.genres.index');
    Route::post('/admin/genres', [GenreController::class, 'store'])->name('admin.genres.store');
    Route::delete('/admin/genres/{genre}', [GenreController::class, 'destroy'])->name('admin.genres.destroy');
});


// rotas de acesso somente para os managers
Route::middleware(['auth', 'manager'])->group(function () {
    // Dashboard do Manager
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.dashboard');

    //-------------------------------------------------------------------------------------------------------------------------------------
    // Rotas para gerenciamento de artistas
    //-------------------------------------------------------------------------------------------------------------------------------------
    Route::get('/manager/artists/create', [ManagerController::class, 'createArtist'])->name('manager.create_artist');
    Route::post('/manager/artists', [ManagerController::class, 'storeArtist'])->name('manager.store_artist');
    Route::get('/manager/artists/{artist}/edit', [ManagerController::class, 'editArtist'])->name('manager.artists.edit');
    Route::put('/manager/artists/{artist}', [ManagerController::class, 'updateArtist'])->name('manager.artists.update');
    Route::delete('/manager/artists/{artist}', [ManagerController::class, 'destroyArtist'])->name('manager.artists.destroy');

    //-------------------------------------------------------------------------------------------------------------------------------------
    // Rotas para upload de músicas
    // ------------------------------------------------------------------------------------------------------------------------------------
    // Rota para exibir a lista de músicas
    Route::get('/manager/songs', [ManagerController::class, 'index'])->name('manager.songs.index');

    // Rota para exibir o formulário de criação de música
    Route::get('/manager/songs/create', [ManagerController::class, 'createSong'])->name('manager.create_song');

    // Rota para armazenar uma nova música
    Route::post('/manager/songs', [ManagerController::class, 'storeSong'])->name('manager.store_song');

    // Rota para exibir o formulário de edição de música
    Route::get('/manager/songs/{song}/edit', [ManagerController::class, 'editSong'])->name('manager.songs.edit');

    // Rota para atualizar a música no banco de dados
    Route::put('/manager/songs/{song}', [ManagerController::class, 'updateSong'])->name('manager.songs.update');

    // Rota para excluir uma música
    Route::delete('/manager/songs/{song}', [ManagerController::class, 'destroySong'])->name('manager.songs.destroy');


    //--------------------------------------------------------------------------------------------------------------------------------------
    // Rotas para criação de álbum
    // -------------------------------------------------------------------------------------------------------------------------------------
    Route::get('/manager/albums/create', [ManagerController::class, 'createAlbum'])->name('manager.create_album');
    Route::post('/manager/albums', [ManagerController::class, 'storeAlbum'])->name('manager.store_album');
});


require __DIR__ . '/auth.php';
