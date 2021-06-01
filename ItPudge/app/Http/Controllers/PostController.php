<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function create(Request $request) {
        $data = $request->all();
        $label = $data['label'];
        $text = $data['text'];
        $author_id = auth()->user()->getKey();

        $categories = $data['categories'];
        return Post::create([ 'label' => $label,
                        'text' => $text,
                        'user_id' => $author_id]);
        
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
