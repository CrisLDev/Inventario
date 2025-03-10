<?php

namespace App\Http\Controllers;

use App\User;

use App\Perfil;

use Validator;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

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
        public function index(Request $request)
        {
            $nombre = $request->get('nombre'); 
            $email = $request->get('email');
            $users = User::where( 'activo', '>', '0' )->orderBy( 'id', 'desc' )
            ->name($nombre)
            ->email($email)
            ->paginate( 8 );
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
            $usuariorol = DB::table('role_user')->where('user_id', $id)->first();
            if($usuariorol){
                $usuarioId = $usuariorol->{'role_id'};
                $usuarioroles = Role::where('id', $usuarioId)->first();
                $userAdmin = $usuarioroles->name;
                $roles = auth()->user()->roles;
                $result = collect($roles)->contains('name','Admin');
                if($userAdmin == 'Admin'){
                    if($result){
                        $user = User::findOrFail($id);
                    $roles = Role::get();
                    return view('users.editar', compact('user', 'roles'));
                    }else{
                        return redirect()->back()->with('erroresc', '¡No tienes permiso!')->withInput();
                    }
                }else{
                    $user = User::findOrFail($id);
                    $roles = Role::get();
                    return view('users.editar', compact('user', 'roles'));
                }

            }else{
                $user = User::findOrFail($id);
                $roles = Role::get();
                return view('users.editar', compact('user', 'roles'));
            }
            
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
            $usuariorol = DB::table('role_user')->where('user_id', $id)->first();
            $aarrayy = $request->get('roles');
            if($request->get('roles')){
            $arra1 = $aarrayy[0];
            $usuarioroles = Role::where('id', $arra1)->first();
            $hola = $usuarioroles->name;
            if($hola == 'Admin'){
                $hola2 = count($request->get('roles'));
                if($hola2 > 1){
                    return redirect()->back()->with('erroresc', '¡Muchos campos seleccionados!')->withInput();
                }else{
                    if($usuariorol){
                        $usuarioId = $usuariorol->{'role_id'};
                        $usuarioroles = Role::where('id', $usuarioId)->first();
                        $usuariorolu = $usuarioroles->name;
                        $roles = auth()->user()->roles;
                        $result = collect($roles)->contains('name','Admin');
                        if($result){
                            if($usuariorolu !== 'Admin'){
                                if($request->get('roles')){
                                    $count = count($request->get('roles'));
                                    if($count >= 5){
                                        return redirect()->back()->with('erroresc', '¡Haz seleccionado más de un rol!')->withInput();
                                    }else{
                                    $todobien = Validator::make($request->all(),[
                                        'name' => ['required','string','max:26','min:6',Rule::unique('users')->ignore($id)->where(function ($query){
                                            return $query->where('activo', 1);
                                        })],
                                        'email' => ['required','email:rfc,dns','max:40','min:10',Rule::unique('users')->ignore($id)->where(function ($query)use($id){
                                            return $query->where('id', $id);
                                        })],
                                        'password' => ['nullable', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed'],
                                    ]);
                                    $attributeNames = array(
                                        'name' => 'nombre',
                                        'password' => 'contraseña'     
                                     );
                                     $todobien->setAttributeNames($attributeNames);
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
                                    $attributeNames = array(
                                        'name' => 'nombre',
                                        'password' => 'contraseña'     
                                     );
                                     $todobien->setAttributeNames($attributeNames);
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
                            }else{
                                return redirect()->back()->with('erroresc', '¡Ya tienes este permiso!')->withInput();
                            }
                        }else{
                            return redirect()->back()->with('erroresc', '¡No tienes permisos!')->withInput();
                        }
                    } 
                }
                }else{
                    if($request->get('roles')){
                        $count = count($request->get('roles'));
                        if($count >= 5){
                            return redirect()->back()->with('erroresc', '¡Haz seleccionado más de un rol!')->withInput();
                        }else{
                        $todobien = Validator::make($request->all(),[
                            'name' => ['required','string','max:26','min:6',Rule::unique('users')->ignore($id)->where(function ($query){
                                return $query->where('activo', 1);
                            })],
                            'email' => ['required','email:rfc,dns','max:40','min:10',Rule::unique('users')->ignore($id)->where(function ($query)use($id){
                                return $query->where('id', $id);
                            })],
                            'password' => ['nullable', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed'],
                        ]);
                        $attributeNames = array(
                            'name' => 'nombre',
                            'password' => 'contraseña'     
                         );
                         $todobien->setAttributeNames($attributeNames);
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
                        $attributeNames = array(
                            'name' => 'nombre',
                            'password' => 'contraseña'     
                         );
                         $todobien->setAttributeNames($attributeNames);
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
            $attributeNames = array(
                'name' => 'nombre',
                'password' => 'contraseña'     
             );
             $todobien->setAttributeNames($attributeNames);
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

            $usuariorol = DB::table('role_user')->where('user_id', $id)->first();
            if($usuariorol){
                $usuarioId = $usuariorol->{'role_id'};
                $usuarioroles = Role::where('id', $usuarioId)->first();
                $userAdmin = $usuarioroles->name;
                $roles = auth()->user()->roles;
                $result = collect($roles)->contains('name','Admin');
                if($userAdmin == 'Admin'){
                    if($result){
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
                            return back()->with('mensaje', 'Usuario eliminado con éxito.');
                    }else{
                        return redirect()->back()->with('erroresc', '¡No tienes permiso!')->withInput();
                    }
                }else{
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

            }else{
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
        }

        public function ver( Request $request ) {
    
                $user = User::find( $request->cnic );
    
                //return dd( $item->id );
                return response()->json( $user );
        }

}