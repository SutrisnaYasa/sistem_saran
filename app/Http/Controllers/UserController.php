<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('divisi')->get();
        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $divisiCollection = Divisi::where('parent', '<>', null)->get();
        return view('users.create', [
            'divisiCollection' => $divisiCollection
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'divisi' => 'required'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'divisi_id' => $request->divisi,
                'akses' => ($request->akses == 1) ? 1 : 2
            ]);
            return redirect()->route('dashboard.users.index')->with('success', 'Berhasil menambah user');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit(User $user)
    {
        $divisiCollection = Divisi::where('parent', '<>', null)->get();
        return view('users.edit', [
            'user' => $user,
            'divisiCollection' => $divisiCollection
        ]);
    }

    public function update(Request $request, User $user)
    {
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->divisi_id = $request->divisi;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->akses = ($request->akses == 1) ? 1 : 2;
            $user->save();
            return redirect()->back()->with('success', 'Berhasil mengubah user');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus user');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
