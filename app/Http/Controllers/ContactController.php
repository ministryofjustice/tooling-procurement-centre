<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ContactController extends Controller
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
        return view('contacts', ['contacts' => Contact::all()->sortBy("name")]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('forms.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Collection
     */
    public function store()
    {
        return Contact::create($this->validateRequest());
    }

    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show($slug)
    {
        return view('contact', ['contact' => Contact::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($slug)
    {
        return view('forms.contact-edit', ['contact' => Contact::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Contact $contact
     */
    public function update(Contact $contact)
    {
        $contact->update($this->validateRequest());
        return redirect($contact->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('dashboard/contacts');
    }

    /**
     * @return array
     */
    public function validateRequest(): array
    {
        $request = request()->validate(Contact::$createRules);
        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
