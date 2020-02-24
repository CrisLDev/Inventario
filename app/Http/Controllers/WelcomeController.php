<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
        $posts = Post::limit(3)->latest()->get();
        return view('welcome', compact('posts'));
    }
}
