<?php
use App\Http\Controllers\MobileQuestionController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => '/'], function () {
    Route::get('/', [QuestionController::class, 'index'], )->name('index');
    Route::post('/store', [QuestionController::class, 'store'])->name("store");
    Route::get('/fetchAll/{keyword}', [QuestionController::class, 'fetchAll'])->name("fetchAll");
    Route::get('/edit', [QuestionController::class, 'edit'])->name("edit");
    Route::get('/view', [QuestionController::class, 'view'])->name("view");
    Route::delete('/delete', [QuestionController::class, 'delete'])->name('delete');
    Route::post('/update', [QuestionController::class, 'update'])->name('update');
    Route::post('/update_completed', [QuestionController::class, 'update_completed'])->name('update_completed');
    Route::get('/mobile', [QuestionController::class, 'index_mobile'])->name('index_mobile');
});
