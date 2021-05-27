<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }
    public function show($id) {
        return User::find($id);
    }
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request);
        return $user;
    }
    public function destroy($id) {
        User::destroy($id);
        return "Deleted!";
    }
    public function isAdmin($id) {
        $user = User::find($id);
        if ($user['admin_status'] == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function create_user(Request $request) {
        $user = auth()->user();
        if ($user['admin_status'] == 1) {
            return User::create($request->all());
        }
        else {
            return "User is not admin";
        }
    }
}
