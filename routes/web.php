<?php

use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
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

Auth::routes();

Route::middleware(['auth'])->group(function (): void {
    Route::get('/', [ChatController::class, 'index']);
    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::get('messages', [ChatController::class, 'getMessages']);
    Route::post('messages', [ChatController::class, 'sendMessage']);
});
