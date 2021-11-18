<?php

namespace App\Http\Controllers;

use App\Models\CostCentre;
use App\Models\Licence;
use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LicenceController extends Controller
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
        return view('licences', ['licences' => Licence::orderBy('annual_cost')->get()]);
    }

    /**
     * Display a listing of the resource filtered by tool.
     *
     * @return View
     */
    public function indexToolLicences($slug): View
    {
        return view('tool-licences', ['tool' => Tool::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create($slug, $part = 'description'): View
    {
        $data = [
            'tool' => Tool::where(['slug' => $slug])->first(),
            'licence' => request()->session()->get('licence'),
            'licence_complete' => $this->licenceComplete()
        ];

        if ($part === 'cost_centre') {
            $data['cost_centres'] = CostCentre::all();
        }

        if ($part === 'summary') {
            $data['cost_centre'] = CostCentre::find($data['licence']['cost_centre']);
        }

        return view('forms.licence.' . $part, $data);
    }

    /**
     * Store form data in a session ready for summary and DB storage later
     *
     */
    public function session($part)
    {
        $this->validateRequest();

        $licence = request()->session()->get('licence');
        request()->session()->put('licence_complete', 'no');
        $licence[$part] = request()->{$part};

        $redirectTo = (request()->get('save_summary') ? '/summary' : null);
        switch ($part) {
            case 'cost_centre':
                $redirectTo = $redirectTo ?? '/cost_per_user';
                break;
            case 'description':
                $redirectTo = $redirectTo ?? '/user_limit';
                break;
            case 'user_limit':
                $redirectTo = $redirectTo ?? '/users_current';
                break;
            case 'users_current':
                $redirectTo = $redirectTo ?? '/cost_centre';
                break;
            case 'cost_per_user':
                $redirectTo = $redirectTo ?? '/currency';
                break;
            case 'currency':
                $redirectTo = $redirectTo ?? '/start';
                break;
            case 'start':
                $redirectTo = $redirectTo ?? '/stop';
                $licence['start'] = $this->collectDate('start');
                break;
            case 'stop':
                $redirectTo = '/summary';
                $licence['stop'] = $this->collectDate('stop');
                request()->session()->put('licence_complete', 'yes');
                break;
        }

        request()->session()->put('licence', $licence);

        $tool = Tool::findOrFail(request()->tool_id);

        return redirect($tool->path() . '/licences/create' . $redirectTo);
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
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function storeFromSession(): RedirectResponse
    {
        $licence = $this->validateSession('licence');

        // clean stuff up
        $start = $licence['start'];
        $stop = $licence['stop'];

        // normalise
        $licence['start'] = $start['year'] . '-' . $start['month'] . '-' . $start['day'] . ' 00:00:00';
        $licence['stop'] = $stop['year'] . '-' . $stop['month'] . '-' . $stop['day'] . ' 00:00:00';

        $licence = array_merge(['tool_id' => request()->tool_id], $licence);

        $new_licence = Licence::create($licence);

        request()->session()->forget('licence');

        $tool = Tool::find($licence['tool_id']);
        $tool->action(
            '<strong class="govuk-tag govuk-tag--green">New</strong> licence created and allocated to the [COST_CENTRE].
            <a href="' . route('licence', $new_licence->id) . '">View licence</a>.'
        );

        return redirect(route('licences-tools', $tool->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param Licence $licence
     * @return View
     */
    public function show(Licence $licence)
    {
        return view('licence', ['licence' => Licence::find($licence->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Licence $licence
     * @return View
     */
    public function edit(Licence $licence)
    {
        return view('forms.licence-edit', ['licence' => Licence::find($licence->id)]);
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

    /**
     * @return array
     */
    protected function validateSession($key)
    {
        $session_data = request()->session()->get($key);

        if (is_array($session_data)) {
            foreach ($session_data as $session_key => $value) {
                if ($session_key === 'cost_centre') {
                    $session_data['cost_centre_id'] = $value;
                }
                if (!array_key_exists($session_key, Licence::$createRules)) {
                    unset($session_data[$session_key]);
                }
            }

            request()->session()->put($key, $session_data);
            return $session_data;
        }

        trigger_error('Session validation has failed');
    }

    protected function collectDate($when): array
    {
        $day = request()->{$when . '_day'};
        $month = request()->{$when . '_month'};
        $year = request()->{$when . '_year'};
        return [
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'date' => Carbon::parse($year . '-' . $month . '-' . $day)->format('l, jS F Y')
        ];
    }

    /**
     * Determines the completed status of the licence session array during creation.
     * First we get the licence session data, and then we declare what good looks
     * like in the $complete variable.
     *
     * Next we filter the session data with array_filter(), removing any null or empty
     * array entries before running array_intersect_key() to check the array keys in
     * the session data against our $complete array. The return from our check stored
     * in $intersected will give us just the keys that are present in $complete.
     *
     * Next we compare the number of elements in $intersected and $complete to make
     * sure they match before deciding.
     *
     * @return string
     */
    protected function licenceComplete(): string
    {
        $licence_nodes = request()->session()->get('licence');

        $is_complete = 'no'; // default

        if (!$licence_nodes) {
            return $is_complete;
        }

        $complete = [
            'cost_centre' => 0,
            'description' => 1,
            'user_limit' => 2,
            'users_current' => 3,
            'currency' => 4,
            'cost_per_user' => 5,
            'start' => 6,
            'stop' => 7
        ];

        $intersected = array_intersect_key(array_filter($licence_nodes), $complete);

        if (count($intersected) === count($licence_nodes)) {
            $is_complete = 'yes';
        }

        return $is_complete;
    }
}
