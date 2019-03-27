<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;

class IndustryController extends Controller
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
		if ($request->route()->named('industries')) {
			return view('industries');
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
		$industries = Industry::all();
 
		return response()->json($industries);
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
		$industry = Industry::create($request->all());
 
		return response()->json($industry);
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
		$industry = Industry::find($id);
 
		return response()->json($industry);
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
		$industry = Industry::findOrFail($id);
		$industry->update($request->all());
 
		return response()->json($industry);
 
 
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
		Industry::find($id)->delete();
 
		return response()->json([], 204);
	}
}
