<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use JWTAuth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'story_id' => 'required'
        ]);
        $user = JWTAuth::parseToken()->toUser();
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->story_id = $request->input('story_id');
        $comment->user_id = $user->id;
        $comment->save();
        return response()->json(['story' => $comment], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  comment id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->toUser();
        $this->validate($request, [
            'content' => 'required'
        ]);
        $comment = Comment::find($id);
        if (!$comment) {

            return response()->json(['message' => 'Comment not Found!'],404);

        }elseif ($comment->user_id == $user->id){

            $comment->content = $request->input('content');
            $comment->save();
            return response()->json(['message'=>'Comment updated', 'comment'=>$comment],200);

        }else{
            return response()->json(['message'=>'You must be the Owner!'],400);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->toUser();
        $comment = Story::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Story not Found!'], 401);
        } elseif ($comment->user_id == $user->id) {
            $comment->delete();
            return response()->json(['message' => 'Story Deleted!'], 200);
        } else {
            return response()->json(['message' => 'You must be the Owner!'], 400);

        }
    }
}
