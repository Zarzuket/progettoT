<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ["url","name","post_id"];

    public function Post()
    {
        return $this->belongsTo("App\Post");
    }
}
