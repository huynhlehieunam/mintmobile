<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Mockery\Exception;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAComment(Request $request)
    {
        $request->validate(["content"=>"required"]);

        try{

            $comment = new Comment();
            $comment->email = $request->email;
            $comment->content = $request->content;
            $comment->product_id = $request->product_id;
            $comment->save();
            return response()->json($comment->only('id', 'created_at'));
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
