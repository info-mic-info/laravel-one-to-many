<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Type;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(); 
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

$types = Type::all();
     return view ('admin.posts.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->validated();

        $slug = Post::generateSlug($request->title);

        $except= '';
        if($request->content != ''){
            $excerpt = substr($request->content, 0 , 147). '...';
        }

        $form_data['slug'] = $slug;

        $newPost = new Post();
        $newPost->fill($form_data);
        $newPost->save();

        return redirect()->route('admin.posts.index')->with('message', 'Post creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $types = Type::all();
      return view ('admin.posts.edit', compact('post','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->validated();

        $slug = Post::generateSlug($request->title, '-');

        $except= '';
        if($request->content != ''){
            $excerpt = substr($request->content, 0 , 147). '...';
        }
     
        $form_data['slug'] = $slug;

        $form_data['excerpt'] = $excerpt;


        $post->update($form_data);

        return redirect()->route('admin.posts.index')->with ('message', $post->title.' èstato correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       $post->delete();
       return redirect()->route('admin.posts.index')->with('message', 'Post cancellato correttamente');
    }
}
