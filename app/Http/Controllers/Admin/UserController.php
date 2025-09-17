<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $request->validated();

        User::create([
            'name' => $request->name,
            'password' => $request->password,
            'is_admin' => $request->boolean('is_admin')
        ]);

        return back();
    }
}
