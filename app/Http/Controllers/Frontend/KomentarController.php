<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komentar;

class KomentarController extends Controller
{
    public function storePertanyaan(Request $request)
    {
        $komentar = Komentar::create($request->all());
        $komentar->pertanyaan()->attach($request->input('pertanyaan_id'));

        return redirect()->back()->with('status', 'Pertanyaan berhasil dikomentari');
    }

    public function storeJawaban(Request $request)
    {
        $komentar = Komentar::create($request->all());
        $komentar->jawaban()->attach($request->input('jawaban_id'));

        return redirect()->back()->with('status', 'Jawaban Berhasil dikomentari');
    }
}
