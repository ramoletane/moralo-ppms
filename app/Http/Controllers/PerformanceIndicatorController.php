<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerformanceIndicator;

class PerformanceIndicatorController extends Controller
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
		$performanceIndicator = PerformanceIndicator::all();
 
		return response()->json($performanceIndicator);
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
		$performanceIndicator = PerformanceIndicator::create($request->all());
 
		return response()->json($performanceIndicator);
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
		$performanceIndicator = PerformanceIndicator::find($id);
 
		return response()->json($performanceIndicator);
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
		$performanceIndicator = PerformanceIndicator::findOrFail($id);
		$performanceIndicator->update($request->all());
 
		return response()->json($performanceIndicator);
 
 
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
		PerformanceIndicator::find($id)->delete();
 
		return response()->json([], 204);
	}
}
