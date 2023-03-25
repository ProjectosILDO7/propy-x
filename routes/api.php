<?php

//use App\Http\Controllers\Api\Auth\AlterarPasswordController;

use App\Http\Controllers\Api\Auth\RegisterControllerUser;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\GraduacaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});
// Route::post('/auth', [AuthApiController::class, 'auth']);
// Route::get('/me', [AuthApiController::class, 'me'])->middleware('auth:sanctum');
// Route::get('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forget-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');
Route::post('/registerUser', [RegisterControllerUser::class, 'crear']);
Route::put('/updateuser', [RegisterControllerUser::class, 'updateUser'])->middleware('api');

Route::get('/courses', [CursoController::class, 'index'])->middleware('api');
Route::post('/filter', [CursoController::class, 'filter'])->middleware('api');
Route::post('/registerCurso', [CursoController::class, 'store'])->middleware('api');
Route::get('/getCourse/{id}', [CursoController::class, 'edit'])->middleware('api');
Route::put('/updateCurso/{id}', [CursoController::class, 'update'])->middleware('api');
Route::get('/apagarCurso/{id}', [CursoController::class, 'destroy'])->middleware('api');
Route::get('/detalhes/{id}', [CursoController::class, 'show'])->middleware('api');

Route::get('/graduactions', [GraduacaoController::class, 'index'])->middleware('api');
Route::post('/filter', [GraduacaoController::class, 'filter'])->middleware('api');
Route::post('/registerGraduaction', [GraduacaoController::class, 'store'])->middleware('api');
Route::get('/getGraduaction/{id}', [GraduacaoController::class, 'edit'])->middleware('api');
Route::put('/updateGraduaction/{id}', [GraduacaoController::class, 'update'])->middleware('api');
Route::get('/apagarGraduaction/{id}', [GraduacaoController::class, 'destroy'])->middleware('api');
Route::get('/detalhesGraduaction/{id}', [GraduacaoController::class, 'show'])->middleware('api');

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
