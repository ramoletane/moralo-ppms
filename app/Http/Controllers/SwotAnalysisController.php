<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SwotAnalysis;

class SwotAnalysisController extends Controller
{
    /**
	 * Index function for general listing.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request)
	{
		$swotAnalysis = SwotAnalysis::all();
 
		return response()->json($swotAnalysis);
	}
 
	/**
	 * Store-Action
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request)
	{
		$swotAnalysis = SwotAnalysis::create($request->all());
 
		return response()->json($swotAnalysis);
	}
 
	/**
	 * Show-Action
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Request $request, $id)
	{
		$swotAnalysis = SwotAnalysis::find($id);
 
		return response()->json($swotAnalysis);
	}
 
	/**
	 * Update-Action
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, $id)
	{
		$swotAnalysis = SwotAnalysis::findOrFail($id);
		$swotAnalysis->update($request->all());
 
		return response()->json($swotAnalysis);
 
 
	}
 
	/**
	 * Destroy-Action
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Request $request, $id)
	{
		SwotAnalysis::find($id)->delete();
 
		return response()->json([], 204);
	}
}
