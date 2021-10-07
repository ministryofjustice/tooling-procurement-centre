<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        return view('forms.organisation');
    }

    public function index()
    {
        return view('organisations', ['organisations' => Organisation::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        Organisation::create($this->validateRequest());
        return redirect('/dashboard/organisations');
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(Organisation::$createRules);
    }
}
