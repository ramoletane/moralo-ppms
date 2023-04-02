<?php

namespace App\Http\Controllers;

Use App\Models\Industry;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = DB::table('sectors')
                    ->join('industries', 'sectors.industry_id', '=', 'industries.id')
                    ->get();
        return view('sectors.index', [
            'sectors' => $sectors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sectors.create', [
            'options' => Industry::pluck('industry_name', 'id'),
        ]);
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
            'sector_name' => 'required|string|max:255',
            'industry_id' => 'numeric',
        ]);
 
        Sector::create($validated);
 
        return redirect(route('sectors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return view('sectors.show', [
            'sector' => Sector::find($sector->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        return view('sectors.edit', [
            'sector' => $sector,
            'options' => Industry::pluck('industry_name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        $validated = $request->validate([
            'sector_name' => 'required|string|max:255',
            'industry_id' => 'numeric',
        ]);
 
        $sector->update($validated);
 
        return redirect(route('sectors.index', $sector));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();
 
        return redirect(route('sector.index'));
    }
}
