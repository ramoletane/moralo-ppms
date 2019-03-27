<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
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
		if ($request->route()->named('employees')) {
			return view('employees');
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
//		$employees = Employee::all();
		$employees = DB::table('employees')
			->join('organisational_units', 'employees.unit_id', '=', 'organisational_units.id')
			->select('employees.id', 'firstname', 'surname', 'job_title', 'email_address', 'phone_number', 'unit_id', 'unit_name')
			->get();

		return response()->json($employees);
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
		$employee = Employee::create($request->all());
 
		return response()->json($employee);
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
		$employee = Employee::find($id);
 
		return response()->json($employee);
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
		$employee = Employee::findOrFail($id);
		$employee->update($request->all());
 
		return response()->json($employee);
 
 
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
		Employee::find($id)->delete();
 
		return response()->json([], 204);
	}
}
