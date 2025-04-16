<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user->load(['company']));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user->load(['company']));
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Kullanıcı başarıyla silindi.'], 200);
    }
}
