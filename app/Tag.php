<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tag";
    protected $fillable = ['nama'];

    public function pertanyaan() {
        return $this->belongsToMany("App\Pertanyaan");
    }
}
