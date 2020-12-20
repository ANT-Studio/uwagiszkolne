<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);
        }
        catch (ValidationException $e) {
            return response()->json(['user' => null, 'message' => $e->errors()]);
        }

        if(Auth::attempt($request->only(['email', 'password']))) return response()->json(['user' => Auth::user(), 'message' => '']);
        return response()->json(['user' => null, 'message' => ['error' => ['Wpisano zły e-mail albo hasło!']]]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:3|max:20|unique',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8|max:20',
            ]);
        }
        catch (ValidationException $e) {
            return response()->json(['user' => null, 'message' => $e->errors()]);
        }

        $user = new User;
        $password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $password;
        $user->role = 0;
        $user->save();

        return response()->json(['user' => $user, 'message' => '']);
    }
}
