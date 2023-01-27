<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluatorController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[UserController::class,'register']);
Route::get('userlists',[UserController::class,'userlists']);
Route::delete('/userdelete/{id}',[UserController::class,'userdelete']);
Route::get('/users/{id}',[UserController::class,'getusers']);
Route::put('/update/{id}',[UserController::class,'update']);
Route::post('login',[UserController::class,'login']);
Route::post('/employeelogin',[UserController::class,'employeelogin']);
Route::get('/eval',[AdminController::class,'userlists']);
Route::post('/addtask',[AdminController::class,'addtask']);
Route::post('/alltask',[AdminController::class,'alltask']);
Route::post('/regeval',[AdminController::class,'reg']);
Route::post('/addobject',[ObjectivesController::class,'insertobj']);

Route::get('/objectlist',[ObjectivesController::class,'prof']);
Route::get('/objecthighprof',[ObjectivesController::class,'highprof']);

Route::get('/positionlist',[AdminController::class,'position']);

/*
employee
*/
Route::get('/emptask/{id}',[EmployeeController::class,'show']);
Route::post('/upload',[EmployeeController::class,'store']);
Route::post('/esat',[EmployeeController::class,'showobjective']);
Route::post('/esatrating/{id}',[EmployeeController::class,'teacheresat']);
Route::post('/behavioresat',[EmployeeController::class,'coreesat']);
Route::post('/behavior/{id}',[EmployeeController::class,'savecore']);
Route::post('/feedbackbehavior',[EmployeeController::class,'Functionbehavior']);
/*
evaluator
*/
Route::get('/evaltask/{id}',[EvaluatorController::class,'listtask']);
Route::post('/updatephaseone/{id}',[EvaluatorController::class,'updateEsat']);
Route::post('/updatebehavior',[EvaluatorController::class,'updateBehavior']);
Route::post('/updatefeedback',[EvaluatorController::class,'feedback']);