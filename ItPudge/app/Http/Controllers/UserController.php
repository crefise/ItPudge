<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    ////////////////////////////////////// ADMIN //////////////////////////////////////////  
    public function create_user(Request $request) { // create user/admin
        if ($this->isAdmin()) {
            return User::create($request->all());
        }
        else {
            return "User is not admin";
        }
    }
    public function index() { // see all profiles
            if ($this->isAdmin()) {
                return User::all();
            } else {
                return "User is not admin";
            }
        }
    public function update(Request $request, $id) {
        if ($this->isAdmin()){
            $user = User::find($id);
            $user->update($request->all());
            return $user;
        } else {
            return "User is not admin";
        }
    }

    public function destroy($id) {
        if ($this->isAdmin()) {
            $will_deleted = User::find($id);
            $will_deleted->destroy();
            return $will_deleted;
        } else {
            return "User is not admin";
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////// 



    public function show($id) {
        return User::find($id);
    }

    public function isAdmin() {
        $user = auth()->user();
        if ($user['admin_status'] == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function upload_avatar(Request $request) {
        if ($request->hasFile('image')) {
            $filename = auth()->user()->getKey() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('images',  $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);
            return auth()->user();
        } else {
            return "No has image file";
        } 
    }
}
