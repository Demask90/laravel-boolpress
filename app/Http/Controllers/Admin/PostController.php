<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
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
            'content' => 'required',
            'cotegory_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|mimes:jpeg,png,bmp,gif,svg,jpg',
        ]);
        // i dati vengono dalvati in $form_data
        $form_data = $request->all();
        $new_post = new Post();

        // verifico se è stata caricata un'immagine
        if (array_key_exists('image', $form_data)) {
            // grazie al metodo Storage::put l'immagine caricata viene salvata in (resources/storage/app/public/post_cover) e recuperiamo il path
            $cover_path = Storage::put('post_covers', $form_data['image']);

            // ora devo salvare il path image nel database aggiungendo, all'array che viene usato nella funzione fill, la chiave cover che contiene il percorso relativo dell'immagine caricata a partire da public/storage
            //in $form_data verrà aggiuntà la proprietà ['cover'] in quanto non esiste nel database
            $form_data['cover'] = $cover_path;
        }

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
        // ATTACH (ALLA CREAZIONE DI UN NUOVO POST MI COLLEGO GIà ID DEI TAGS)
        $new_post->tags()->attach($form_data['tags']);

        return redirect()->route('admin.posts.index')->with('status', 'Il post è stato correttamente salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param   Post $post
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

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|mimes:jpeg,png,bmp,gif,svg,jpg'

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
        // verifico se è stata caricata un'immagine
        if (array_key_exists('image', $form_data)) {
            
            // con il metodo Storage elimino l'immagine che è stata sostuita in fase di modifica(update)
            Storage::delete('$post->cover');
            // salvo l' immagine e recupero il path
            $cover_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $cover_path;
        }

        $post->update($form_data);
        
        // devo verificare che la chiavi tags nel $form data esistano, nel caso in cui non ci siano fammi comunque un sync vuoto (altrimenti non mi effettua la modifica se deseleziono tutti i tags nella modifica)
        // per aggiungere ed eliminare contemporaneamente dei record all'interno della tabella ponte utilizziamo il sync()
        if(array_key_exists('tags', $form_data)) {
            $post->tags()->sync($form_data['tags']);
        } else {
            $post->tags()->sync([]);
        }
        

        return redirect()->route('admin.posts.index')->with('status', 'Post correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {

        $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post eleminato');
    }
}
