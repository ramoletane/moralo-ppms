<?php

namespace App\Http\Controllers;

use App\Models\ProficiencyLevel;
use Illuminate\Http\Request;

class ProficiencyLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proficiency_levels.index', [
            'proficiency_levels' => ProficiencyLevel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proficiency_levels.create');
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
            'level_name' => 'required|string|max:255',
            'level_description' => 'nullable',
        ]);
 
        ProficiencyLevel::create($validated);
 
        return redirect(route('proficiency_levels.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProficiencyLevel  $proficiencyLevel
     * @return \Illuminate\Http\Response
     */
    public function show(ProficiencyLevel $proficiencyLevel)
    {
        return view('proficiency_levels.show', [
            'proficiencyLevel' => ProficiencyLevel::find($proficiencyLevel->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProficiencyLevel  $proficiencyLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProficiencyLevel $proficiencyLevel)
    {
        return view('proficiency_levels.edit', [
            'proficiencyLevel' => $proficiencyLevel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProficiencyLevel  $proficiencyLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProficiencyLevel $proficiencyLevel)
    {
        $validated = $request->validate([
            'level_name' => 'required|string|max:255',
            'level_description' => 'nullable',
        ]);
 
        $proficiencyLevel->update($validated);
 
        return redirect(route('proficiency_levels.show', $proficiencyLevel));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProficiencyLevel  $proficiencyLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProficiencyLevel $proficiencyLevel)
    {
        $proficiencyLevel->delete();
 
        return redirect(route('proficiency_levels.index'));
    }
}
