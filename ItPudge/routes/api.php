<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\CategoryController;
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


Route::post('/auth/password-reset', [ UserController::class, 'reset_password']);
Route::post('/auth/password-reset/{token}', [ UserController::class, 'change_password']);
////////////////////////////// USER //////////////////////////////
Route::post('/auth/register', [ UserController::class, 'register']);
Route::post('/auth/login', [ UserController::class, 'login']);
Route::middleware('auth')->post('/auth/logout', [ UserController::class, 'logout']);
Route::middleware('auth')->get('/users', [ UserController::class, 'index']);
Route::get('/users/{User}', [ UserController::class, 'show']);
Route::middleware('auth')->post('/users', [UserController::class, 'create_user']);
Route::middleware('auth')->post('/users/avatar', [UserController::class, 'upload_avatar']);
Route::middleware('auth')->patch('/users/{User}',[UserController::class, 'update']);
Route::middleware('auth')->delete('/users/{User}',[UserController::class, 'destroy']);
Route::middleware('auth')->delete('/me',[UserController::class, 'me']);
///////////////////////////////////////////////////////////////////


////////////////////////////// POST /////////////////////////////////
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::middleware('auth')->post('/posts', [PostController::class, 'create']);
Route::middleware('auth')->patch('/posts/{post}', [PostController::class, 'update']);
Route::middleware('auth')->delete('/posts/{post}', [PostController::class, 'delete']);

/////////////////////////////////////////////////////////////////////



////////////////////////////// COMMENTS ///////////////////////////////
Route::middleware('auth')->post('/posts/{post}/comments', [CommentController::class, 'create_commment']);
Route::middleware('auth')->get('/posts/{post}/comments', [CommentController::class, 'get_comments']);
///////////////////////////////////////////////////////////////////////

////////////////////////////// LIKE ///////////////////////////////////
Route::middleware('auth')->post('/posts/{post}/like', [LikeController::class, 'create']);
Route::middleware('auth')->delete('/posts/{post}/like', [LikeController::class, 'delete']);
Route::get('/posts/{post}/like', [LikeController::class, 'get_likes']);
///////////////////////////////////////////////////////////////////////

////////////////////////////// LIKE COMMENT ///////////////////////////////////
Route::middleware('auth')->post('/comments/{id}/like', [LikeCommentController::class, 'create']);
Route::middleware('auth')->delete('/comments/{id}/like', [LikeCommentController::class, 'delete']);
Route::get('/comments/{id}/like', [LikeCommentController::class, 'get_likes']);
///////////////////////////////////////////////////////////////////////////////


////////////////////////////// categories /////////////////////////////
Route::middleware('auth')->get('/categories', [CategoryController::class, 'index']);
Route::middleware('auth')->post('/categories', [CategoryController::class, 'create']);
Route::middleware('auth')->patch('/categories/{id}', [CategoryController::class, 'update']);
Route::middleware('auth')->delete('/categories/{id}', [CategoryController::class, 'delete']);
Route::middleware('auth')->get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/posts', [CategoryController::class, 'get_posts']);
///////////////////////////////////////////////////////////////////////

