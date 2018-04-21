<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

//        $credentials = request(['prontuario', 'senha']);

        $credentials = ['prontuario' => $request->prontuario, 'password' => $request->senha];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Usuário e/ou senha inválidas'], 401);
        }

        return $this->respondWithToken($token, $request->prontuario);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function respondWithToken($token, $user)
    {
        $expiresIn = auth()->payload();
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            //'expires_in' => auth()->factory()->getTTL() * 60,
            'expires_at' => $expiresIn['exp']
        ]);
    }
}
