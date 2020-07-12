<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = "komentar";
    protected $fillable = ['isi', 'user_id'];

    public function pertanyaan() {
        return $this->belongsToMany("App\Pertanyaan")->withTimestamps();
    }

    public function jawaban() {
        return $this->belongsToMany("App\jawaban")->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
