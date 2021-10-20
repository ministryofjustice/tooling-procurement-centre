<?php

namespace App\Http\Controllers;

use App\Models\BusinessCase;
use App\Models\Contact;
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
        return view('tools', ['tools' => Tool::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('forms.tooling', [
            'tooling' => request()->session()->get('tooling-data') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createContact(): View
    {
        return view('forms.tooling-contact', [
            'tooling' => request()->session()->get('tooling-data') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createBusinessCase(): View
    {
        return view('forms.tooling-business-case', [
            'tooling' => request()->session()->get('tooling') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createSummary(): View
    {
        return view('forms.tooling-summary', [
            'tooling' => request()->session()->get('tooling') ?? [],
            'contact' => request()->session()->get('contact') ?? [],
            'business-case' => request()->session()->get('business-case') ?? [],
        ]);
    }

    public function storeSessionData(Request $request)
    {
        // associate user with the tool
        $data = array_merge($this->validateRequest(), [
            'slug' => Str::slug(request()->name)
        ]);

        $request->session()->put('tooling', $data);

        return redirect('/dashboard/tools/create/contact');
    }

    public function storeContact(Request $request)
    {
        if ($request->get('contact') === 'yes') {
            $request->session()->forget('contact');
            return redirect(route('tools-create-business-case'));
        }

        $contact = $request->validate(Contact::$createRules);
        $contact['slug'] = Str::slug($contact['name']);

        $request->session()->put('contact', $contact);

        return redirect(route('tools-create-business-case'));
    }

    public function storeBusinessCase(Request $request)
    {
        if ($request->get('business-case') === 'no') {
            $request->session()->forget('business-case');
            return redirect(route('tools-view-summary'));
        }

        $business_case = $request->validate(BusinessCase::$createRules);
        $business_case['slug'] = Str::slug($business_case['name']);

        $request->session()->put('business-case', $business_case);

        return redirect(route('tools-view-summary'));
    }

    public function viewSummary()
    {
        return view('forms.tooling-summary', [
            'tooling' => request()->session()->get('tooling'),
            'contact' => request()->session()->get('contact'),
            'business_case' => request()->session()->get('business-case')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        // create a contact or get the current user
        if ($contact = request()->session()->get('contact')) {
            $user = Contact::create($contact);
        } else {
            $user = Auth::user();
        }

        $tool = Tool::create(array_merge(request()->session()->get('tooling'), ['contact_id' => $user->id]));
        $tool->action('Tool created');

        Licence::create([
            'tool_id' => $tool->id
        ]);

        $tool->action('Licence created');

        if ($business_case = request()->session()->get('business-case')) {
            BusinessCase::create(
                array_merge($business_case, [
                    'tool_id' => $tool->id
                ])
            );
            $tool->action('Business case created');
        }

        // clear the session data
        request()->session()->forget('tooling');
        request()->session()->forget('contact');
        request()->session()->forget('business-case');

        return redirect('/dashboard/tools');
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

        return redirect('/dashboard/tools');
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
