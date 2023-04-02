<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentMethod;
use App\Models\SkillDevelopmentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillDevelopmentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skillDevelopmentMethods = DB::table('skill_development_methods')
            ->join('skills', 'skill_development_methods.skill_id', '=', 'skills.id')
            ->join('development_methods', 'skill_development_methods.development_method_id', '=', 'development_methods.id')
            ->get();
        return view('skill_development_methods.index', [
            'skillDevelopmentMethods' => $skillDevelopmentMethods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skill_development_methods.create', [
            'options' => DevelopmentMethod::pluck('method_name', 'id'),
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
            'skill_id' => 'numeric',
            'development_method_id' => 'numeric',
        ]);
 
        SkillDevelopmentMethod::create($validated);
 
        return redirect(route('skill_development_methods.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SkillDevelopmentMethod  $skillDevelopmentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(SkillDevelopmentMethod $skillDevelopmentMethod)
    {
        $data = SkillDevelopmentMethod::whereId($skillDevelopmentMethod->id)->first();
        return view('skill_development_methods.show', [
            'skillDevelopmentMethod' => $data,
        ]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SkillDevelopmentMethod  $skillDevelopmentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(SkillDevelopmentMethod $skillDevelopmentMethod)
    {
        return view('skill_development_methods.edit', [
            'skillDevelopmentMethod' => $skillDevelopmentMethod,
            'options' => DevelopmentMethod::pluck('method_name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SkillDevelopmentMethod  $skillDevelopmentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SkillDevelopmentMethod $skillDevelopmentMethod)
    {
        $validated = $request->validate([
            'skill_id' => 'numeric',
            'development_method_id' => 'numeric',
        ]);
 
        $skillDevelopmentMethod->update($validated);
 
        return redirect(route('skill_development_methods.index', $skillDevelopmentMethod));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SkillDevelopmentMethod  $skillDevelopmentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillDevelopmentMethod $skillDevelopmentMethod)
    {
        $skillDevelopmentMethod->delete();
 
        return redirect(route('skill_development_methods.index'));
    }
}
