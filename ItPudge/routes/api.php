<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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


////////////////////////////// AUTH //////////////////////////////
// POST - /api/auth/register
Route::post('/register', function(Request $request) {
    $data = $request->all();
    $data['password'] = Hash::make($data['password']);
    App\Models\User::create($data);
});


// POST - /api/auth/login
Route::post('/login', function(Request $request) {
   $credentails = request()->only(['email', 'password']);
    $token = auth()->attempt($credentails);
    return $token;
});

//POST - /api/auth/logout
Route::post('/logout', function(Request $request) {
        JWTAuth::invalidate(JWTAuth::getToken());
        return "Logout good!";
 });

//POST - /api/auth/password-reset
//POST - /api/auth/password-reset/<confirm_token>
//////////////////////////////////////////////////////////////////



////////////////////////////// ADMIN //////////////////////////////
Route::middleware('auth')->get('/users', [ UserController::class, 'index']);
Route::middleware('auth')->post('/users', [UserController::class, 'create_user']);
Route::middleware('auth')->patch('/users/{User}',[UserController::class, 'update']);
Route::middleware('auth')->delete('/users/{User}',[UserController::class, 'destroy']);
///////////////////////////////////////////////////////////////////

////////////////////////////// USER ///////////////////////////////
Route::middleware('auth')->post('/users/avatar', [UserController::class, 'upload_avatar']);

Route::middleware('auth')->get('/me', function () {
    return auth()->user();
});
/////////////////////////////////////////////////////////////////////
Route::get('/users/{User}', [ UserController::class, 'show']);
////////////////////////////// MEMBER ///////////////////////////////



Route::post('/posts/create', [PostController::class, 'create']);





