<?php

namespace App\Http\Controllers;
use App\Models\Like;


use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function create(Request $request, $id) {
        $user_id = auth()->user()->getKey();
        $post_id = $id;
        $type = $request->only(['type'])['type'];
        return Like::create(['user_id' => $user_id,
                            'post_id' => $post_id,
                            'type' => $type]);
    }

    public function get_likes(Request $request, $id) {
        return Like::where("post_id", '=', $id)->get();
    }

    public function delete(Request $request, $id) {
        $user_id = auth()->user()->getKey();
        $like = Like::where('post_id', '=', $id)->where('user_id', '=', $user_id)->get();
        
        for ($i=0; $i < count($like); $i++) { 
            Like::destroy($like[$i]['id']);
        }
    }

}
