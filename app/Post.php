<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','slug','description'];
    public function user()
    {
        return $this->belongsTo("App\User");
    }
    public function images()
    {
        return $this->hasMany("App\Image");
    }
}
