<?php

namespace App\Http\Controllers;

use App\Jobs\RegisterMailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:3'
        ], [
            'email.unique' => 'Email already taken.'
        ]);

        // Create new User Model
        User::create(array_merge($data, [
            'password' => bcrypt($data['password'])
        ]));

        // Create new User Model
        dispatch(new RegisterMailJob($data['email']));

        return $this->response('User successfully registered', 201);
    }
}
