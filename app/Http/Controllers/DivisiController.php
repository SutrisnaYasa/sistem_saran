<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Divisi;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index()
    {
        $divisiCollection = DB::table('divisi as a')->select('a.*', 'b.nama as parent_divisi')->join('divisi as b', 'b.id', '=', 'a.parent', 'left')->get();
        return view('divisi.index', [
            'divisiCollection' => $divisiCollection
        ]);
    }

    public function create()
    {
        $divisiCollection = Divisi::all();
        return view('divisi.create', [
            'divisiCollection' => $divisiCollection
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required'
        ]);

        try {
            $divisi = new Divisi();
            $divisi->nama = $request->nama;
            if ($request->has('divisi')) {
                $divisi->parent = $request->divisi;
            }
            $divisi->save();
            return redirect()->back()->with('success', 'Berhasil menambah bagian/divisi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, Divisi $divisi)
    {
        $parent = null;
        $divisiCollection = Divisi::all();
        if ($divisi->parent) {
            $parent = Divisi::where('id', $divisi->parent)->first();
        }
        return view('divisi.edit', [
            'divisi' => $divisi,
            'parent' => $parent,
            'divisiCollection' => $divisiCollection
        ]);
    }

    public function update(Request $request, Divisi $divisi)
    {
        try {
            $divisi->parent = $request->divisi;
            $divisi->nama = $request->nama;
            $divisi->save();
            return redirect()->back()->with('success', 'Berhasil mengubah divisi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Divisi $divisi)
    {
        try {
            $divisi->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus divisi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getSubDivisi(Request $request, $divisiId = null)
    {
        if ($request->ajax()) {
            $subDivisiCollection = Divisi::where('parent', $divisiId)->get();
            return response()->json([
                "error" => null,
                "data" => $subDivisiCollection
            ], 200);
        }

        return response()->json([
            'error' => "Method Not Allowed",
            "data" => []
        ], 405);
    }
}
