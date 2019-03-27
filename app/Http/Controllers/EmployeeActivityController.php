<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeActivity;

class EmployeeActivityController extends Controller
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
		$employeeActivity = EmployeeActivity::all();
 
		return response()->json($employeeActivity);
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
		$employeeActivity = EmployeeActivity::create($request->all());
 
		return response()->json($employeeActivity);
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
		$employeeActivity = EmployeeActivity::find($id);
 
		return response()->json($employeeActivity);
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
		$employeeActivity = EmployeeActivity::findOrFail($id);
		$employeeActivity->update($request->all());
 
		return response()->json($employeeActivity);
 
 
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
		EmployeeActivity::find($id)->delete();
 
		return response()->json([], 204);
	}
}
