<?php


use App\Http\Controllers\{AboutController,
    Admin\Post\PostController,
    ContactsController,
    MainController,
    Post\IndexController};
use App\Http\Controllers\Post\{CreateController,
    DestroyController,
    EditController,
    ShowController,
    StoreController,
    UpdateController};
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
    return view('welcome');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('post.index');
    Route::get('/posts/create', 'create')->name('post.create');

    Route::post('/posts', 'store')->name('post.store');
    Route::get('/posts/{post}', 'show')->name('post.show');
    Route::get('/posts/{post}/edit', 'edit')->name('post.edit');
    Route::patch('/posts/{post}', 'update')->name('post.update');
    Route::delete('/posts/{post}', 'destroy')->name('post.delete');
});

Route::prefix('admin')->group(function () {
    Route::get('/post', [PostController::class, 'index'])->name('admin.post.index');
});

Route::get('/posts/update', [PostController::class, 'update']);
Route::get('/posts/delete', [PostController::class, 'delete']);
Route::get('/posts/first_or_create', [PostController::class, 'firstOrCreate']);
Route::get('/posts/update_or_create', [PostController::class, 'updateOrCreate']);

Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');






