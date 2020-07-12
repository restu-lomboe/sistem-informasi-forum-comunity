<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JumlahVote extends Model
{

    protected $table = "jumlah_vote";

    public function pertanyaan() {
        return $this->belongsToMany("App\Pertanyaan")->withTimestamps();
    }

    public function jawaban() {
        return $this->belongsToMany("App\jawaban")->withTimestamps();
    }
}
