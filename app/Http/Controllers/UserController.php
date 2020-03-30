<?php

namespace App\Http\Controllers;

use App\User;

use App\Perfil;

use Validator;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\Request;

class UserController extends Controller
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
            $users = User::where( 'activo', '>', '0' )->orderBy( 'id', 'desc' )->paginate( 8 );
            return view('users.lista', compact('users'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return abort(404);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            return abort(404);
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
            $roles = Role::get();
            $user = User::findOrFail($id);
            return view('users.editar', compact('user', 'roles'));
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
            if($request->get('roles')){
                $count = count($request->get('roles'));
                if($count >= 2){
                    return redirect()->back()->with('erroresc', '¡Haz seleccionado más de un rol!')->withInput();
                }else{
                $todobien = Validator::make($request->all(),[
                    'name' => ['required','alpha_num','max:26','min:6',Rule::unique('users')->ignore($id)->where(function ($query){
                        return $query->where('activo', 1);
                    })],
                    'email' => ['required','email:rfc,dns','max:40','min:10',Rule::unique('users')->ignore($id)->where(function ($query){
                        return $query->where('activo', 1);
                    })],
                    'password' => ['nullable', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed'],
                ]);
                if($todobien->fails()){
                    return redirect()->back()->withInput()->withErrors($todobien->errors());
                }else{
                //Actualizamos usuario
                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                if($request->password){
                    $user->password = $password = bcrypt($request->password);
                }
                $user->save();
                //Actualizamos roles
                if($request->get('roles')){
                $user->roles()->sync($request->get('roles'));
                }else{
                    $user->roles()->sync($request->get('roles'));
                }
                return back()->with('mensaje', 'Usuario actualizado con éxito.');
            }
        }
            }else{
                $todobien = Validator::make($request->all(),[
                    'name' => ['required','alpha_num','max:26','min:6',Rule::unique('users')->ignore($id)->where(function ($query){
                        return $query->where('activo', 1);
                    })],
                    'email' => ['required','email:rfc,dns','max:40','min:10',Rule::unique('users')->ignore($id)->where(function ($query){
                        return $query->where('activo', 1);
                    })],
                    'password' => ['nullable','string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed'],
                ]);
                if($todobien->fails()){
                    return redirect()->back()->withInput()->withErrors($todobien->errors());
                }else{
                //Actualizamos usuario
                $user = User::findOrFail($id);
                if($request->password){
                    $user->password = $password = bcrypt($request->password);
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                //Actualizamos roles
                if($request->get('roles')){
                $user->roles()->sync($request->get('roles'));
                }else{
                    $user->roles()->sync($request->get('roles'));
                }
                return back()->with('mensaje', 'Usuario actualizado con éxito.');
            }
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
            $user = User::where('id',$id)->where('activo', '>', '0')->first();
            $perfil= Perfil::where('us_id',$id)->where('activo', '>', '0')->first();
            if($perfil){
                if($perfil->imgurl){
                    $imantigua = $perfil->imgurl;
                    if(Storage::disk('public')->path($imantigua)){
                       $nombre = class_basename($imantigua);
                        Storage::disk('public')->delete('userImage/'.$nombre);
                    }
                }
                $perfil->imgurl = 'imgs/no-image.jpg';
                $perfil->activo = 0;
                $perfil->save();
            }
            $user->activo = 0;
            $user->save();
            return back()->with('mensaje', 'Usuario editado con éxito.');
        }

        public function ver( Request $request ) {
    
                $user = User::find( $request->cnic );
    
                //return dd( $item->id );
                return response()->json( $user );
        }

}