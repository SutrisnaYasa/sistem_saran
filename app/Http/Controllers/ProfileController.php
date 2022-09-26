<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('dashboard.profile.index', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        if ($request->has('password')) {
            if (Hash::check($request->password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->with('error', 'Password yang di input tidak sesuai');
            }
        }
        $user->save();
        return redirect()->back()->with('success', 'Berhasil memperbarui profile');
    }
}
