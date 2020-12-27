<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data))
            return $this->error('Invalid Credentials', 401);

        return $this->response('Successfull Logged In', 200);
    }
}
