<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
        return redirect('/login');
    }
}
