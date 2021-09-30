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

    public function review($detail, $user)
    {
        $this->events()->create([
            'action' => 'tooling-review',
            'detail' => $detail,
            'origin' => 'application',
            'user_id' => $user->id
        ]);
    }

    public function status($detail, $user = null)
    {
        $user_id = $user->id ?? null;

        $this->events()->create([
            'action' => 'status',
            'detail' => $detail,
            'origin' => 'application',
            'user_id' => $user_id
        ]);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
