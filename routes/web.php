<?php

use App\Http\Livewire\Auth;
use App\Http\Livewire\Biri;
use App\Http\Livewire\Ratt;
use App\Http\Livewire\Beat;
use App\Http\Livewire\Search;
use App\Http\Livewire\Settings;
use App\Http\Livewire\Geographics;
use App\Http\Livewire\Documentations;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth as AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Livewire\Dashboard\Dashboard as DashboardDashboard;
use App\Http\Livewire\DragDropList;

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

Route::redirect('/', 'login', 301);

Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->prefix(LaravelLocalization::setLocale())->group(function () {
        Route::get('login', Auth\Login::class)->name('login');
        Route::get('password/reset', Auth\Passwords\Email::class)->name('password.request');
        Route::get('password/reset/{token}', Auth\Passwords\Reset::class)->name('password.reset');
        Route::get('register/{token}', Auth\Register::class)->name('register');
        Route::post('logout', [AuthController\LogoutController::class, 'logout'])->name('logout');

        Route::middleware('auth')->group(function () {
            Route::get('test-drag', DragDropList::class)->name('test-drag');
            Route::get('email/verify', Auth\Verify::class)->middleware('throttle:6,1')->name('verification.notice');
            Route::get('email/verify/{id}/{hash}', AuthController\EmailVerificationController::class)->middleware('signed')->name('verification.verify');
            Route::get('password/confirm', Auth\Passwords\Confirm::class)->name('password.confirm');
            // ADMIN
            Route::middleware(['verified'])->prefix("admin")->name("admin.")->group(function () {

                Route::get('/', DashboardDashboard::class)->name('dashboard');
                Route::get('search', Search::class)->name('search');
                //Settings
                Route::prefix("settings")->name("settings.")->group(function () {
                    Route::get("/employees", Settings\Users\Index::class)->name("users.index");
                    Route::get("/employees/{id}", Settings\Users\Show::class)->name("users.show");
                    Route::get("/teams", Settings\Teams\Index::class)->name("teams.index");
                    Route::get("/roles", Settings\Roles\Index::class)->name("roles.index");
                    Route::get("/permissions", Settings\Permissions\Index::class)->name("permissions.index");
                    Route::get("/technologies", Settings\Technologies\Index::class)->name("technologies.index");
                    Route::get("/settings", Settings\Settings\Index::class)->name("settings.index");
                });
                /**END settings */
                /** Documentations */
                Route::middleware('SuperAdmin')->prefix('documentations')->name('documentations.')->group(function () {
                    Route::get('/categories', Documentations\Categories\Index::class)->name('categories.index');
                    Route::get('/', Documentations\Documentations\Index::class)->name('index');
                    Route::get('/{slug}', Documentations\Documentations\Show::class)->name('show');
                });
                /**END Documentations */
                /** Geographics area */
                Route::prefix("geographics")->name("geographics.")->group(function () {
                    Route::get("/countries", Geographics\Countries\Index::class)->name("countries.index");
                    Route::get("/states", Geographics\States\Index::class)->name("states.index");
                    Route::get("/regions", Geographics\Regions\Index::class)->name("regions.index");
                    Route::get("/cities", Geographics\Cities\Index::class)->name("cities.index");
                    Route::get("/sites", Geographics\Sites\Index::class)->name("sites.index");
                    Route::get('/sites/types', Settings\Sites\Index::class)->name("sites.types.index");
                    Route::get('/geographics/types', Settings\Geographics\Index::class)->name("geographics.types.index");
                });
                /** END geographics area */
                /** RATT */
                Route::prefix('ratt')->name('ratt.')->group(function () {
                    Route::get('/', Ratt\Dashboard\Dashboard::class)->name('dashboard');
                    Route::get("/projects", Ratt\Projects\Index::class)->name("projects.index");
                    Route::get("/projects/show/{id}", Ratt\Projects\Show::class)->name("projects.show");
                    Route::get("/networks/show/{id}", Ratt\Networks\Show::class)->name("networks.show");
                    Route::get("/networks/show/{id}/{parameter}", Ratt\Networks\Show::class)->name("networks.show.params");
                    Route::get("/tasks", Ratt\Tasks\Index::class)->name("tasks.index");
                    Route::get("/scenarios", Ratt\Scenarios\Index::class)->name("scenarios.index");
                });
                /** END RATT */
                /** BEAT */
                Route::prefix('beat')->name('beat.')->group(function () {
                    Route::get('/', Beat\Dashboard::class)->name('dashboard');
                    Route::get('/settings', Beat\Settings\Index::class)->name('settings.index');
                    Route::prefix('alarms')->name('alarms.')->group(function () {
                        Route::get('/alarms', Beat\Alarms\Alarms\Index::class)->name('alarms.index');
                        Route::get('/systems', Beat\Alarms\Systems\Index::class)->name('systems.index');
                    });
                });
                /** END BEAT */
                /** BEAT */
                Route::prefix('biri')->name('biri.')->group(function () {
                    Route::get('/', Biri\Dashboard::class)->name('dashboard');
                    Route::prefix('assignments')->name('assignments.')->group(function () {
                        Route::get('/', Biri\Assignments\Index::class)->name('index');
                    });
                    Route::prefix('settings')->name('settings.')->group(function () {
                        Route::get('/technologies', Biri\Technologies\Index::class)->name('technologies.index');
                        Route::get('/equipments', Biri\Equipments\Index::class)->name('equipments.index');
                        Route::get('/category-activities', Biri\CategoryActivities\Index::class)->name('category-activities.index');
                        Route::get('/activities', Biri\Activities\Index::class)->name('activities.index');
                        Route::get('/isq', Biri\Isq\Index::class)->name('isq.index');
                        Route::get('/isq/show/{id}', Biri\Isq\Show::class)->name('isq.show');
                        Route::get('/milestones', Biri\Milestones\Index::class)->name('milestones.index');
                        Route::get('/milestones/show/{id}', Biri\Milestones\Show::class)->name('milestones.show');
                    });
                });
                /** END BEAT */
            });
        });
    });
