<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category_entry;
use App\Models\Category;


class PostController extends Controller
{
    public function create(Request $request) {
        $data = $request->all();
        $label = $data['label'];
        $text = $data['text'];
        $author_id = auth()->user()->getKey();

        $categories = $data['categories'];

        $categories_array = explode(',', $categories);

        $post = Post::create([ 'label' => $label,
                        'text' => $text,
                        'user_id' => $author_id]);

    
        foreach ($categories_array as $key) {
            if ($key == "") {
                continue;
            } else {
                $category_id = Category::where('name', '=', $key)->get()[0]['id'];
                Category_entry::create([
                    'post_id' => $post['id'],
                    'category_id' => $category_id
                ]);
            }
        }

        return $post;
        
    }
    public function index(Request $request) {
        return Post::all();       
    }
    public function show(Request $request, $id) {
        return Post::find($id);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id)->get();
        if ($post[0]['user_id'] == auth()->user()->getKey()) {
            $post = Post::find($id);
            $post->update($request->all());
            return $post;
        } else {
            return 'User is not owner';
        }
    }

    public function delete(Request $request, $id) {
        $post = Post::find($id)->get();
        if ($post[0]['user_id'] == auth()->user()->getKey()) {
            $post = Post::destroy($id);
            return $post;
        } else {
            return 'User is not owner';
        }
    }
}
