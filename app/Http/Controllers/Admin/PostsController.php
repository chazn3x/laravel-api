<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    // Validation rules
    protected $validations = [
        'title' => 'required|string|max:100',
        'content' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
        'tags' => 'nullable|exists:tags,id',
    ];

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

        return view( 'admin.posts.create', compact('categories', 'tags') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Validazione dati
        $request->validate($this->validations);
        
        // Creazione del post
        $data = $request->all();

        $newPost = new Post();
        
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->published = isset($data['published']);

        $slug = Str::of($newPost->title)->slug('-');
        
        $i = 1;
        while ( Post::where('slug', $slug)->first() ) {

            $slug = Str::of($newPost->title)->slug('-') . "-{$i}";
            $i++;

        }

        $newPost->slug = $slug;

        isset($data['category_id']) ? $newPost->category_id = $data['category_id'] : '';

        $newPost->save();

        if ( isset($data['tags']) ) {
            $newPost->tags()->sync($data['tags']);
        }

        // Redirect al post
        return redirect()->route('posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('admin.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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

        $data = $request->all();

        // Se il metodo è PUT modifico tutto il post, altrimenti aggiorno solo lo stato di pubblicazione
        if ($data['_method'] === 'PUT') {

            // Validazione
            $request->validate($this->validations);

            // Se cambia il titolo
            if ( $post->title != $data['title'] ) {

                $post->title = $data['title'];
            
                $slug = Str::of($post->title)->slug('-');
    
                // Se cambia lo slug
                if ($post->slug != $slug) {
    
                    $i = 1;
                    while ( Post::where('slug', $slug)->first() ) {
                        
                        $slug = Str::of($post->title)->slug('-') . "-{$i}";
                        $i++;
                        
                    }
                    
                    $post->slug = $slug;
    
                }

            }

            isset($data['category_id']) ? $post->category_id = $data['category_id'] : '';
            
        }
        
        $post->published = isset( $data['published'] );
        
        $post->save();

        if ( isset($data['tags']) ) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Cancellazione post
        $post->delete();

        return redirect()->route('posts.index');
    }
}
