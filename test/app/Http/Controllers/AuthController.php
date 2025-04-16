<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'tanggal_lahir' => 'required|date'
        ]);
        if ($validator->fails()) {
            return response()->json('register gagal');
        }
        // $validated = $validator->validated();
        // $validated = $validator->safe()->only(['name', 'email']);
        // $validated = $validator->safe()->except(['name', 'email']);
        // return redirect(dd('helo'));
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'tanggal_lahir' => 'sometimes|date'
        ]);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'tanggal_lahir' => $request->tanggal_lahir ?? $user->tanggal_lahir,
        ]);

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'user' => Auth::user(),
            'token' => $request->session()->token()
        ], 200);
    }
    return response()->json([
        'success' => false,
        'message' => 'Email atau password salah.'
    ], 401);
}
}