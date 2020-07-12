<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = "vote";
    protected $fillable = ['point', 'up', 'down'];

    public function pertanyaan() {
        return $this->belongsToMany("App\Pertanyaan")->withTimestamps();
    }

    public function jawaban() {
        return $this->belongsToMany("App\jawaban")->withTimestamps();
    }

    public function user() {
        return $this->belongsToMany("App\user")->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany("App\user")->withTimestamps();
    }


}
