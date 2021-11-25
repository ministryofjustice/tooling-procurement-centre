<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slack extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:slacks|max:80',
        'webhook_url' => 'required|unique:slacks'
    ];

    public function path(): string
    {
        return '/dashboard/slack-notification-settings/' . $this->slug;
    }
}
