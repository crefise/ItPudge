<?php

use App\Http\Controllers\UserController;
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

//GET - /api/users 
Route::get('/users', [ UserController::class, 'index']);

//GET - /api/users/<user_id>
Route::get('/users/{User}', [ UserController::class, 'show']);

//POST - /api/users- create a new user, required parameters are [login, password,password confirmation, email, role]. This feature must be accessible only foradmins
Route::middleware('auth')->post('/users', [UserController::class, 'create_user']);

//POST - /api/users/avatar

//PATCH - /api/users/<user_id>
Route::patch('/users/{User}',[UserController::class, 'update']);

//DELETE - /api/users/<user_id>
Route::delete('/users/{User}',[UserController::class, 'destroy']);

Route::middleware('auth')->get('/me', function () {
    return auth()->user();
});