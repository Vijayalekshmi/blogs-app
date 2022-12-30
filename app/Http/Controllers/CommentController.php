<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'comment' => ['required', 'string', 'max:255'],
        ]);

        $comment = PostComment::create([
            'post_id' =>$request->post_id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);
        return view('blogs.comments.list')->with(['comment'=>$comment]);
        //return response()->json(['inserted' => true,'comment'=> $request->comment,'user_name'=> auth()->user()->name,'user_image'=> auth()->user()->image ? asset('images/' .auth()->user()->image->url ):''] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComment $postComment)
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostComment $postComment)
    {
        if ($postComment->hasEditPermission(auth()->user())) {
            $validatedData = $request->validate([
                'comment' => 'required',            
            ]);
        
            $postComment->update([
                'comment' => $request->comment           
            ]);
            return response()->json(['comment' => $postComment->comment]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        //
    }
}
