<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use App\Item;

use PDF;

use Response;

use Validator;

use App\ICategoria;

use App\Exports\ExportItems;

use Maatwebsite\Excel\Facades\Excel;

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

    public function index() {
        $usuarioId = auth()->user()->id;
        $categorias = ICategoria::get();
        $items = Item::where( 'it_activo', '>', '0' )->orderBy( 'id', 'desc' )->paginate( 5 );
        return view( 'items.lista', compact( 'items', 'categorias' ) );
    }

    public function ver( Request $request ) {
        if ( $request->ajax() ) {

            $item = Item::findOrFail( $request->cnic );

            //return dd( $item->id );
            return response()->json( $item );
        }
    }

    public function crear( Request $request ) {

        $validator = Validator::make($request->all(), [
            'it_nombre|max:25' => 'required',Rule::unique('items')->where(function ($query){
                return $query->where('it_Activo', 1);
            }),
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $data = new Item();
            $data->it_nombre = $request->it_nombre;
            $data->it_descripcion = $request->descripcion;
            $data->it_categoria = $request->categoria;
            $data->it_us_id = auth()->user()->id;
            //$item->it_activo = '0';
            $data->save();
            return response()->json ( $data );
        }
    }

    public function editar( Request $request ) {
        $data = Item::find ( $request->id );
        $data->it_nombre = $request->name;
        $data->it_descripcion = $request->descripcion;
        $data->it_categoria = $request->categoria;
        $data->save();
        return response()->json ( $data );
    }

    public function eliminar( Request $request ) {
        $id = $request->id;
        $data = Item::findOrFail( $id );
        $data->it_activo = 0;
        $data->save();
        return response()->json ( $data );
    }

    public function export_pdf() {
        // Fetch all customers from database
        $data = Item::where( 'it_activo', '>', '0' )->orderBy( 'id', 'desc' )->get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView( 'items.pdfi', ['items' => $data] )->setPaper( 'a4', 'landscape' );
        // If you want to store the generated pdf to the server then you can use the store function
        /*$pdf->save( storage_path().'_filename.pdf' );
        */
        // Finally, you can download the file using download function
        $now = new \DateTime();
        return $pdf->download( 'iitems_'.$now->format( 'd-m-Y' ).'_.pdf' );
    }

    public function export_exl() {
        $now = new \DateTime();
        return Excel::download( new ExportItems, 'items_'.$now->format( 'd-m-Y' ).'_.xlsx' );
    }
}