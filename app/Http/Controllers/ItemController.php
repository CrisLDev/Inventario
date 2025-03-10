<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use App\Item;

use PDF;

use Response;

use Validator;

use App\Exports\ExportItems;

use Maatwebsite\Excel\Facades\Excel;

use App\Curso;

class ItemController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index(Request $request) {

        $nombre = $request->get('nombre');
        $curso = $request->get('curso'); 
        $paralelo = $request->get('paralelo'); 
        $descripcion = $request->get('descripcion');

        $usuarioId = auth()->user()->id;
        $items = Item::where( 'activo', '>', '0' )->orderBy( 'id', 'desc' )
        ->nombre($nombre)
        ->curso($curso)
        ->paralelo($paralelo)
        ->descripcion($descripcion)
        ->paginate( 8 );
        return view( 'items.lista', compact( 'items', 'cursos' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $cursos = Curso::where('activo', '>', '0')->get();
        return view( 'items.crear', compact('cursos'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $todobien = Validator::make($request->all(),[
            'nombre' => 'required','string','max:20','min:4',
            'curso' => 'required','alpha_num','max:3','min:2',
            'descripcion' => 'required|max:255|min:10',
            'codigo' => 'required|max:20|min:3|alpha_num',
            'cantidad' => 'required|digits_between:1,6'
        ]);
        if($todobien->fails()){
            return redirect()->back()->withInput()->withErrors($todobien->errors());
        }else{    
        $id = $request->curso;
        $cursos = Curso::select('curso','paralelo')->where('id', $id)->get();
        $curso = $cursos[0]->curso;
        $paralelo = $cursos[0]->paralelo;
        $yaexiste = Item::where('nombre', $request->nombre)->where('curso', $curso)->where('paralelo',$paralelo)->where('activo', '1')->get();
        if(!$yaexiste->isEmpty()){
            return redirect()->back()->with('erroresc', 'Ya haz creado este item!')->withInput();
        }
        $cursosaguardar = $cursos[0]->curso." ".$cursos[0]->paralelo;
        $data = new Item();
        $data->nombre = $request->nombre;
        $data->curso = $cursos[0]->curso;
        $data->descripcion = $request->descripcion;
        $data->codigo = $request->codigo;
        $data->cantidad = $request->cantidad;
        $data->paralelo = $cursos[0]->paralelo;
        $data->cu_id = $request->curso;
        $data->us_id = auth()->user()->id;
        //$item->it_activo = '0';
        $data->save();
        return back()->with('mensaje', 'Item agregado con éxito.');
    }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        return abort(404);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        $items = Item::where('id', $id)->where('activo', '>', '0')->first();
        if(!$items){
            return abort(404);
        }
        $cursos = Curso::where('activo', '>', '0')->get();
        return view('items.editar', compact('items','cursos'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        $todobien = Validator::make($request->all(),[
            'nombre' => ['required',Rule::unique('items')->ignore($id)->where(function ($query)use($request){
                return $query->where('activo', 1)->where('cu_id', $request->curso);
            }),'string','max:20','min:4'],
            'curso' => 'required','alpha_num','max:3','min:2',
            'descripcion' => 'required|max:255|min:10',
            'codigo' => 'required|max:20|min:3|alpha_num',
            'cantidad' => 'required|digits_between:1,6'
        ]);
        if($todobien->fails()){
            return redirect()->back()->withInput()->withErrors($todobien->errors());
        }else{
        $data = Item::where('id', $id)->where('activo', '>', '0')->first();
        if(!$data){
            return abort(404);
        }
        $id = $request->curso;
        $cursos = Curso::select('curso','paralelo')->where('id', $id)->get();
        $cursosaguardar = $cursos[0]->curso." ".$cursos[0]->paralelo;
        $data->nombre = $request->nombre;
        $data->curso = $cursos[0]->curso;
        $data->descripcion = $request->descripcion;
        $data->codigo = $request->codigo;
        $data->cantidad = $request->cantidad;
        $data->paralelo = $cursos[0]->paralelo;
        $data->cu_id = $request->curso;
        $data->us_id = auth()->user()->id;
        //$item->it_activo = '0';
        $data->save();
        return back()->with('mensaje', 'Item editado con éxito.');
    }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        $data = Item::where('id', $id)->where('activo', '>', '0')->first();
        if(!$data){
            return abort(404);
        }
        $data->activo = 0;
        $data->save();
        return back()->with( 'mensaje', 'Item Eliminado' );
    }

    public function export_pdf() {
        // Fetch all customers from database
        $data = Item::where( 'activo', '>', '0' )->orderBy( 'id', 'desc' )->get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView( 'items.pdfi', ['items' => $data] );
        // If you want to store the generated pdf to the server then you can use the store function
        /*$pdf->save( storage_path().'_filename.pdf' );
        */
        // Finally, you can download the file using download function
        $now = new \DateTime();
        return $pdf->download( 'iitems_'.$now->format( 'd-m-Y' ).'_.pdf' );
    }

    public function export_pdf_hoy() {
        // Fetch all customers from database
        $now = new \DateTime();
        $fecha = $now->format( 'Y-m-d' );
        $data = Item::whereDate('created_at', $fecha )->orderBy( 'id', 'desc' )->get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView( 'items.pdfi', ['items' => $data] );
        // If you want to store the generated pdf to the server then you can use the store function
        /*$pdf->save( storage_path().'_filename.pdf' );
        */
        // Finally, you can download the file using download function
        return $pdf->download( 'iitems_'.$now->format( 'd-m-Y' ).'_hoy_.pdf' );
    }

    public function export_exl() {
        $now = new \DateTime();
        return Excel::download( new ExportItems, 'items_'.$now->format( 'd-m-Y' ).'_.xlsx' );
    }

    public function ver( Request $request ) {

            $item = Item::find( $request->cnic );

            //return dd( $item->id );
            return response()->json( $item );
    }
}