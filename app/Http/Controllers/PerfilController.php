<?php

namespace App\Http\Controllers;

use App\User;

use App\Perfil;

use Validator;

use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\Request;

class PerfilController extends Controller
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
            $id = auth()->user()->id;
            $perfil = Perfil::where('us_id', $id)->first();
            $roles = auth()->user()->roles;
            return view('perfiles.ver', compact('perfil', 'roles'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('perfiles.crear');
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
                'nombres' => ['required','string','max:20','min:4',Rule::unique('perfils')->where(function ($query)use($request){
                    return $query->where('activo', 1)->where('apellidos', $request->apellidos);
                }),],
                'apellidos' => 'required','string','max:20','min:4',
                'imgurl' => 'mimes:jpg,jpeg,bmp,png|required',
                'direccion' => 'required','alpha','max:40','min:4',
                'edad' => 'required|digits_between:1,2',
                'ntelefono' => 'required|max:20|min:3|digits_between:1,10',
            ]);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $saveTo = 'public/userImage';
            $path = $request->file('imgurl')->store($saveTo);
            $filename = substr($path, strlen($saveTo) + 1);
            $data = new Perfil();
            $data->nombres = $request->nombres;
            $data->apellidos = $request->apellidos;
            $data->edad = $request->edad;
            $data->direccion = $request->direccion;
            $data->ntelefono = $request->ntelefono;
            $data->imgurl = '/storage/userImage/'.$filename;
            $data->us_id = auth()->user()->id;
            //$item->it_activo = '0';
            $data->save();
            return redirect('/perfil')->with('mensaje', 'Perfil creado con éxito.');
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
            $perfil = Perfil::where('us_id', $id)->first();
            $user = User::findOrFail($id);
            return view('perfiles.editar', compact('user', 'perfil'));
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
                'nombres' => ['required','string','max:20','min:4',Rule::unique('perfils')->ignore($id)->where(function ($query)use($request){
                    return $query->where('activo', 1)->where('apellidos', $request->apellidos);
                }),],
                'apellidos' => 'required','string','max:20','min:4',
                'imgurl' => 'mimes:jpg,jpeg,bmp,png|required',
                'direccion' => 'required','alpha','max:40','min:4',
                'edad' => 'required|digits_between:1,2',
                'ntelefono' => 'required|max:20|min:3|digits_between:1,10',
            ]);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $data = Perfil::where('us_id', $id)->first();
            $imantigua = $data->imgurl;
            if(Storage::disk('public')->path($imantigua)){
               $nombre = class_basename($imantigua);
                Storage::disk('public')->delete('userImage/'.$nombre);
            }
            $saveTo = 'public/userImage';
            $path = $request->file('imgurl')->store($saveTo);
            $filename = substr($path, strlen($saveTo) + 1);
            $data->nombres = $request->nombres;
            $data->apellidos = $request->apellidos;
            $data->edad = $request->edad;
            $data->direccion = $request->direccion;
            $data->ntelefono = $request->ntelefono;
            $data->imgurl = '/storage/userImage/'.$filename;
            $data->us_id = auth()->user()->id;
            //$item->it_activo = '0';
            $data->save();
            return redirect('/perfil')->with('mensaje', 'Perfil actualizado con éxito.');
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
            $user = User::findOrFail($id);
            $user->activo = 0;
            $user->save();
            return back()->with('mensaje', 'Usuario editado con éxito.');
        }

        public function ver( Request $request ) {
            if ( $request->ajax() ) {
    
                $user = User::findOrFail( $request->cnic );
    
                //return dd( $item->id );
                return response()->json( $user );
            }
        }

}