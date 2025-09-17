<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

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

    public function edit(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', Password::default()],
        ]);

        $user->name = $validated['name'];

        if(!empty($validated['password']))
        {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function update(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }
}
