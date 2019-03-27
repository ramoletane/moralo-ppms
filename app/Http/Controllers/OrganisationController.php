<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;

class OrganisationController extends Controller
{
    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
	}

    /**
     * Frontend action to display user view.
     *
     * @return array
     */
	public function frontend(Request $request)
	{
		if ($request->route()->named('organisation')) {
			return view('organisation');
		}
	}

    /**
	 * Index function for general listing.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */ 
	public function index(Request $request)
	{
		$organisations = Organisation::all();
 
		return response()->json($organisations);
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
		$organisation = Organisation::create($request->all());
 
		return response()->json($organisation);
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
		$organisation = Organisation::find($id);
 
		return response()->json($organisation);
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
		$organisation = Organisation::findOrFail($id);
		$organisation->update($request->all());
 
		return response()->json($organisation);
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
		Organisation::find($id)->delete();
 
		return response()->json([], 204);
	}
}
