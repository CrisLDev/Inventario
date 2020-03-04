<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ICategoria;

class IcategoriaController extends Controller
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
        $categorias = ICategoria::where('icat_activo', '>', '0')->get();
        return view('categorias.lista', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new ICategoria();
        $categoria->icat_nombre=$request->nombre;
        $categoria->icat_descripcion=$request->descripcion;
        $categoria->icat_us_id = auth()->user()->id;
        $categoria->save();

        return back()->with('mensaje', 'Categoria Agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = ICategoria::findOrFail($id);
        return view('categorias.editar', compact('categoria'));
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
        $categoriaUpdate = ICategoria::findOrFail($id);
        $categoriaUpdate->icat_nombre=$request->nombre;
        $categoriaUpdate->icat_descripcion=$request->descripcion;
        $categoriaUpdate->save();
        return back()->with('mensaje', 'Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoriaDestroy = ICategoria::findOrFail($id);
        $categoriaDestroy->icat_activo= 0;
        //$categoriaDestroy->delete();
        $categoriaDestroy->save();
        return back()->with('mensaje', 'Categoria Eliminada');
    }
}
