<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ClientController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //appointment
    Route::get('/appointment', [AppointmentsController::class, 'index']);
    Route::get('/appointment-create', [AppointmentsController::class, 'create']);
    Route::post('/appointment-save', [AppointmentsController::class, 'store']);
    

    //client
    Route::get('/client', [ClientController::class, 'index']);
    Route::get('/client', [ClientController::class, 'fetch']);
    Route::get('/create-client', [ClientController::class, 'show']);
    Route::post('/client-save', [ClientController::class, 'store']);
     
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
