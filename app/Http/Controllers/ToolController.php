<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tools = Tool::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('forms.tooling');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // create a contact
        $user = Auth::user();
        $data = array_merge($this->validateRequest(), ['contact_id' => $user->id]);
        return Tool::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Tool $tool
     * @return Response
     */
    public function show(Tool $tool)
    {
        // return $tool->get();
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
        return request()->validate(Tool::$createRules);
    }
}
