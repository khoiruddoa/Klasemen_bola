<?php


use App\Models\Category;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FightController;
use Illuminate\Support\Facades\DB;

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

   $result = DB::table(function($subquery) {
    $subquery->select('c.name', 
                      DB::raw('count(f.home_id) as main'),
                      DB::raw('sum(case when f.home_point = 3 then 1 else 0 end) as menang'),
                      DB::raw('sum(case when f.home_point = 1 then 1 else 0 end) as seri'),
                      DB::raw('sum(case when f.home_point = 0 then 1 else 0 end) as kalah'),
                      DB::raw('sum(f.home_score) as gm'),
                      DB::raw('sum(f.away_score) as gk'),
                      DB::raw('sum(f.home_point) as point'))
            ->from('fights as f')
            ->leftJoin('categories as c', 'f.home_id', '=', 'c.id')
            ->groupBy('c.name')
            ->union(
                DB::table('fights as f')
                  ->select('c.name', 
                           DB::raw('count(f.away_id) as main'),
                           DB::raw('sum(case when f.away_point = 3 then 1 else 0 end) as menang'),
                           DB::raw('sum(case when f.away_point = 1 then 1 else 0 end) as seri'),
                           DB::raw('sum(case when f.away_point = 0 then 1 else 0 end) as kalah'),
                           DB::raw('sum(f.away_score) as gm'),
                           DB::raw('sum(f.home_score) as gk'),
                           DB::raw('sum(f.away_point) as point'))
                  ->leftJoin('categories as c', 'f.away_id', '=', 'c.id')
                  ->groupBy('c.name')
            )
            ->toSql();
}, 'result')
->select('result.name', 
          DB::raw('sum(result.main) as main'), 
          DB::raw('sum(result.menang) as menang'), 
          DB::raw('sum(result.seri) as seri'), 
          DB::raw('sum(result.kalah) as kalah'), 
          DB::raw('sum(result.gm) as goal_menang'), 
          DB::raw('sum(result.gk) as goal_kalah'), 
          DB::raw('sum(result.point) as point'))
->groupBy('result.name')
->orderByDesc('point')
->get();


    return view('home', [
        "title" => "home",
        'active' => 'home',
        'fights'=> $result,
    ]);
});







Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); //untuk user yang belum login
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');



Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');


Route::get('/dashboard/pertandingan', [FightController::class, 'index'])->middleware('auth');
Route::get('/dashboard/pertandingan/create', [FightController::class, 'create'])->middleware('auth');
Route::post('/dashboard/pertandingan/create', [FightController::class, 'store'])->middleware('auth');
Route::post('/dashboard/pertandingan/multiplecreate', [FightController::class, 'multiplestore'])->middleware('auth');
Route::get('/dashboard/multiple', [FightController::class, 'multiple'])->middleware('auth');



