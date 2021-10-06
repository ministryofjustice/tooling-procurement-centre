<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        return Team::create($this->validateRequest());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team $team
     */
    public function update(Team $team)
    {
        return $team->update($this->validateRequest());
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(Team::$createRules);
    }
}
