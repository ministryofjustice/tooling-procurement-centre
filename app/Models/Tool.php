<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:tools|max:80',
        'description' => 'required',
        'link' => 'required'
    ];

    public function path()
    {
        return '/dashboard/tools/' . $this->slug;
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
        $user_id = $user->id ?? Auth::user()->id;

        $this->events()->create([
            'action' => 'status',
            'detail' => $detail,
            'origin' => 'application',
            'user_id' => $user_id
        ]);
    }

    public function action($detail, $user = null)
    {
        $user_id = $user->id ?? Auth::user()->id;

        $this->events()->create([
            'action' => 'action',
            'detail' => $detail,
            'origin' => ($user ? 'user' : 'application'),
            'user_id' => $user_id
        ]);
    }

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Event::class, 'tool_id', 'id')->orderBy('created_at', 'desc');
    }

    public function contact(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Contact::class, 'id', 'contact_id');
    }

    public function licences(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Licence::class, 'tool_id', 'id')->orderBy('user_limit', 'desc');
    }

    public function getLicencesCostAttribute()
    {
        $total = 0;
        foreach ($this->licences as $licence) {
            $total = $total + ($licence->user_limit * $licence->cost_per_user) ?? 0;
        }

        return $this->attributes['licences_cost'] = number_format($total);
    }
}
