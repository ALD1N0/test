<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class loginControll extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    
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
    
            return response()->json([
                'message' => 'Registrasi berhasil',
            ], 200);
        }
    
        public function login(Request $request)
        {
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = DB::table('users')
                ->where('email', $request->email)
                ->where('password', md5($request->password))
                ->first();
    
            if (!$user) {
                return response()->json([
                    'message' => 'Email atau password salah.',
                ], 400);
            }
    
            return response()->json([
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                ]
            ], 200);
        }
    
        public function showLogin()
        {
            return view('login');
        }

    public function dashboard()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('dashboard', [
            'user' => session()->all()
        ]);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
