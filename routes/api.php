<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ThemeController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\SubTaskController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\UserThemeController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\StatutesController;

use \App\Http\Controllers\Api\V1\Auth;

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


Route::post('auth/register', Auth\RegisterController::class);
Route::post('auth/login', Auth\LoginController::class);
Route::post('auth/logout', Auth\LogoutController::class);

//Route::get('status',StatutesController::class);
//Route::apiResource('theme',ThemeController::class);

Route::group(['middleware' =>['auth:sanctum']], function(){
    // Route::get('/user', function(Request $request){
    //     return $request->user();
    // }) ;
    
    Route::apiResource('theme',ThemeController::class);
    Route::apiResource('theme.task',TaskController::class);
    Route::put('theme/{theme}/update-status-task/{task}',[TaskController::class,'updateStatusTask']);
    Route::apiResource('theme.category', CategoryController::class);
  

    Route::apiResource('theme.task.subtask', SubTaskController::class);

    Route::apiResource('theme.theme-user', UserThemeController::class);
    
    Route::apiResource('task.comment', CommentController::class);
    Route::get('task/{id}/comment',[CommentController::class,'index']);

    Route::get('role',[RoleController::class,'index']);
    //Route::get('status',[StatutesController::class, 'index']);
    Route::get('status',StatutesController::class);
   
});
