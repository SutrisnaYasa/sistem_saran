<?php

namespace App\Http\Controllers;

use App\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalSaranPerDivisi = [];
        if (Auth::user()->isAdmin()) {
            $totalSaran = Saran::all()->count();
            $totalSaranPerDivisi = DB::table('saran')
                ->join('divisi', 'divisi.id', '=', 'saran.divisi_id')
                ->select('divisi.id as divisi_id', 'divisi.nama as divisi', DB::raw('count(*) as total_saran'))
                ->groupBy('divisi.id')
                ->get();
        } else {
            $totalSaran = Saran::where('divisi_id', Auth::user()->divisi_id)->get()->count();
        }
        return view('dashboard.index', [
            'totalSaran' => $totalSaran,
            'totalSaranPerDivisi' => $totalSaranPerDivisi
        ]);
    }
}
