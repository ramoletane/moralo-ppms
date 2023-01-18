<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('organisations.index', [
            'organisations' => Organisation::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organisations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'acronym' => 'nullable',
            'email_address' => 'nullable',
            'phone_number' => 'nullable',
        ]);
 
        Organisation::create($validated);
 
        return redirect(route('organisations.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function show(Organisation $organisation)
    {
        return view('organisations.show', [
            'organisation' => Organisation::find($organisation->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisation $organisation)
    {
        return view('organisations.edit', [
            'organisation' => $organisation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'acronym' => 'nullable',
            'email_address' => 'nullable',
            'phone_number' => 'nullable',
        ]);
 
        $organisation->update($validated);
 
        return redirect(route('organisations.show', $organisation));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        $organisation->delete();
 
        return redirect(route('organisations.index'));
    }
}
