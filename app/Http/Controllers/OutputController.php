<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Output;

class OutputController extends Controller
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
	 * @param Integer $outcomeId
	 *
     * @return array
     */
	public function frontend($outcomeId)
	{
		$outcome = DB::table('outcomes')
			->join('impacts', 'outcomes.impact_id', '=', 'impacts.id')
			->where('outcomes.id', $outcomeId)
			->get();
		
		$outputs = DB::table('outputs')
			->join('outcomes', 'outputs.outcome_id', '=', 'outcomes.id')
			->join('sectors', 'outputs.sector_id', '=', 'sectors.id')
			->select('outputs.id', 'output_name', 'sector_id', 'sector_name')
			->where('outcomes.id', $outcomeId)
			->get();

		return view('outputs', ['outputs' => $outputs, 'outcome' => $outcome]);
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
		$outputs = Output::all();
 
		return response()->json($outputs);
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
		$output = Output::create($request->all());
 
		return response()->json($output);
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
		$output = Output::find($id);
 
		return response()->json($output);
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
		$output = Output::findOrFail($id);
		$output->update($request->all());
 
		return response()->json($output);
 
 
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
		Output::find($id)->delete();
 
		return response()->json([], 204);
	}
}
