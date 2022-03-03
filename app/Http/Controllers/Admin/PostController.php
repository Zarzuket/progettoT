<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $validationRules = [
        'title' => 'string|required|max:100',
        'description' => 'string|required',
        'user_id' => 'exists:users,id',
        "images" => "nullable",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        // restituist solo i post con l'user id associato al post.
        $posts = Post::where("user_id", $user->id)->get();

        $images = Image::all();
        for($i = 0; $i < count($posts); $i++) {
            $posts[$i]->images = $images->where("post_id", $posts[$i]->id); 
        }

        return view('admin.posts.index',compact('posts','images'));
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
        //validations
        $request->validate($this->validationRules);

        $newPost = new Post();
        $newPost->fill($request->all());
        
        $newPost->slug = $this->getSlug($request->title);

        // SALVA ID UTENTE
        $newPost->user_id = Auth::id();
        // SALVO NUOVO POST
        $newPost->save();

        // SALVA UN IMMAGINE
        if ($request->hasfile('images')) {
            // Utilizzo il nome originale
            $imageData["name"] = explode(".", $request->images->getClientOriginalName())[0];

            // Associo l'appartamento
            $imageData["post_id"] = $newPost->id;

            // Creo uno slug univoco
            $imageData["url"] = Str::of($imageData["name"])->slug("-");  //$this->getImageSlug($imageData['name']);

            // uso lo slug per immagazzinare l'immagine nella cartella public
            // DA SPOSTARE IN RESOURCES???
            $request->images->move(public_path() . "/images/", $imageData["url"]);

            // salvo i dati dell'immagine nel database
            Image::create($imageData);
        }

        return redirect()->route("admin.posts.index")->with('success',"Il post è stato creato");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        // se il post con l'user id è diverso dall'autentificazione non restituisce il post.
        if ($post->user_id != Auth::id()) {
            abort("403");
        }
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validations
        $request->validate($this->validationRules);

        if($post->title != $request->title) {
            $post->slug = $this->getSlug($request->title);
        }

        $post->fill($request->all());

        $post->save();

        return redirect()->route("admin.posts.index")->with('success',"Il post {$post->id} è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success',"Il Post {$post->id} è stato eliminato.");
    }
    private function getSlug($title)
    {
        $slug = Str::of($title)->slug('-');

        $postExist = Post::where("slug", $slug)->first();

        $count = 2;
        
        while($postExist) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $postExist = Post::where("slug", $slug)->first();
            $count++;
        }

        return $slug;
    }
}
