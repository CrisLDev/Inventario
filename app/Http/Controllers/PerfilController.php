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
            $perfil = Perfil::where('us_id', $id)->where('activo', '>','0')->first();
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
                'imgurl' => 'mimes:jpg,jpeg,bmp,png|max:1024',
                'direccion' => 'required','alpha','max:40','min:4',
                'edad' => 'required|digits_between:1,2',
                'ntelefono' => 'required|max:20|min:3|digits_between:1,10',
            ]);
            $attributeNames = array(
                'nombres' => 'nombres',
                'apellidos' => 'apellidos',
                'imgurl' => 'imgen',
                'ntelefono' => 'telefono',   
             );
             $todobien->setAttributeNames($attributeNames);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            if($request->imgurl){
                $saveTo = 'public/userImage';
                $path = $request->file('imgurl')->store($saveTo);
                $filename = substr($path, strlen($saveTo) + 1);
            }
            $data = new Perfil();
            $data->nombres = $request->nombres;
            $data->apellidos = $request->apellidos;
            $data->edad = $request->edad;
            $data->direccion = $request->direccion;
            $data->ntelefono = $request->ntelefono;
            if($request->imgurl){
                $data->imgurl = '/storage/userImage/'.$filename;
            }else{
                $data->imgurl = 'imgs/no-image.jpg';
            }
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
            $uid = auth()->user()->id;
            $perfil = Perfil::where('us_id', $uid)->where('activo', '>', '0')->first();
            if(!$perfil){
                return redirect('/perfil')->with('erroresc', '¡Este no es tu perfil o ha sido eliminado!');
            }
            $user = User::where('id', $uid)->first();
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
                'imgurl' => 'mimes:jpg,jpeg,bmp,png|max:1024',
                'direccion' => 'required','alpha','max:40','min:4',
                'edad' => 'required|digits_between:1,2',
                'ntelefono' => 'required|max:20|min:3|digits_between:0,10',
                'name' => ['required', 'string', 'max:255', 'min:6', Rule::unique('users')->ignore($id)->where(function ($query)use($request){
                    return $query->where('activo', 1)->where('email', $request->email);
                }),],
                'email' => ['required', 'email:rfc,dns', 'max:255', Rule::unique('users')->ignore($id)->where(function ($query)use($request){
                    return $query->where('activo', 1)->where('name', $request->name);
                }),],
                'password' => ['nullable','string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed'],
            ]);
            $attributeNames = array(
                'nombres' => 'nombres',
                'apellidos' => 'apellidos',
                'imgurl' => 'imgen',
                'ntelefono' => 'telefono',
                'name' => 'nombre',
                'password' => 'contraseña'     
             );
            $todobien->setAttributeNames($attributeNames);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $uid = auth()->user()->id;
            $user = User::where('id', $uid)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password){
                $user->password = $password = bcrypt($request->password);
            }
            $user->save();
            $data = Perfil::where('us_id', $uid)->first();
            if(!$data){
                return redirect('/perfil')->with('erroresc', '¡Este no es tu perfil!');
            }
            if(!$request->get('antigua')){
            if($request->imgurl){
                $imantigua = $data->imgurl;
                if(Storage::disk('public')->path($imantigua)){
                   $nombre = class_basename($imantigua);
                    Storage::disk('public')->delete('userImage/'.$nombre);
                }
                $saveTo = 'public/userImage';
                $path = $request->file('imgurl')->store($saveTo);
                $filename = substr($path, strlen($saveTo) + 1);
            }
        }
            $data->nombres = $request->nombres;
            $data->apellidos = $request->apellidos;
            $data->edad = $request->edad;
            $data->direccion = $request->direccion;
            $data->ntelefono = $request->ntelefono;
            if(!$request->get('antigua')){
                if($request->imgurl){
                    $data->imgurl = '/storage/userImage/'.$filename;
                }else{
                    $data->imgurl = 'imgs/no-image.jpg';
                }
            }
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
            $uid = auth()->user()->id;
            $data = Perfil::where('us_id', $uid)->where('activo','>','0')->first();
            if(!$data){
                return redirect('/perfil')->with('erroresc', '¡Este no es tu perfil!');
            }
            $data->activo = 0;
            $data->save();
            return back()->with('mensaje', 'Perfil eliminado con éxito.');
        }

        public function ver( Request $request ) {
            if ( $request->ajax() ) {
    
                $user = User::findOrFail( $request->cnic );
    
                //return dd( $item->id );
                return response()->json( $user );
            }
        }

        public function allUser()
        {
            $perfiles = Perfil::where('activo', '>','0')->paginate(5);
            $roles = auth()->user()->roles;
            return view('perfiles.todos', compact('perfiles', 'roles'));
        }

}