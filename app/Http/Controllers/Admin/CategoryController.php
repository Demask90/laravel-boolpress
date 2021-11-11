<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Post;
use App\Tag;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
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
        return view('admin.categories.create', compact('categories', 'tags'));
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
            'name' => 'required|max:255',
            'content' => 'required',
            'id' => 'exists:id',
        ]);

        $form_data = $request->all();

        $new_category = new Category();
        $new_category->fill($form_data);
        
        // '-' posso modificare il paramentro di riferimento dello slug 
        $slug = Str::slug($new_category->name, '-');

        $slug_presente = Category::where('slug', $slug)->first();

        $contatore = 1;
        while($slug_presente) {
            $slug = $slug . '-' . $contatore;
            $slug_presente = Category::where('slug', $slug)->first();
            $contatore++;
        }

        $new_category->slug = $slug;
        $new_category->save();
       
        return redirect()->route('admin.categories.index')->with('status', 'La categoria è stata correttamente salvata');

        // $categories = Category::all();
        // $tags = Tag::all();
        // return view('admin.categories.create', compact('categories', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (!$category) {
            abort(404);
        }
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('id', $id)->first();
        return view('admin.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
        ]);

        $form_data = $request->all();
        
        // verifico se il titolo ricevuto dal form è diverso dal vecchio titolo
        if ($form_data['name'] != $category->name) {

            // è stato modificato il titolo, quindi devo modificare anche lo slug
            $slug = Str::slug($form_data['name'], '-');

            $slug_presente = Category::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente) {
                $slug = $slug . '-' . $contatore;
                $slug_presente = Category::where('slug', $slug)->first();
                $contatore++;
            }

            $form_data['slug'] = $slug;
        }
        $category->update($form_data);
        
        return redirect()->route('admin.categories.index')->with('status', 'La categoria è stata correttamente aggiornata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Categoria eliminata');
    }
}
