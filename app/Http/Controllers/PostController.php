<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;

use App\Models\PostViewTrack;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $posts= Post::orderBy('created_at', 'DESC')->paginate(8);
        return view('blogs.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
          
          // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
           
            // Create a new post instance
            $post = new Post;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = Auth::id();          
            $post->save();
            if( $request->image){               
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('images'), $imageName);
                    $image = new Image;
                    $image->imageable_id = $post->id; 
                    $image->imageable_type = Post::class; 
                    $image->url = $imageName;
                    $image->save();
            }
           
            // Redirect to the post show page
            session()->flash('success', 'Post added successfully!');
            return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {  
        $comments=$post->comments()->paginate(15);
       
        return view('blogs.show')->with(['post'=> $post,'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        if (auth()->id() == $post->user_id) {
             return view('blogs.edit')->with(['post'=> $post]);
        }
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->id() == $post->user_id) {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Update the post
            $post->title = $request->title;
            $post->content = $request->content;

            // Handle the image upload if there is a new image
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($post->image) {
                    Storage::delete($post->image);
                    Image::where(['imageable_id'=>$post->id,'imageable_type' => Post::class])->delete();

                }
                // Upload the new image
            
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $image = new Image;
                $image->imageable_id = $post->id; 
                $image->imageable_type = Post::class; 
                $image->url = $imageName;
                $image->save();
            }

            // Save the post to the database
            $post->save();
            session()->flash('success', 'Post updated successfully!');
            // Redirect to the appropriate page
            return redirect()->route('posts.index');
        }
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function like(Post $post)
    {
        $user = auth()->user();
        if ($user->likedPosts()->where('post_id', $post->id)->exists()) {
            $user->likedPosts()->detach($post);
            return response()->json(['liked' => false]);
        } else {
            $user->likedPosts()->attach($post);
            return response()->json(['liked' => true]);
        }
    }
}
