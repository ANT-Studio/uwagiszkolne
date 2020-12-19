<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return response()->json(['user' => null, 'message' => 'Wpisano zły e-mail albo hasło!']);
    }
}
