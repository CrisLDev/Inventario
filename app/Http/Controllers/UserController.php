<?php

namespace App\Http\Controllers;

use App\User;

use Validator;

use Illuminate\Validation\Rule;

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
            $todobien = Validator::make($request->all(),[
                'name' => ['required','alpha_num','max:26','min:6',Rule::unique('users')->ignore($id)->where(function ($query){
                    return $query->where('activo', 1);
                })],
                'email' => ['required','email:rfc,dns','max:40','min:10',Rule::unique('users')->ignore($id)->where(function ($query){
                    return $query->where('activo', 1);
                })],
            ]);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            //Actualizamos usuario
            $user = User::findOrFail($id);
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