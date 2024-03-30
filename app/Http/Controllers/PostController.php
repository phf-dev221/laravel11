<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Annotations\PostsAnnotationController;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Afficher une liste de ressources (posts)
        $posts = Post::all();
        return response()->json(['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Créer un nouveau post avec les données reçues
        $post = new Post();
        $post->libelle = $request->input('libelle');
        $post->contenu = $request->input('contenu');
        $post->user_id = auth()->user()->id ? auth()->user()->id : null;
        $post->image = $request->input('image');
        // $post->image = $request->file('image')->store('images', 'public');
        $post->save();
        return response()->json(['post' => $post], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Afficher un post spécifique
        return response()->json(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Mettre à jour un post existant avec les données reçues
        $post->libelle = $request->input('libelle');
        $post->contenu = $request->input('contenu');
        $post->user_id = $request->input('user_id');
        $post->image = $request->input('image');
        $post->save();
        return response()->json(['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Supprimer un post existant
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
