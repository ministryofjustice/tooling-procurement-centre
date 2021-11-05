<?php

namespace App\Http\Controllers;

use App\Models\CostCentre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CostCentreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('cost-centres', ['cost_centres' => CostCentre::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store()
    {
        $cost_centre = CostCentre::create($this->validateRequest());
        return redirect(route('cost-centre', $cost_centre->slug));
    }

    /**
     * @return array
     */
    public function validateRequest(): array
    {
        $request = request()->validate(CostCentre::$createRules);
        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
