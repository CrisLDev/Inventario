<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\PComentario;

use App\User;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioId = auth()->user()->id;
        $posts = Post::where('ps_us_id', $usuarioId)->paginate(5);
        return view('posts.lista', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $todobien = $request->validate([
            'ps_nombre' => 'required|max:120|unique:posts',
            'descripcion' => 'required',
            'postimagen' => 'mimes:jpeg,bmp,png|required'
        ]);

        /*$files=$request->file('postimagen');
        $nombre=$request->nombre;
        $descripcion = $request->descripcion;*/

        if($todobien){ 
            $saveTo = 'public/posts/img';
            $path = $request->file('postimagen')->store($saveTo);
            $filename = substr($path, strlen($saveTo) + 1);
            $post = new Post();
            $post->ps_nombre=$request->ps_nombre;
            $post->ps_descripcion=$request->descripcion;
            $post->ps_us_id = auth()->user()->id;
            $post->ps_path = '/storage/posts/img/'.$filename;
            $post->save();
            return back()->with('mensaje', 'Post Publicado'); 
        }
        return back()->with('error', 'Debes llenar todos los malditos campos IMBÉCIL.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        $comentarios = PComentario::join('users', 'p_comentarios.pcom_us_id', '=', 'users.id')->get();

        return view('posts.post', compact('post', 'comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}