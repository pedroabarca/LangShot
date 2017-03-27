<?php

namespace App\Http\Controllers;

use App\Story;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::all();
        $response = [
            'stories'=>$stories
        ];

        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'video_url' => 'required',
            'language' => 'required'
        ]);
        $user = JWTAuth::parseToken()->toUser();
        $story = new Story();
        $story->video_url = $request->input('video_url');
        $story->language = $request->input('language');
        $story->user_id = $user->id;
        $story->save();
        return response()->json(['story' => $story], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  story id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Story::find($id);
        if(!$story){
            return response()->json(['message' => 'Story not Found'], 401);
        }
        $comments = [
            'comments' => $story->comments
        ];
        return response()->json([
            'id'=>$story->id,
            'video_url' => $story->video_url,
            'language' => $story->language,
            $comments
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {

    }
}
