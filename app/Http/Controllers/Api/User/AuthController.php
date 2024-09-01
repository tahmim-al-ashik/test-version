<?php
##########Http->controllers->Api->User->AuthController.php###############
namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Enums\Auth\UserRole;

class AuthController extends Controller
{
    ############################# Register #############################

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => UserRole::User,
        ]);

        $token = $user->createToken('UserToken')->plainTextToken;
        $data = [
            'token' => $token,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email
        ];

        if ($request->wantsJson()) {
            return response()->json(['message' => __('auth.register.success'), 'data' => $data], 201);
        }

        return redirect()->route('login')->with('success', __('auth.register.success'));
    }

    ############################# Login #############################

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $loginType = $request->input('login_type', 'user');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($loginType === 'admin' && $user->role !== UserRole::Admin) {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', __('auth.admin_only'));
            }

            if ($loginType === 'user' && $user->role !== UserRole::User) {
                Auth::logout();
                return redirect()->route('login')->with('error', __('auth.user_only'));
            }

            if ($loginType === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', __('auth.failed'));
    }

    ############################# API Login #############################

    public function apiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('UserToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    ############################# Logout #############################

    public function logout(Request $request)
    {
        if ($request->wantsJson()) {
            Auth::logout();
            return response()->json(['message' => __('auth.logout.success')]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', __('auth.logout.success'));
    }

    ############################# API Logout #############################

    public function apiLogout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => __('auth.logout.success')]);
    }
}


