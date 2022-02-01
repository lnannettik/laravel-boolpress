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
    public function create()
    {
         return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        //1. param = regole validazione
        //2 param = error message custom

        // $request->validate([
        //     'title' => 'required|max:255',
        //     'content' => 'required'
        // ], [
        //     'required' => 'The :attribute is a required filed!',
        //     'max' => 'Max :max characters allowed for the :attribute',
        // ]);
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();

        // CREA NUOVO POST
        $new_post = new Post();

        // GEN SLUG UNIVOCO
        //title-lorem-n
        $slug = Str::slug($data['title'], '-');
        $count = 1;
        $base_slug = $slug;

        // eseguo il ciclo se ho trovato un post con lo SLUG uguale
        while(Post::where('slug', $slug)->first()) {

            //gen un nuovo slug con contatore
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        $new_post->fill($data); // <- FILLABLE
        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // VALIDAZIONE

      // Metodo 1

        // $request->validate([
        //     'title' => 'required|max:255',
        //     'content' => 'required'
        // ], [
        //     'required' => 'The :attribute is a required filed!',
        //     'max' => 'Max :max characters allowed for the :attribute',
        // ]);

        
      // Metodo 2 - con i richiami delle funzioni (vedi sotto)
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();

        // UPDATE RECORD
        $post = Post::find($id);

        // Update SOLO se lo slug è cambiato
        if($data['title'] != $post->title) {
            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;

            // eseguo il ciclo se ho trovato un post con lo SLUG uguale
            while(Post::where('slug', $slug)->first()) {

                //gen un nuovo slug con contatore
                $slug = $base_slug . '-' . $count;
                $count++;
            }        
            $data['slug'] = $slug;
        }
        else {
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        return redirect()->route('admin.posts.show', $post->slug);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //---------------------------------------- Validation Rules ----------------------------------------------------//

    private function validation_rules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required'
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'The :attribute is a required filed!',
            'max' => 'Max :max characters allowed for the :attribute',
        ];
    }



}
