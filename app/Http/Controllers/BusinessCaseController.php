<?php

namespace App\Http\Controllers;

use App\Models\BusinessCase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BusinessCaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('forms.business-case');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        BusinessCase::create($this->validateRequest());
        return redirect(route('business-cases'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessCase  $businessCase
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessCase $businessCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessCase  $businessCase
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCase $businessCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessCase  $businessCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessCase $businessCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessCase  $businessCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessCase $businessCase)
    {
        //
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        $request = request()->validate(BusinessCase::$createRules);
        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
