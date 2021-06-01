<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Comments_entries;

class CommentController extends Controller
{
    public function create_commment(Request $request, $id) {
        $data = $request->all();
        $text = $data['text'];
        $author_id = auth()->user()->getKey();

        $comment = Comment::create(['text' => $text,
                                    'author_id' => $author_id]);
                         
        Comments_entries::create(['comment_id' => $comment['id'],
                                'post_id' => $id]);
    }

    public function get_comments(Request $request, $id) {
        return Comments_entries::join('comments', 'Comments_entries.id', '=', 'comments.id')->where('post_id', '=', $id)->get();
    }
}
