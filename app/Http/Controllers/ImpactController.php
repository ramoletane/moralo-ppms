<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('impacts.index', [
            'impacts' => Impact::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('impacts.create');
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
            'impact_name' => 'required|string|max:255',
        ]);
 
        Impact::create($validated);
 
        return redirect(route('impacts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Impact  $impact
     * @return \Illuminate\Http\Response
     */
    public function show(Impact $impact)
    {
        return view('impacts.show', [
            'impact' => Impact::find($impact->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Impact  $impact
     * @return \Illuminate\Http\Response
     */
    public function edit(Impact $impact)
    {
        return view('impacts.edit', [
            'impact' => $impact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Impact  $impact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impact $impact)
    {
        $validated = $request->validate([
            'impact_name' => 'required|string|max:255',
        ]);
 
        $impact->update($validated);
 
        return redirect(route('impacts.show', $impact));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Impact  $impact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impact $impact)
    {
        $impact->delete();
 
        return redirect(route('impacts.index'));
    }
}
