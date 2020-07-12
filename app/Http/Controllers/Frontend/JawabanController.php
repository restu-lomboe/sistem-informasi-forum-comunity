<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jawaban;

class JawabanController extends Controller
{
    public function store(Request $request)
    {
        $jawaban = Jawaban::create($request->all());

        return redirect()->back()->with('status', 'Komentar berhasil');
    }
}
