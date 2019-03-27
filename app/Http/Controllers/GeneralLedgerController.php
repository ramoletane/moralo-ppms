<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralLedger;

class GeneralLedgerController extends Controller
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
		$generalLedger = GeneralLedger::all();
 
		return response()->json($generalLedger);
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
		$generalLedger = GeneralLedger::create($request->all());
 
		return response()->json($generalLedger);
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
		$generalLedger = GeneralLedger::find($id);
 
		return response()->json($generalLedger);
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
		$generalLedger = GeneralLedger::findOrFail($id);
		$generalLedger->update($request->all());
 
		return response()->json($generalLedger);
 
 
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
		GeneralLedger::find($id)->delete();
 
		return response()->json([], 204);
	}
}
