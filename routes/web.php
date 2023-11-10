<?php

use App\Http\Controllers\Contacts\ContactsController;
use App\Http\Controllers\ProfileController;
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
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // contacts
    Route::get('/dashboard', [ContactsController::class, 'index'])->name('dashboard');
    Route::resource('contacts', ContactsController::class);
    Route::get('/filter-contacts/{tag_id}', [ContactsController::class, 'filterContacts']);
    Route::get('/deleted-contacts', [ContactsController::class, 'deletedContacts'])->name('contacts.trash');
});

require __DIR__ . '/auth.php';
