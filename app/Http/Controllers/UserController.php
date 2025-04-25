<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(){
        $data = array(
            "title" => "Pengguna"
        );

        return view('user.user', $data);
    }
}