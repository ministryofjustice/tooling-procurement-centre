<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCentre extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:contacts|max:80',
        'number' => 'required|numeric'
    ];

    public function path()
    {
        return route('cost-centre', $this->slug);
    }
}
