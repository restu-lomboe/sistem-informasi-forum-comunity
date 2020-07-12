<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use App\User;

class PertanyaanController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view ('frontend.pertanyaan.index', compact('tags'));
    }

    public function detail($id)
    {

        $pertanyaan = Pertanyaan::where('id', $id)->first();
        $user = User::where(['id'=>$pertanyaan->user_id])->first();
        $data = $pertanyaan->vote;
        $totalvotepertanyaan = '';
        foreach ($data as $key => $value) {
            $sum[] = $value->up - $value->down;
            $count = array_sum($sum);
            if ($count == null) {
                $totalvotepertanyaan = 0;
            } else {
                $totalvotepertanyaan = $count;
            }
        }
        // dd($jumlah);
        $data_jawaban = $pertanyaan->jawaban;
        $totalvotejawaban = '';
        foreach ($data_jawaban as $key_1 => $value_1) {
            $vote_jawaban[] = $value_1->vote;
            foreach ($vote_jawaban as $key_2 => $value_2) {
                $sum_vote[] = $value_2[$key_2]->up - $value_2[$key_2]->down;
                // dd($sum_vote);
                $count_jawaban = array_sum($sum_vote);
                // dd($count_jawaban);
                if ($count_jawaban == null) {
                    $totalvotejawaban = 0;
                } else {
                    $totalvotejawaban = $count_jawaban;
                }
            }
        }
        // dd($totalvotejawaban);

        return view ('frontend.pertanyaan.detail', compact('pertanyaan', 'user', 'totalvotepertanyaan', 'totalvotejawaban'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $pertanyaan = new Pertanyaan;
        $pertanyaan->judul = $data['judul'];
        $pertanyaan->isi = $data['content'];
        $pertanyaan->user_id = \Auth::user()->id;
        $pertanyaan->save();

        $pertanyaan->tag()->attach($request->input('tag'));

        return redirect()->back()->with('status', 'Pertanyaan berhasil ditambah');
    }
}
