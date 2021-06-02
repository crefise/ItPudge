<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like_comment;

class LikeCommentController extends Controller
{
    public function create(Request $request, $id) {
        $user_id = auth()->user()->getKey();
        $post_id = $id;
        return Like_comment::create(['user_id' => $user_id,
                            'comment_id' => $post_id]);
    }

    public function get_likes(Request $request, $id) {
        return Like_comment::where("comment_id", '=', $id)->get();
    }

    public function delete(Request $request, $id) {
        $user_id = auth()->user()->getKey();
        $like = Like_comment::where('comment_id', '=', $id)->where('user_id', '=', $user_id)->get();
        
        for ($i=0; $i < count($like); $i++) { 
            Like_comment::destroy($like[$i]['id']);
        }
    }
}
