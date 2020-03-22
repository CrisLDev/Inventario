<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use App\ICategoria;

class ItemController extends Controller
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
        $categorias = ICategoria::get();
        $items = Item::where('it_activo', '>', '0')->paginate(5);
        return view('items.lista', compact('items', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = ICategoria::get();
        return view('items.crear', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->it_nombre=$request->name;
        $item->it_descripcion=$request->descripcion;
        $item->it_categoria=$request->categoria;
        $item->it_us_id = auth()->user()->id;
        //$item->it_activo = '0';
        $item->save();

        return response()->json ( $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('items.item', compact('item'));
    }

    public function trae(Request $request){
        if($request->ajax()) {
          
            $item = Item::findOrFail($request->cnic);
           
            //return dd($item->id);
            return response()->json($item);
        }
}

public function crearr(Request $request)
    {

        $todobien = $request->validate([
            'it_nombre' => 'required|max:120|unique:items'
        ]);

        if($todobien){
            $data = new Item();
            $data->it_nombre=$request->it_nombre;
            $data->it_descripcion=$request->descripcion;
            $data->it_categoria=$request->categoria;
            $data->it_us_id = auth()->user()->id;
            //$item->it_activo = '0';
            $data->save();
            return response()->json ($data);
        }
    }

public function editar(Request $request){
    $data = Item::find ( $request->id );
    $data->it_nombre = $request->name;
    $data->it_descripcion = $request->descripcion;
    $data->it_categoria=$request->categoria;
    $data->save();
    return response()->json ( $data);
}

public function eliminar(Request $request){
    $id = $request->id;
    $data = Item::findOrFail($id);
    $data->it_activo= 0;
    $data->save();
    return response()->json ($data);
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
    public function update(Request $request)
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