<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Curso;

use Validator;

use Illuminate\Validation\Rule;

class CursoController extends Controller
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
        public function index(Request $request)
        {
            $curso = $request->get('curso'); 
            $descripcion = $request->get('descripcion');
            $cursos = Curso::where( 'activo', '>', '0' )->orderBy( 'id', 'desc' )
            ->curso($curso)
            ->descripcion($descripcion)
            ->paginate( 8 );
            return view('cursos.lista', compact('cursos'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('cursos.crear');
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $todobien = Validator::make($request->all(),[
                'curso' => ['digits_between:1,2','required',Rule::unique('cursos')->where(function ($query)use($request){
                    return $query->where('activo', 1)->where('paralelo', $request->paralelo);
                }),],
                'paralelo' => 'required|max:1|min:1|alpha',
                'descripcion' => 'required|max:255|min:10'
            ]);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $curso = new Curso();
            $curso->curso = $request->curso;
            $curso->paralelo = $request->paralelo;
            $curso->descripcion = $request->descripcion;
            $curso->us_id = auth()->user()->id;
            $curso->save();
            return back()->with('mensaje', 'Curso agregado con éxito.');
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::where('id', $id)->where('activo', '>', '0')->first();
        if(!$curso){
            return abort(404);
        }
        return view('cursos.editar', compact('curso'));
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
        $todobien = Validator::make($request->all(),[
            'curso' => ['digits_between:1,2','required',Rule::unique('cursos')->ignore($id)->where(function ($query)use($request){
                return $query->where('activo', 1)->where('paralelo', $request->paralelo);
            }),],
            'paralelo' => 'required|max:1|min:1|alpha',
            'descripcion' => 'required|max:255|min:10'
        ]);
        if($todobien->fails()){
            return redirect()->back()->withInput()->withErrors($todobien->errors());
        }else{
        $curso = Curso::where('id', $id)->where('activo', '>', '0')->first();
        if(!$curso){
            return abort(404);  
        }
        $curso->curso = $request->curso;
        $curso->paralelo = $request->paralelo;
        $curso->descripcion = $request->descripcion;
        $curso->us_id = auth()->user()->id;
        $curso->save();
        return back()->with('mensaje', 'Curso actualizado con éxito.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Curso::findOrFail( $id );
        $data->activo = 0;
        $data->save();
        return back()->with( 'mensaje', 'Curso Eliminado' );
    }

    public function ver( Request $request ) {

            $data = Curso::find( $request->cnic );

            //return dd( $item->id );
            return response()->json( $data );
    }
}
