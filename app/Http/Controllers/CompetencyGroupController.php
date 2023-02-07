<?php

namespace App\Http\Controllers;

use App\Models\CompetencyGroup;
use Illuminate\Http\Request;

class CompetencyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('competency_groups.index', [
            'competency_groups' => CompetencyGroup::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('competency_groups.create');
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
            'group_name' => 'required|string|max:255',
        ]);
 
        CompetencyGroup::create($validated);
 
        return redirect(route('competency_groups.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompetencyGroup  $competencyGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CompetencyGroup $competencyGroup)
    {
        return view('competency_groups.show', [
            'competencyGroup' => CompetencyGroup::find($competencyGroup->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompetencyGroup  $competencyGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetencyGroup $competencyGroup)
    {
        return view('competency_groups.edit', [
            'competencyGroup' => $competencyGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompetencyGroup  $competencyGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompetencyGroup $competencyGroup)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
        ]);
 
        $competencyGroup->update($validated);
 
        return redirect(route('competency_groups.show', $competencyGroup));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompetencyGroup  $competencyGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetencyGroup $competencyGroup)
    {
        $competencyGroup->delete();
 
        return redirect(route('competency_groups.index'));
    }
}
