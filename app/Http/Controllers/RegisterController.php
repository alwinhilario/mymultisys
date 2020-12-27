<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['required', 'min:3']
        ]);



        return $this->response('User successfully registered', 201);
    }
}
