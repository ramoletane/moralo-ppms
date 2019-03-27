<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\OrganisationalUnit;

class OrganisationalUnitController extends Controller
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
		if ($request->route()->named('organisational-units')) {
			return view('organisational-units');
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
//		$organisationalUnits = OrganisationalUnit::all();
		$organisationalUnits = DB::table('organisational_units')
									->join('organisations', 'organisational_units.company_id', '=', 'organisations.id')
									->select('organisational_units.id', 'unit_name', 'parent_unit_id', 'company_id', 'company_name')
									->get();
 
		return response()->json($organisationalUnits);
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
		$organisationalUnit = OrganisationalUnit::create($request->all());
 
		return response()->json($organisationalUnit);
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
		$organisationalUnit = OrganisationalUnit::find($id);
 
		return response()->json($organisationalUnit);
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
		$organisationalUnit = OrganisationalUnit::findOrFail($id);
		$organisationalUnit->update($request->all());
 
		return response()->json($organisationalUnit);
 
 
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
		OrganisationalUnit::find($id)->delete();
 
		return response()->json([], 204);
	}
}
