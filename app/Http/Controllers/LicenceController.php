<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return Licence::create($this->validateRequest());
    }

    /**
     * Display the specified resource.
     *
     * @param Licence $licence
     * @return Response
     */
    public function show(Licence $licence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Licence $licence
     * @return Response
     */
    public function edit(Licence $licence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Licence $licence
     * @return RedirectResponse
     */
    public function update(Request $request, Licence $licence)
    {
        $licence->update($this->validateRequest());
        return redirect($licence->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Licence $licence
     * @return Response
     */
    public function destroy(Licence $licence)
    {
        //
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(Licence::$createRules);
    }
}
