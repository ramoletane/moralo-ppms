<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskResource;

class TaskResourceController extends Controller
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
		$taskResource = TaskResource::all();
 
		return response()->json($taskResource);
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
		$taskResource = TaskResource::create($request->all());
 
		return response()->json($taskResource);
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
		$taskResource = TaskResource::find($id);
 
		return response()->json($taskResource);
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
		$taskResource = TaskResource::findOrFail($id);
		$taskResource->update($request->all());
 
		return response()->json($taskResource);
 
 
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
		TaskResource::find($id)->delete();
 
		return response()->json([], 204);
	}
}
