<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('organisation', 'OrganisationController');
Route::resource('organisational-unit', 'OrganisationalUnitController');
Route::resource('employee', 'EmployeeController');
Route::resource('industry', 'IndustryController');
Route::resource('sector', 'SectorController');
Route::resource('impact', 'ImpactController');
Route::resource('outcome', 'OutcomeController');
Route::resource('output', 'OutputController');
Route::resource('activity', 'ActivityController');
Route::resource('task', 'TaskController');
Route::resource('feedback', 'FeedbackController');
Route::resource('swot-analysis', 'SwotAnalysisController');
Route::resource('performance-indicator', 'PerformanceIndicatorController');
Route::resource('output-performance-indicator', 'OutputPerformanceIndicatorController');
Route::resource('performance-assessment', 'PerformanceAssessmentController');
Route::resource('employee-activity', 'EmployeeActivityController');
Route::resource('task-resource', 'TaskResourceController');
Route::resource('resource', 'ResourceController');
Route::resource('general-ledger', 'GeneralLedgerController');