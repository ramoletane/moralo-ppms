<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerformanceAssessment;

class PerformanceAssessmentController extends Controller
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
		$performanceAssessment = PerformanceAssessment::all();
 
		return response()->json($performanceAssessment);
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
		$performanceAssessment = PerformanceAssessment::create($request->all());
 
		return response()->json($performanceAssessment);
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
		$performanceAssessment = PerformanceAssessment::find($id);
 
		return response()->json($performanceAssessment);
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
		$performanceAssessment = PerformanceAssessment::findOrFail($id);
		$performanceAssessment->update($request->all());
 
		return response()->json($performanceAssessment);
 
 
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
		PerformanceAssessment::find($id)->delete();
 
		return response()->json([], 204);
	}
}
