<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function insertComment($id, $comment){
        $commentRequest = Request()->all();
        $commentRequest['body'] = $comment;
        $commentRequest['product_id'] = $id;
        $commentRequest['user_id'] = auth()->user()->id;

        $comment = new Comment($commentRequest);
        $comment->save();

        return response()->json([
            'user' => [
                'name' => auth()->user()->name,
            ],
            'body' => $commentRequest['body'],
        ]);
        
        // return response()->json([
            // $Request
        // ]);
    }
    
}
