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
            $roles = Role::orderBy( 'id', 'desc' )->paginate( 8 );
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
            if(($request->get('special'))&&($request->get('permissions'))){
                return redirect()->back()->with('erroresc', '¡Haz seleccionado campos imcompatibles!')->withInput();
            }else{
                $cantidad = $request->get('permissions');
                if($cantidad || ($request->get('special'))){
                $mucho = count($cantidad);
                if($mucho >= 15){
                    return redirect()->back()->with('erroresc', '¡Crea un usuario administrador!')->withInput();
                }else{
                    $todobien = Validator::make($request->all(),[
                        'name' => 'required|alpha|max:15|min:4|unique:roles',
                        'slug' => 'required','alpha','max:3','min:2',
                        'description' => 'max:255|required'
                    ]);
                    $attributeNames = array(
                        'name' => 'nombre',
                        'slug' => 'acrónimo',
                        'description' => 'descripcion'     
                     );
                     $todobien->setAttributeNames($attributeNames);
                    if($todobien->fails()){
                        return redirect()->back()->withInput()->withErrors($todobien->errors());
                    }else{
                    $role = new Role();
                    $role->name = $request->name;
                    $role->slug = $request->slug;
                    $role->special = $request->get('special');
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
            }else{
                return redirect()->back()->with('erroresc', '¡Seleciona algún permiso o acceso!')->withInput();
            }
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
            if(($request->get('special'))&&($request->get('permissions'))){
                return redirect()->back()->with('erroresc', '¡Haz seleccionado campos imcompatibles!')->withInput();
            }else{
            $todobien = Validator::make($request->all(),[
                'name' => 'required|alpha|max:15|min:4|unique:roles,name,'.$id,
                'slug' => 'required','alpha','max:3','min:2',
                'description' => 'max:255|required'
            ]);
            $attributeNames = array(
                'name' => 'nombre',
                'slug' => 'acrónimo',
                'description' => 'descripcion'     
             );
             $todobien->setAttributeNames($attributeNames);
            if($todobien->fails()){
                return redirect()->back()->withInput()->withErrors($todobien->errors());
            }else{
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->special = $request->get('special');
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
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $data = Role::where('id', $id)->first();
            if(!$data){
                return abort(404);
            }else{
                $data->delete();
            }
            return back()->with( 'mensaje', 'Rol Eliminado' );
        }

        public function ver( Request $request ) {
    
                $role = Role::find( $request->cnic );
    
                //return dd( $item->id );
                return response()->json( $role );
        }

}