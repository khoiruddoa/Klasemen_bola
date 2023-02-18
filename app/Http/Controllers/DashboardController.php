<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Sell;
use App\Models\Buy;
use App\Models\Bill;
use App\Models\Pay;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    { $result = DB::table(function($subquery) {
        $subquery->select('c.name', 
                          DB::raw('count(f.home_id) as main'),
                          DB::raw('sum(case when f.home_point = 3 then 1 else 0 end) as menang'),
                          DB::raw('sum(case when f.home_point = 1 then 1 else 0 end) as seri'),
                          DB::raw('sum(case when f.home_point = 0 then 1 else 0 end) as kalah'),
                          DB::raw('sum(f.home_score) as gm'),
                          DB::raw('sum(f.away_score) as gk'),
                          DB::raw('sum(f.home_point) as point'))
                ->from('fights as f')
                ->join('categories as c', 'f.home_id', '=', 'c.id')
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
                      ->join('categories as c', 'f.away_id', '=', 'c.id')
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
    
        return view(
            'dashboard.index',['fights' => $result]
        );
    }
}
