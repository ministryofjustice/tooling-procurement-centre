<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'start',
        'stop'
    ];

    public static array $createRules = [
        'tool_id' => 'required|numeric',
        'cost_centre_id' => 'sometimes|required|numeric',
        'description' => 'sometimes|string|nullable',
        'user_limit' => 'numeric|nullable',
        'users_current' => 'numeric|nullable',
        'annual_cost' => 'numeric|nullable',
        'currency' => 'sometimes|required|alpha|nullable|max:3',
        'cost_per_user' => 'numeric|nullable',
        'start' => 'sometimes|required|date|nullable',
        'stop' => 'sometimes|required|date|nullable'
    ];

    public function path()
    {
        return '/dashboard/licences/' . $this->id;
    }

    public function setStartAttribute($start)
    {
        $this->attributes['start'] = Carbon::parse($start);
    }

    public function setStopAttribute($stop)
    {
        $this->attributes['stop'] = Carbon::parse($stop);
    }

    public function tool()
    {
        return $this->hasOne(Tool::class, 'id', 'tool_id');
    }

    public function costCentre()
    {
        return $this->hasOne(CostCentre::class, 'id', 'cost_centre_id');
    }
}
