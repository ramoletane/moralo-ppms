<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentMethod;
use Illuminate\Http\Request;

class DevelopmentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('development_methods.index', [
            'development_methods' => DevelopmentMethod::all(),
        ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('development_methods.create');
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
            'method_name' => 'required|string|max:255',
        ]);
 
        DevelopmentMethod::create($validated);
 
        return redirect(route('development_methods.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DevelopmentMethod  $developmentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(DevelopmentMethod $developmentMethod)
    {
        return view('development_methods.show', [
            'developmentMethod' => DevelopmentMethod::find($developmentMethod->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DevelopmentMethod  $developmentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(DevelopmentMethod $developmentMethod)
    {
        return view('development_methods.edit', [
            'developmentMethod' => $developmentMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DevelopmentMethod  $developmentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DevelopmentMethod $developmentMethod)
    {
        $validated = $request->validate([
            'method_name' => 'required|string|max:255',
        ]);
 
        $developmentMethod->update($validated);
 
        return redirect(route('development_methods.show', $developmentMethod));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DevelopmentMethod  $developmentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(DevelopmentMethod $developmentMethod)
    {
        $developmentMethod->delete();
 
        return redirect(route('development_methods.index'));
    }
}
