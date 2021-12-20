<?php

namespace App\Http\Controllers;

use App\Models\BusinessCase;
use App\Models\Tool;
use Illuminate\Http\RedirectResponse;
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
     * @return View
     */
    public function index()
    {
        return view('business-cases', ['business_cases' => BusinessCase::all()]);
    }

    /**
     * Display a listing of the resource filtered by tool.
     *
     * @return View
     */
    public function indexToolBusinessCases($slug): View
    {
        return view('tool-business-cases', ['tool' => Tool::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $slug
     * @return View
     */
    public function create($slug): View
    {
        return view('forms.business-case', ['tool' => Tool::where('name', 'LIKE', $slug)->first()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        BusinessCase::create($this->validateRequest());
        return redirect(route('business-cases'));
    }

    /**
     * Display the specified resource.
     *
     * @param $businessCase
     * @return View
     */
    public function show($businessCase)
    {
        return view('business-case', ['business_case' => BusinessCase::where('slug', 'LIKE', $businessCase)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $businessCase
     * @return View
     */
    public function edit($businessCase)
    {
        return view('forms.business-case-edit', ['business_case' => BusinessCase::where('slug', 'LIKE', $businessCase)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param BusinessCase $businessCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessCase $businessCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BusinessCase $case
     * @return RedirectResponse
     */
    public function destroy(BusinessCase $case): RedirectResponse
    {
        $case->delete();
        return redirect(route('business-cases'));
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
