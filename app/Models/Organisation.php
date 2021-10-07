<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:organisations|max:120',
        'address' => 'required',
        'description' => ''
    ];

    public function path()
    {
        return '/dashboard/organisations/' . $this->id;
    }

    public function teams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function name()
    {
        return $this->morphOne(Team::class, 'organisation');
    }
}
