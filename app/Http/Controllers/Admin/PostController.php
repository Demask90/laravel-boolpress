<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

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
    public function create(Request $request)
    {
        return view('admin.posts.create');

        // $form_data = $request->all();

        // $new_post = new Post();
        // $new_post->fill($form_data);

        // // Titolo: il mio post
        // // Slug: il-mio-post

        // $slug = Str::slug($new_post->title, '-');

        
        // $slug_presente = Post::where('slug', $slug)->first();

        // $contatore = 1;
        // while($slug_presente) {
        //     $slug = $slug . '-' . $contatore;
        //     $slug_presente = Post::where('slug', $slug)->first();
        //     $contatore++;
        // }

        // $new_post->slug = $slug;
        // $new_post->save();

        // return redirect()->route('admin.posts.index')->with('inserted', 'il post è stato correttamente salvato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $form_data = $request->all();

        $new_post = new Post();
        $new_post->fill($form_data);
        
        // '-' posso modificare il paramentro di riferimento dello slug 
        $slug = Str::slug($new_post->title, '-');

        $slug_presente = Post::where('slug', $slug)->first();

        $contatore = 1;
        while($slug_presente) {
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug) ->first();
            $contatore++;
        }

        $new_post->slug = $slug;
        $new_post->save();
        return redirect()->route('admin.posts.index')->with('status', 'Il post è stato correttamente salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {

        if (!$post) {
            abort(404);
        }
        return view('admin.posts.show',compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post) {
            abort(404);
        }
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // per prima cosa valido i dati che arrivano dal form
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $form_data = $request->all();
        // verifico se il titolo ricevuto dal form è diverso dal vecchio titolo
        if ($form_data['title'] != $post->title) {
            // è stato modificato il titolo, quindi devo modificare anche lo slug
            $slug = Str::slug($form_data['title'], '-');

            $slug_presente = Post::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente) {
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }

            $form_data['slug'] = $slug;
        }
        $post->update($form_data);
        return redirect()->route('admin.posts.index')->with('status', 'Post correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post eleminato');
    }
}