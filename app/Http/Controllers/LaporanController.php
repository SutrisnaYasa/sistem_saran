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
        } elseif(Auth::user()->username === "mahasiswa"){
            $saranCollection = Saran::latest()->get();
        }
        else {
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

    // tambahan fungsi edit dan update dari bagus
    public function edit(Saran $saran)
    {
        return view('dashboard.saran.edit', [
            'saran' => $saran
        ]);
    }

    public function update(Request $request, Saran $saran)
    {
        try {
            $saran->status = $request->status;
            $saran->tindak_lanjut = $request->tindak_lanjut;
            $saran->save();
            return redirect()->route('dashboard.saran.index')->with('success', 'Berhasil mengubah status');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }dd($saran);
    }
}
