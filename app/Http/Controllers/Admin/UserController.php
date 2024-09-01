<?php
##########Http->controllers->Admin->UserController.php###############
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    ############################# Show All Users for Blade View #############################
    public function adminuser(Request $request)
    {
        $users = User::with(['services', 'packages'])
            ->where('role', '!=', 'admin')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    ############################# Show All Users for Inertia #############################
    public function index(Request $request)
    {
        $users = User::all();
        return Inertia::render('Admin/Users', [
            'users' => $users
        ]);
    }

    ############################# Create User #############################
    public function create()
    {
        return Inertia::render('Admin/CreateUser');
    }

    ##################### Profile Route ###############
    public function profile()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = auth()->user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($request->filled('password') && Hash::check($request->password, $user->password)) {
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
            }
        } else {
            return redirect()->back()->withErrors(['password' => 'The provided password does not match your current password.']);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    ############################# Store User #############################
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255|unique:users,phone',
            'password' => 'required|string|min:8',
        ]);

        User::create($request->all());

        return redirect()->route('admin.users.index');
    }

    ############################# Edit User for Blade View #############################
    public function adminedit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    ############################# Edit User for Inertia #############################
    public function edit(User $user)
    {
        return Inertia::render('Admin/EditUser', [
            'user' => $user
        ]);
    }

    ############################# Update User #############################
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('admin.users.index');
    }

    ############################# Delete User #############################
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    ################################ Role Based Login for Blade ####################
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');
        $loginType = $request->input('login_type', 'user');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            if ($loginType === 'admin' && !$user->isAdmin()) {
                Auth::guard('web')->logout();
                return redirect()->back()->with('error', __('auth.admin_only'));
            }

            if ($loginType === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', __('auth.failed'));
    }

    public function apiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function apiLogout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => __('auth.logout.success')]);
    }

    public function webLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

