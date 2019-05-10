<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Outcome;

class OutcomeController extends Controller
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
	 * @param Integer $impactId
	 *
     * @return array
     */
	public function frontend($impactId = NULL)
	{
		$impact = DB::table('impacts')
			->where('id', $impactId)
			->get();
		
		if (isset($impactId)) {			
			$outcomes = DB::table('outcomes')
				->join('organisations', 'outcomes.company_id', '=', 'organisations.id')
				->join('impacts', 'outcomes.impact_id', '=', 'impacts.id')
				->select('outcomes.id', 'outcome_name', 'company_id', 'company_name')
				->where('impacts.id', $impactId)
				->get();
		} else {
			$outcomes = DB::table('outcomes')
				->join('organisations', 'outcomes.company_id', '=', 'organisations.id')
				->select('outcomes.id', 'outcome_name', 'company_id', 'company_name')
				->get();
		}
		
		return view('outcomes', ['outcomes' => $outcomes, 'impact' => $impact]);
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
		$outcomes = Outcome::all();

		return response()->json($outcomes);
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
		$outcome = Outcome::create($request->all());
 
		return response()->json($outcome);
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
		$outcome = Outcome::find($id);
 
		return response()->json($outcome);
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
		$outcome = Outcome::findOrFail($id);
		$outcome->update($request->all());
 
		return response()->json($outcome);
 
 
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
		Outcome::find($id)->delete();
 
		return response()->json([], 204);
	}
}
