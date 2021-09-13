<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'tool_id' => 'required|numeric',
        'description' => 'sometimes|required|string|nullable',
        'user_limit' => 'numeric|nullable',
        'annual_cost' => 'numeric|nullable',
        'currency' => 'sometimes|required|alpha|nullable|max:3',
        'cost_per_user' => 'numeric|nullable',
        'start' => 'sometimes|required|date|nullable',
        'stop' => 'sometimes|required|date|nullable'
    ];

    public function path()
    {
        return '/licences/' . $this->id;
    }
}
