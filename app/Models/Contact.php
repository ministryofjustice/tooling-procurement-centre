<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:contacts|max:80',
        'email' => 'required|email:rfc,dns'
    ];

    public function path()
    {
        return '/dashboard/contacts/' . $this->slug;
    }
}
