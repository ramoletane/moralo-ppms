<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OutputPerformanceIndicator;

class OutputPerformanceIndicatorController extends Controller
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
		$outputPerformanceIndicator = OutputPerformanceIndicator::all();
 
		return response()->json($outputPerformanceIndicator);
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
		$outputPerformanceIndicator = OutputPerformanceIndicator::create($request->all());
 
		return response()->json($outputPerformanceIndicator);
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
		$outputPerformanceIndicator = OutputPerformanceIndicator::find($id);
 
		return response()->json($outputPerformanceIndicator);
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
		$outputPerformanceIndicator = OutputPerformanceIndicator::findOrFail($id);
		$outputPerformanceIndicator->update($request->all());
 
		return response()->json($outputPerformanceIndicator);
 
 
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
		OutputPerformanceIndicator::find($id)->delete();
 
		return response()->json([], 204);
	}
}
