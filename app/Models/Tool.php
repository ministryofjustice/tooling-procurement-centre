<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:tools|max:80',
        'description' => 'required',
        'link' => '',
        'version' => '',
        'license_id' => 'required|numeric',
        'contact_id' => 'required'
    ];

    public function path()
    {
        return '/tools/' . $this->id;
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class);
    }
}
