<?php

namespace App\Http\Controllers;


use App\Constants\Status;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        /** @var User $user */
        $user = User::query()->where('email', $request->get('email'))->first();

        if (!$user)
            return Response::error(Status::NOT_FOUND);

        if (!Hash::check($request->get('password'), $user->password))
            return Response::error(Status::INVALID_PASSWORD);

        return Response::success(['token' => $user->generateToken()]);
    }

    public function register(RegisterRequest $request)
    {
         User::query()->create($request->validated());
        return Response::success();
    }
}
