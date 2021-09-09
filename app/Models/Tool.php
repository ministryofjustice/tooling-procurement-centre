<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tool extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/tools/' . $this->id;
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class);
    }
}
