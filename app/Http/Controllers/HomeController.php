<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Curso;
use App\User;
use App\Post;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Item::all()->count();
        $items_activos = Item::where('activo', '>', '0')->get()->count();
        $items_inactivos = Item::Where('Activo', '<=', '0')->get()->count();
        $cursos = Curso::all()->count();
        $cursos_activos = Curso::where('activo', '>', '0')->get()->count();
        $cursos_inactivos = Curso::Where('Activo', '<=', '0')->get()->count();
        $users = User::all()->count();
        $users_activos = User::where('activo', '>', '0')->get()->count();
        $users_inactivos = User::Where('Activo', '<=', '0')->get()->count();
        return view('home', compact('items', 'items_activos', 'items_inactivos','cursos','cursos_activos','cursos_inactivos','users','users_activos','users_inactivos'));
    }
}