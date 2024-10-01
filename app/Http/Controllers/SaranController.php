<?php

namespace App\Http\Controllers;

use App\Saran;
use App\Divisi;
use App\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class SaranController extends Controller
{

    public function index()
    {
        $divisiCollection = Divisi::where('parent', null)->get();
        return view('saran.index', [
            'divisiCollection' => $divisiCollection
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_divisi' => 'required|numeric',
            'topik_saran' => 'required|string',
            'saran' => 'required|string',
            'telepon' => 'nullable|sometimes|starts_with:62'
        ]);

        $subDivisiCollection = Divisi::where('parent', $request->divisi)->get();
        if ($validator->fails()) {
            return redirect()->back()->with('subDivisiCollection', $subDivisiCollection)->withErrors($validator)->withInput();
        }

        try {
            $fileName = null;
            if ($request->hasFile('bukti_pendukung')) {
                $file = $request->file('bukti_pendukung');
                $fileName = Str::slug(Carbon::now()) . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
            }
            Saran::create([
                'divisi_id' => $request->sub_divisi,
                'saran' => $request->saran,
                'topik_saran' => $request->topik_saran,
                'nama_pengirim' => $request->nama_pengirim,
                'telepon' => $request->telepon,
                'file_bukti' => $fileName,
                'status' => 0
            ]);

            // Kirim whatsapp jika pengirim mengisi identitas
            if ($request->has('telepon')) {
                $response = Http::post(env('CHAT_API_URL'), [
                    'phone' => $request->telepon,
                    'body' => "Terima Kasih telah memberi saran untuk STMIK Primakara yang lebih baik."
                ]);
                Log::create([
                    'log' => $response->body()
                ]);
            }

            return view('saran.success');
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'subDivisiCollection' => $subDivisiCollection,
                'message' => $e->getMessage()
            ])->withErrors($validator)->withInput();
        }
    }
}
