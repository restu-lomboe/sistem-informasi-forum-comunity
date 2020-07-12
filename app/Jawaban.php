<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = "jawaban";
    protected $fillable = ['isi', 'pertanyaan_id', 'user_id'];

    public function pertanyaan() {
        return $this->belongsToMany('App\Pertanyaan')->withTimestamps();
    }

    public function jawabanuser()
    {
        return $this->belongsToMany('App\Vote');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function komentar()
    {
        return $this->belongsToMany('App\Komentar');
    }

    public function vote()
    {
        return $this->belongsToMany('App\JumlahVote');
    }

}
