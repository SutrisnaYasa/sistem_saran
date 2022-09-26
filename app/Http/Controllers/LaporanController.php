<?php

namespace App\Http\Controllers;

use App\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $saranCollection = Saran::with('divisi')->latest()->get();
        } else {
            $saranCollection = Saran::with('divisi')->where('divisi_id', Auth::user()->divisi_id)->latest()->get();
        }
        return view('dashboard.saran.index', [
            'saranCollection' => $saranCollection
        ]);
    }

    public function show($divisiId)
    {
        $saranCollection = Saran::with('divisi')->where('divisi_id', $divisiId)->latest()->get();
        return view('dashboard.saran.index', [
            'saranCollection' => $saranCollection
        ]);
    }
}
