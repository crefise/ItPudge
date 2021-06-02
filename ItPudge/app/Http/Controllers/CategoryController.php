<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Category_entry;
use App\Http\Controllers\UserController;
use App\Models\User;

class CategoryController extends Controller
{
    public function index(Request $request) {

        if (UserController::isAdmin() == true) {
            return Category::all();
        }
        return "User is not admin";

    }
    public function create(Request $request) {
        if (UserController::isAdmin() == true) {
            return Category::create($request->all());
        }
        return "User is not admin";

    }
    public function update(Request $request, $id) {
        if (UserController::isAdmin() == true) {
            $cat = Category::find($id);
            $cat->update($request->all());
            return $cat;
        }
        return "User is not admin";
    }
    public function delete(Request $request, $id) {
        if (UserController::isAdmin() == true) {
            return Category::destroy($id);
        }
        return "User is not admin";
    }
    public function show(Request $request, $id) {
        if (UserController::isAdmin() == true) {
            return Category::find($id);
        }
        return "User is not admin";
    }
    public function get_posts(Request $request, $id) {
        return Category_entry::join('posts', 'Category_entries.post_id', '=', 'posts.id')->
                                                        where('category_id', '=', $id)->get();
    }
}
