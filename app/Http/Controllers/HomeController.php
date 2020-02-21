<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
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
        $items_activos = Item::where('it_activo', '>', '0')->get()->count();
        $items_inactivos = Item::Where('it_Activo', '<=', '0')->get()->count();
        return view('home', compact('items', 'items_activos', 'items_inactivos'));
    }

    public function welcome(){
        $posts = Post::all();
        return view('welcome', compact('posts'));
    }
}