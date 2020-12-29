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
                'name' => 'required|min:3|max:20|unique:users',
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

    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => '']);
    }

    public function check(): JsonResponse
    {
        if(Auth::check()) return response()->json(['logged' => Auth::check(), 'admin' => Auth::user()->role == 1]);
        else return response()->json(['logged' => Auth::check(), 'admin' => false]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'password' => 'required|confirmed|min:8|max:20',
            ]);
        }
        catch (ValidationException $e) {
            return response()->json(['user' => null, 'message' => $e->errors()]);
        }

        if(!Hash::check($request->input('old_password'), Auth::user()->getAuthPassword())) return response()->json(['message' => [ [ 'Hasło jest niepoprawne!' ] ]]);
        $password = Hash::make($request->input('password'));
        $user = User::find(Auth::id());
        $user->password = $password;
        $user->save();
        return response()->json(['user' => $user, 'message' => '']);
    }

    public function changeNick(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:20|unique:users',
            ]);
        }
        catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()]);
        }

        $user = User::find(Auth::id());
        $user->name = $request->input('name');
        $user->save();
        return response()->json(['message' => '']);
    }
}
