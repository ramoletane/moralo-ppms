<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\CompetencyGroupController;
use App\Http\Controllers\DevelopmentMethodController;
use App\Http\Controllers\SkillDevelopmentMethodController;
use App\Http\Controllers\ProficiencyLevelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('organisations', OrganisationController::class);
    Route::resource('industries', IndustryController::class);
    Route::resource('sectors', SectorController::class);
    Route::resource('impacts', ImpactController::class);
    Route::resource('competency_groups', CompetencyGroupController::class);
    Route::resource('development_methods', DevelopmentMethodController::class);
    Route::resource('skill_development_methods', SkillDevelopmentMethodController::class);
    Route::resource('proficiency_levels', ProficiencyLevelController::class);
});

Route::resource('results', ResultController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

Route::resource('competencies', CompetencyController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

Route::resource('performance', PerformanceController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
