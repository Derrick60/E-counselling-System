<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\Client2Controller;
use App\Http\Controllers\CounselorController;

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

Route::get('/master', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //appointment
    Route::get('/appointment', [AppointmentsController::class, 'index']);
    Route::get('/appointment-create', [AppointmentsController::class, 'create']);
    Route::post('/appointment-save', [AppointmentsController::class, 'store']);
     Route::delete('/delete/{id}', [AppointmentsController::class, 'destroy']);
    

    //client
    Route::get('/client', [Client2Controller::class, 'index']);
    Route::get('/client', [Client2Controller::class, 'fetch']);
    Route::get('/create-client', [Client2Controller::class, 'show']);
    Route::post('/client-save', [Client2Controller::class, 'store']);
    Route::get('/client-edit/{id}', [Client2Controller::class, 'edit']);
    Route::put('/client-update/{id}', [Client2Controller::class, 'update']);
    Route::delete('/client-delete/{id}', [Client2Controller::class, 'destroy']);
     
    //counselor
    Route::group(['middleware' => ['role:admin']], function () {
    //
     Route::get('/counselor', [CounselorController::class, 'index']);
     Route::get('/counselor', [CounselorController::class, 'fetch']);
     Route::get('/counselor-create', [CounselorController::class, 'show']);
     Route::post('/counselor-save', [CounselorController::class, 'store']);
     Route::get('/counselor-edit/{id}', [CounselorController::class, 'edit']);
     Route::put('/counselor-update/{id}', [CounselorController::class, 'update']);
    Route::delete('/counselor-delete/{id}', [CounselorController::class, 'destroy']);
     });
    //slot
     Route::get('/slot', [SlotController::class, 'index']);
     Route::get('/slot', [SlotController::class, 'fetch']);
     Route::get('/slot-create', [SlotController::class, 'create']);
     Route::post('/slot-save', [SlotController::class, 'store']);
     Route::get('/available/{date}', [SlotController::class,'available']);

     //available slots
     Route::get('/availableSlots/{date}/{counselor}', [AppointmentsController::class,'availableSlots']);
});





require __DIR__.'/auth.php';
