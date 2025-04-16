<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class LoginJwtControll extends Controller
{
    //
    private $key = "secretkey123";

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'password' => md5($request->password), 
        ]);

        return response()->json(['message' => 'Registrasi berhasil'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->where('email', $request->email)
            ->where('password', md5($request->password))
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        $payload = [
            'iss' => "laravel-jwt",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        $jwt = JWT::encode($payload, $this->key, 'HS256');

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $jwt
        ]);
    }
    public function getUser(Request $request)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Token tidak ditemukan'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            $userId = $decoded->sub;

            $user = DB::table('users')->where('id', $userId)->first();

            if (!$user) {
                return response()->json(['message' => 'User tidak ditemukan'], 404);
            }

            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token tidak valid'], 401);
        }
    }
}