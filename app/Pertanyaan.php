<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Pertanyaan extends Model implements Viewable
{
    use InteractsWithViews;

    protected $table = "pertanyaan";
    protected $fillable = ['judul', 'isi', 'user_id'];

    public static function boot() {
        parent::boot();
        static::saving(function ($model) {
            $model->user_id = \Auth::user()->id;
        });
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function tag() {
        return $this->belongsToMany("App\Tag")->withTimestamps();
    }

    public function jawaban() {
        return $this->hasMany('App\Jawaban');
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

    public function votepertanyaan()
    {
        return $this->belongsToMany('App\Vote');
    }

}
