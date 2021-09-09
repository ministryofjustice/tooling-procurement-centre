<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ToolController extends Controller
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
        return Tool::create($this->validateRequest());
    }

    /**
     * Display the specified resource.
     *
     * @param Tool $tool
     * @return Response
     */
    public function show(Tool $tool)
    {
        return $tool->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tool $tool
     * @return Response
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Tool  $tool
     * @return Response
     */
    public function update(Tool $tool)
    {
        $tool->update($this->validateRequest());
        return redirect($tool->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tool $tool
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();

        return redirect('/tools');
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
            'version' => "required",
            'license_id' => "required",
            'contact_id' => "required"
        ]);
    }
}
