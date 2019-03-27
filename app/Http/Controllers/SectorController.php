<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sector;

class SectorController extends Controller
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
		if ($request->route()->named('sectors')) {
			return view('sectors');
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
//		$sectors = Sector::all();
		$sectors = DB::table('sectors')
			->join('industries', 'sectors.industry_id', '=', 'industries.id')
			->select('sectors.id', 'sector_name', 'industry_id', 'industry_name')
			->get();
 
		return response()->json($sectors);
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
		$sector = Sector::create($request->all());
 
		return response()->json($sector);
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
		$sector = Sector::find($id);
 
		return response()->json($sector);
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
		$sector = Sector::findOrFail($id);
		$sector->update($request->all());
 
		return response()->json($sector);
 
 
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
		Sector::find($id)->delete();
 
		return response()->json([], 204);
	}
}
