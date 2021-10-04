<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
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
     * @return View
     */
    public function index()
    {
        $tools = Tool::all();
        return view('tools', ['tools' => $tools]);
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
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        // create a contact: get current user
        $user = Auth::user();
        // associate user with the tool
        $data = array_merge($this->validateRequest(), [
            'slug' => Str::slug(request()->name),
            'contact_id' => $user->id
        ]);

        $tool = Tool::create($data);
        $tool->action('Tool created');

        Licence::create([
            'tool_id' => $tool->id
        ]);

        return redirect('/tools');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return View
     */
    public function show($slug): View
    {
        $tool = Tool::where(['slug' => $slug])->first();
        return view('tool', ['tool' => $tool]);
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
     * @param Tool $tool
     */
    public function update(Tool $tool)
    {
        $tool->action('Tool update');
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

    public function find($search)
    {
        $search = str_replace('-', ' ', $search);
        $tools = Tool::where('name', 'LIKE', '%' . $search . '%')->get();
        return ['results' => $tools];
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(Tool::$createRules);
    }
}
