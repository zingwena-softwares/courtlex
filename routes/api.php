<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected Routes
Route::group(['middleware'=>['auth:sanctum']], function(){
  //user
  Route::get('/user', [AuthController::class, 'user']);
  Route::post('/logout', [AuthController::class, 'logout']);

  //client
  Route::get('/clients', [ClientController::class, 'clients']);//show all clients
  Route::post('/client', [ClientController::class, 'store']);//save client
  Route::get('/client/{id}', [ClientController::class, 'show']);//get single client
  Route::put('/client/{id}', [ClientController::class, 'update']);//update client
  Route::delete('/client/{id}', [ClientController::class, 'destroy']);//delete a client
  Route::get('/clientnames', [ClientController::class, 'clients_names']);//get clients names 



   // cases
   Route::get('/cases', [CaseController::class, 'cases']); // all cases
   Route::post('/newcase', [CaseController::class, 'store']); // create case on a client
   Route::put('/case/{id}', [CaseController::class, 'update']); // update a case
   Route::delete('/case/{id}', [CaseController::class, 'destroy']); // delete a case
   Route::put('/closecase/{id}', [CaseController::class, 'updateClose']); // updateclose case
   Route::put('/opencase/{id}', [CaseController::class, 'updateOpen']); // updateclose case


 // Schedules
 Route::get('/schedules', [ScheduleController::class, 'schedules']); // all cases
 Route::post('/newschedule', [ScheduleController::class, 'store']); // create case on a client
 Route::put('/schedule/{id}', [ScheduleController::class, 'update']); // update a case
 Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy']); // delete a case

    // Notes
    Route::get('/notes', [NotesController::class, 'notes']); // all cases
    Route::post('/newnote', [NotesController::class, 'store']); // create case on a client
    Route::put('/note/{id}', [NotesController::class, 'update']); // update a case
    Route::delete('/note/{id}', [NotesController::class, 'destroy']); // delete a case
    
});