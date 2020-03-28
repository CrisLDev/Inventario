<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;

use Caffeinated\Shinobi\Models\Permission;

use Illuminate\Http\Request;

use Validator;

class RolController extends Controller
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
            $roles = Role::paginate(5);
            return view('roles.lista', compact('roles'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $permissions = Permission::get();
            return view('roles.crear', compact('permissions'));
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
                'name' => 'required|alpha|max:15|min:4|unique:roles',
                'slug' => 'required','alpha','max:3','min:2',
                'description' => 'max:255'
            ]);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $role = new Role();
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->description = $request->description;
            $role->save();
            if($request->get('permissions')){
                $role->permissions()->sync($request->get('permissions'));
            }else{
                $role->permissions()->sync($request->get('permissions')); 
            }
            return back()->with('mensaje', 'Rol agregado con éxito.');
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
            $post = Post::findOrFail($id);
            
            $comentarios = PComentario::join('users', 'p_comentarios.pcom_us_id', '=', 'users.id')->get();
    
            return view('posts.post', compact('post', 'comentarios'));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            return $permissions = auth()->user()->permissions;
            $permissions = Permission::get();
            $role = Role::findOrFail($id);
            return view('roles.editar', compact('role', 'permissions'));
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
                'name' => 'required|alpha|max:15|min:4|unique:roles,name,'.$id,
                'slug' => 'required','alpha','max:3','min:2',
                'description' => 'max:255'
            ]);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->description = $request->description;
            $role->save();
            if($request->get('permissions')){
                $role->permissions()->sync($request->get('permissions'));
            }else{
                $role->permissions()->sync($request->get('permissions')); 
            }
            return back()->with('mensaje', 'Rol agregado con éxito.');
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
            //
        }

        public function ver( Request $request ) {
            if ( $request->ajax() ) {
    
                $role = Role::findOrFail( $request->cnic );
    
                //return dd( $item->id );
                return response()->json( $role );
            }
        }

}