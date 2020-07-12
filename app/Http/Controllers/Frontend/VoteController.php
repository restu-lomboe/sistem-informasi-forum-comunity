<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pertanyaan;
use App\JumlahVote;
use App\Vote;

class VoteController extends Controller
{
    //vote up pertanyaan
    public function voteUp($id)
    {
        //cek vote_id
        $user_id = \Auth::user()->id;
        $user = \DB::table('user_vote')->where(['user_id' => $user_id])->first();

        //jika user sudah pernah vote
        if ($user) {
            //cek pertanyaan_id apakah sudah pernah di vote
            $pertanyaan = \DB::table('pertanyaan_vote')->where(['pertanyaan_id' => $id])->get();

            //pengecekan user id yang memiliki vote id, didalam tabel pertanyaan vote
            $uservote = '';
            foreach ($pertanyaan as $tanya) {
                //cek pemilik user vote
                $uservote = \DB::table('user_vote')->where(['vote_id'=> $tanya->vote_id])->first();
            }
            //cek jumlah vote id
            $pertanyaan_jumlah_vote = \DB::table('jumlah_vote_pertanyaan')->where(['pertanyaan_id' => $id])->first();

            //jika sudah perdah di vote
            if (isset($pertanyaan)) {
                //jika user sudah pernah melakukan vote di pertanyaan ini
                if ($uservote->user_id == $user_id) {
                    return redirect()->back()->with('error', 'Kamu sudah pernah melakukan vote di pertanyaan ini!! satu user hanya bisa melakukan sekali vote');
                } else {
                    //apakah user ini sudah memiliki vote id
                    if ($user) {
                        //apakah vote id memiliki pertanyaan id
                        if (isset($pertanyaan)) {
                             //update point berdasarkan id
                            \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point + 10')
                            ]);

                            //insert jawaban id kedalam jawaban vote
                            \DB::table('pertanyaan_vote')->insert([
                                'pertanyaan_id'=>$id,
                                'vote_id'=>$user->vote_id,
                                'created_at'=>\Carbon\Carbon::now(),
                                'updated_at'=>\Carbon\Carbon::now()
                            ]);

                             //menambah kan jumlah vote baru berdasarkan jawaban id
                            $jumlah_vote = new JumlahVote;
                            $jumlah_vote->up = 1;
                            $jumlah_vote->down = 0;
                            $jumlah_vote->save();

                            $jumlah_vote->pertanyaan()->attach($id);

                            return redirect()->back()->with('status', 'Pertanyaan Berhasil di Up vote');

                        //jika belum
                        } else {
                             //update point berdasarkan id
                             \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point + 10')
                            ]);
                            //update jumlah vote berdasarkan pertanyaan id
                            \DB::table('jumlah_vote')->where(['id'=>$pertanyaan_jumlah_vote->jumlah_vote_id])->update([
                                'up' => \DB::raw('up + 1')
                            ]);

                            return redirect()->back()->with('status', 'Pertanyaan Berhasil di Up vote');
                        }
                    //jika belum memiliki vote id
                    } else {
                        $vote = new Vote;
                        $vote->point = $vote->point + 10;
                        $vote->save();

                        //insert jawaban id kedalam jawaban vote
                        \DB::table('pertanyaan_vote')->insert([
                            'pertanyaan_id'=>$id,
                            'vote_id'=>$user->vote_id,
                            'created_at'=>\Carbon\Carbon::now(),
                            'updated_at'=>\Carbon\Carbon::now()
                        ]);

                        //update jumlah vote berdasarkan pertanyaan id
                        \DB::table('jumlah_vote')->where(['id'=>$pertanyaan_jumlah_vote->jumlah_vote_id])->update([
                            'up' => \DB::raw('up + 1')
                        ]);

                        $vote->user()->attach($user_id);

                    return redirect()->back()->with('status', 'Pertanyaan Berhasil di Up vote');
                    }
                }
            //jika belum pernah di vote
            } else {
                //update point berdasarkan id
                \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                    'point' => \DB::raw('point + 10')
                 ]);

                //insert jawaban id kedalam jawaban vote
                \DB::table('pertanyaan_vote')->insert([
                    'pertanyaan_id'=>$id,
                    'vote_id'=>$user->vote_id,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);

                //menambah kan jumlah vote baru berdasarkan jawaban id
                $jumlah_vote = new JumlahVote;
                $jumlah_vote->up = 1;
                $jumlah_vote->down = 0;
                $jumlah_vote->save();

                $jumlah_vote->pertanyaan()->attach($id);

                return redirect()->back()->with('status', 'Pertanyaan Berhasil di Up vote');
            }
       } else {
            $vote = new Vote;
            $vote->point = $vote->point + 10;
            $vote->save();

            $jumlah_vote = new JumlahVote;
            $jumlah_vote->up = 1;
            $jumlah_vote->down = 0;
            $jumlah_vote->save();

            $vote->pertanyaan()->attach($id);
            $jumlah_vote->pertanyaan()->attach($id);
            $vote->user()->attach($user_id);

            return redirect()->back()->with('status', 'pertanyaan Berhasil divote');
       }
    }

    //vote down pertanyaan
    public function voteDown($id)
    {
        //cek vote_id
        $user_id = \Auth::user()->id;
        $user = \DB::table('user_vote')->where(['user_id' => $user_id])->first();

        //apakah user sudah memiliki vote id
        if ($user) {
            //cek pertanyaan_id apakah sudah pernah di vote
            $pertanyaan = \DB::table('pertanyaan_vote')->where(['pertanyaan_id' => $id])->get();
            //pengecekan user id yang memiliki vote id, didalam tabel pertanyaan vote
            $uservote = '';
            foreach ($pertanyaan as $tanya) {
                //cek pemilik user vote
                $uservote = \DB::table('user_vote')->where(['vote_id'=> $tanya->vote_id])->first();
            }
            //cek jumlah vote id
            $pertanyaan_jumlah_vote = \DB::table('jumlah_vote_pertanyaan')->where(['pertanyaan_id' => $id])->first();

            //jika sudah perdah di vote
            if (isset($pertanyaan)) {
                //jika user sudah pernah melakukan vote di pertanyaan ini
                if ($uservote->user_id == $user_id) {
                    return redirect()->back()->with('error', 'Kamu sudah pernah melakukan vote di pertanyaan ini !! satu user hanya bisa melakukan sekali vote');
                } else {
                     //apakah user ini sudah memiliki vote id
                     if ($user) {
                        //apakah vote id memiliki pertanyaan id
                        if (isset($pertanyaan)) {
                             //update point berdasarkan id
                            \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point - 1')
                            ]);
                             //insert pertanyaan id kedalam pertanyaan vote
                            \DB::table('pertanyaan_vote')->insert([
                                'pertanyaan_id'=>$id,
                                'vote_id'=>$user->vote_id,
                                'created_at'=>\Carbon\Carbon::now(),
                                'updated_at'=>\Carbon\Carbon::now()
                            ]);

                            //menambah kan jumlah vote baru berdasarkan pertanyaan id
                            $jumlah_vote = new JumlahVote;
                            $jumlah_vote->up = 0;
                            $jumlah_vote->down = 1;
                            $jumlah_vote->save();

                            $jumlah_vote->pertanyaan()->attach($id);

                            return redirect()->back()->with('status', 'Pertanyaan Berhasil di down vote');

                        //jika belum
                        } else {
                             //update point berdasarkan id
                             \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point - 1')
                            ]);
                            //update jumlah vote berdasarkan pertanyaan id
                            \DB::table('jumlah_vote')->where(['id'=>$pertanyaan_jumlah_vote->jumlah_vote_id])->update([
                                'up' => \DB::raw('down + 1')
                            ]);

                            return redirect()->back()->with('status', 'Pertanyaan Berhasil di down vote');
                        }
                    //jika belum memiliki vote id
                    } else {
                        $vote = new Vote;
                        $vote->point = $vote->point - 1;
                        $vote->save();

                        //insert jawaban id kedalam jawaban vote
                        \DB::table('pertanyaan_vote')->insert([
                            'pertanyaan_id'=>$id,
                            'vote_id'=>$user->vote_id,
                            'created_at'=>\Carbon\Carbon::now(),
                            'updated_at'=>\Carbon\Carbon::now()
                        ]);

                        //update jumlah vote berdasarkan pertanyaan id
                        \DB::table('jumlah_vote')->where(['id'=>$pertanyaan_jumlah_vote->jumlah_vote_id])->update([
                            'up' => \DB::raw('down + 1')
                        ]);

                        $vote->user()->attach($user_id);

                        return redirect()->back()->with('status', 'Pertanyaan Berhasil di down vote');
                    }
                }

            //jika belum pernah di vote
            } else {
                //update point berdasarkan id
                \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                    'point' => \DB::raw('point - 1')
                 ]);

                //insert jawaban id kedalam jawaban vote
                \DB::table('pertanyaan_vote')->insert([
                    'pertanyaan_id'=>$id,
                    'vote_id'=>$user->vote_id,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);

                //menambah kan jumlah vote baru berdasarkan jawaban id
                $jumlah_vote = new JumlahVote;
                $jumlah_vote->up = 0;
                $jumlah_vote->down = 1;
                $jumlah_vote->save();

                $jumlah_vote->pertanyaan()->attach($id);

                return redirect()->back()->with('status', 'Jawaban Berhasil di down vote');
            }

            return redirect()->back()->with('status', 'pertanyaan Berhasil di Down Vote');

        //jika belum mempunyai vote id
        } else {
            $vote = new Vote;
            $vote->point = $vote->point - 1;
            $vote->save();

            $jumlah_vote = new JumlahVote;
            $jumlah_vote->up = 0;
            $jumlah_vote->down = 1;
            $jumlah_vote->save();

            $vote->pertanyaan()->attach($id);
            $jumlah_vote->pertanyaan()->attach($id);
            $vote->user()->attach($user_id);

            return redirect()->back()->with('status', 'pertanyaan Berhasil divote');
       }
    }

    //vote up jawaban
    public function voteUpJawaban($id)
    {
        //cek vote_id
        $user_id = \Auth::user()->id;
        $user = \DB::table('user_vote')->where(['user_id' => $user_id])->first();
        if ($user) {
            //cek jawaban_id apakah sudah pernah di vote
            $jawaban = \DB::table('jawaban_vote')->where(['jawaban_id' => $id])->get();
            //pengecekan user id yang memiliki vote id, didalam tabel pertanyaan vote
            // dd(isset($jawaban));
            $uservote = '';
            foreach ($jawaban as $jawab) {
                //cek pemilik user vote
                $uservote = \DB::table('user_vote')->where(['vote_id'=> $jawab->vote_id])->first();
            }
            //cek jumlah vote id
            $jawaban_jumlah_vote = \DB::table('jawaban_jumlah_vote')->where(['jawaban_id' => $id])->first();

            //jika sudah perdah di vote
            if (isset($jawaban)) {

                //jika user sudah pernah melakukan vote di pertanyaan ini
                if ($uservote->user_id == $user_id) {
                    return redirect()->back()->with('error', 'Kamu sudah pernah melakukan vote di jawaban ini !! satu user hanya bisa melakukan sekali vote');
                } else {
                    //apakah user ini sudah memiliki vote id
                    if ($user) {
                        //apakah vote id memiliki pertanyaan id
                        if (isset($jawaban)) {
                            //update point berdasarkan id
                            \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point + 10')
                            ]);

                            //insert jawaban id kedalam jawaban vote
                            \DB::table('jawaban_vote')->insert([
                                'jawaban_id'=>$id,
                                'vote_id'=>$user->vote_id,
                                'created_at'=>\Carbon\Carbon::now(),
                                'updated_at'=>\Carbon\Carbon::now()
                            ]);

                            //menambah kan jumlah vote baru berdasarkan jawaban id
                            $jumlah_vote = new JumlahVote;
                            $jumlah_vote->up = 1;
                            $jumlah_vote->down = 0;
                            $jumlah_vote->save();

                            $jumlah_vote->jawaban()->attach($id);

                            return redirect()->back()->with('status', 'Jawaban Berhasil di Up vote');

                        //jika belum
                        } else {
                            //update point berdasarkan id
                            \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point + 10')
                            ]);
                            //update jumlah vote berdasarkan jawaban id
                            \DB::table('jumlah_vote')->where(['id'=>$jawaban_jumlah_vote->jumlah_vote_id])->update([
                                'up' => \DB::raw('up + 1')
                            ]);

                            return redirect()->back()->with('status', 'Jawaban Berhasil di Up vote');
                        }
                    //jika belum memiliki vote id
                    } else {
                        $vote = new Vote;
                        $vote->point = $vote->point + 10;
                        $vote->save();

                        //insert jawaban id kedalam jawaban vote
                        \DB::table('jawaban_vote')->insert([
                            'jawaban_id'=>$id,
                            'vote_id'=>$user->vote_id,
                            'created_at'=>\Carbon\Carbon::now(),
                            'updated_at'=>\Carbon\Carbon::now()
                        ]);

                        //update jumlah vote berdasarkan pertanyaan id
                        \DB::table('jumlah_vote')->where(['id'=>$jawaban_jumlah_vote->jumlah_vote_id])->update([
                            'up' => \DB::raw('up + 1')
                        ]);

                        $vote->user()->attach($user_id);

                        return redirect()->back()->with('status', 'Pertanyaan Berhasil di Up vote');
                    }
                }

            //jika belum pernah di vote
            } else {
                //update point berdasarkan id
                \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                    'point' => \DB::raw('point + 10')
                 ]);

                //insert jawaban id kedalam jawaban vote
                \DB::table('jawaban_vote')->insert([
                    'jawaban_id'=>$id,
                    'vote_id'=>$user->vote_id,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);

                //menambah kan jumlah vote baru berdasarkan jawaban id
                $jumlah_vote = new JumlahVote;
                $jumlah_vote->up = 1;
                $jumlah_vote->down = 0;
                $jumlah_vote->save();

                $jumlah_vote->jawaban()->attach($id);

                return redirect()->back()->with('status', 'Jawaban Berhasil di Up vote');
            }

       } else {
            $vote = new Vote;
            $vote->point = $vote->point + 10;
            $vote->save();

            $jumlah_vote = new JumlahVote;
            $jumlah_vote->up = 1;
            $jumlah_vote->down = 0;
            $jumlah_vote->save();

            $vote->jawaban()->attach($id);
            $jumlah_vote->jawaban()->attach($id);
            $vote->user()->attach($user_id);

            return redirect()->back()->with('status', 'Jawaban Berhasil divote');
       }
    }

    //vote down jawaban
    public function voteDownJawaban($id)
    {
        //cek vote_id
        $user_id = \Auth::user()->id;
        $user = \DB::table('user_vote')->where(['user_id' => $user_id])->first();
        if ($user) {
            //cek jawaban_id apakah sudah pernah di vote
            $jawaban = \DB::table('jawaban_vote')->where(['jawaban_id' => $id])->get();
            //pengecekan user id yang memiliki vote id, didalam tabel pertanyaan vote
            $uservote = '';
            foreach ($jawaban as $jawab) {
                //cek pemilik user vote
                $uservote = \DB::table('user_vote')->where(['vote_id'=> $jawab->vote_id])->first();
            }
            //cek jumlah vote id
            $jawaban_jumlah_vote = \DB::table('jawaban_jumlah_vote')->where(['jawaban_id' => $id])->first();

            //jika sudah perdah di vote
            if (isset($jawaban)) {

                //jika user sudah pernah melakukan vote di pertanyaan ini
                if ($uservote->user_id == $user_id) {
                    return redirect()->back()->with('error', 'Kamu sudah pernah melakukan vote dijawaban ini !! satu user hanya bisa melakukan sekali vote');
                } else {
                   //apakah user ini sudah memiliki vote id
                   if ($user) {
                    //apakah vote id memiliki pertanyaan id
                        if (isset($jawaban)) {
                            //update point berdasarkan id
                            \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point - 1')
                            ]);

                            //insert jawaban id kedalam jawaban vote
                            \DB::table('jawaban_vote')->insert([
                                'jawaban_id'=>$id,
                                'vote_id'=>$user->vote_id,
                                'created_at'=>\Carbon\Carbon::now(),
                                'updated_at'=>\Carbon\Carbon::now()
                            ]);

                            //menambah kan jumlah vote baru berdasarkan jawaban id
                            $jumlah_vote = new JumlahVote;
                            $jumlah_vote->up = 0;
                            $jumlah_vote->down = 1;
                            $jumlah_vote->save();

                            $jumlah_vote->jawaban()->attach($id);


                            return redirect()->back()->with('status', 'Jawaban Berhasil di down vote');

                        //jika belum
                        } else {
                            //update point berdasarkan id
                            \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                                'point' => \DB::raw('point - 1')
                            ]);
                            //update jumlah vote berdasarkan jawaban id
                            \DB::table('jumlah_vote')->where(['id'=>$jawaban_jumlah_vote->jumlah_vote_id])->update([
                                'down' => \DB::raw('down + 1')
                            ]);

                            return redirect()->back()->with('status', 'Jawaban Berhasil di down vote');
                        }
                    //jika belum memiliki vote id
                    } else {
                        $vote = new Vote;
                        $vote->point = $vote->point - 1;
                        $vote->save();

                        //insert jawaban id kedalam jawaban vote
                        \DB::table('jawaban_vote')->insert([
                            'jawaban_id'=>$id,
                            'vote_id'=>$user->vote_id,
                            'created_at'=>\Carbon\Carbon::now(),
                            'updated_at'=>\Carbon\Carbon::now()
                        ]);

                        //update jumlah vote berdasarkan pertanyaan id
                        \DB::table('jumlah_vote')->where(['id'=>$jawaban_jumlah_vote->jumlah_vote_id])->update([
                            'dowm' => \DB::raw('down + 1')
                        ]);

                        $vote->user()->attach($user_id);

                        return redirect()->back()->with('status', 'Pertanyaan Berhasil di down vote');
                    }
                }
            //jika belum pernah di vote
            } else {
                //update point berdasarkan id
                \DB::table('vote')->where(['id'=>$user->vote_id])->update([
                    'point' => \DB::raw('point - 1')
                 ]);

                //insert jawaban id kedalam jawaban vote
                \DB::table('jawaban_vote')->insert([
                    'jawaban_id'=>$id,
                    'vote_id'=>$user->vote_id,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);

                //menambah kan jumlah vote baru berdasarkan jawaban id
                $jumlah_vote = new JumlahVote;
                $jumlah_vote->up = 0;
                $jumlah_vote->down = 1;
                $jumlah_vote->save();

                $jumlah_vote->jawaban()->attach($id);

                return redirect()->back()->with('status', 'Jawaban Berhasil di Down vote');
            }

       } else {
            $vote = new Vote;
            $vote->point = $vote->point - 1;
            $vote->save();

            $jumlah_vote = new JumlahVote;
            $jumlah_vote->up = 0;
            $jumlah_vote->down = 1;
            $jumlah_vote->save();

            $vote->jawaban()->attach($id);
            $jumlah_vote->jawaban()->attach($id);
            $vote->user()->attach($user_id);

            return redirect()->back()->with('status', 'Jawaban Berhasil divote');
       }
    }
}
