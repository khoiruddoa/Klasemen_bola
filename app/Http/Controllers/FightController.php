<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FightController extends Controller
{

    public function index()

    {

        $result = DB::table('fights')
            ->join('categories as home', 'fights.home_id', '=', 'home.id')
            ->join('categories as away', 'fights.away_id', '=', 'away.id')
            ->select('home.name as home', 'away.name as away', 'home_score', 'away_score')
            ->orderBy('fights.id', 'desc')
            ->paginate(10);

        return view(
            'dashboard.pertandingan.index',
            [
                'fights' => $result
            ]
        );
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.pertandingan.create', ['categories' => $categories]);
    }

    public function multiple()
    {
        $categories = Category::all();
        return view('dashboard.pertandingan.multiple', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'home_id' => 'required|max:150',
            'away_id' => 'required|max:150',
            'home_score' => 'required|max:150',
            'away_score' => 'required|max:150',
        ]);
        $homepoint = 0;
        $awaypoint = 0;

        if ($request->home_score == $request->away_score) {

            $homepoint = 1;
            $awaypoint = 1;
        } else if ($request->home_score > $request->away_score) {
            $homepoint = 3;
            $awaypoint = 0;
        } else {
            $homepoint = 0;
            $awaypoint = 3;
        }

        $validatedData['home_point'] = $homepoint;
        $validatedData['away_point'] = $awaypoint;
        $cek = Fight::where('home_id', $request->home_id)
            ->where('away_id', $request->away_id)
            ->get();
        if ($request->home_id == $request->away_id) {
            return redirect('/dashboard/pertandingan')->with('failed', 'tidak boleh lawan tim yang sama');
        } else if (count($cek) != 0) {
            return redirect('/dashboard/pertandingan')->with('failed', 'pertandingan sudah pernah dilakukan');
        }
        Fight::create($validatedData);
        return redirect('/dashboard/pertandingan')->with('success', 'pertandingan sukses ditambahkan');
    }

    public function multiplestore(Request $request)

    {
        $validatedData = $request->validate([
            'home_id.*' => 'required|max:150',
            'away_id.*' => 'required|max:150',
            'home_score.*' => 'required|max:150',
            'away_score.*' => 'required|max:150',
        ]);

        foreach ($validatedData['home_id'] as $key => $value) {

            $homepoint = 0;
            $awaypoint = 0;

            if ($validatedData['home_score'][$key] == $validatedData['away_score'][$key]) {
                $homepoint = 1;
                $awaypoint = 1;
            } else if ($validatedData['home_score'][$key] > $validatedData['away_score'][$key]) {
                $homepoint = 3;
                $awaypoint = 0;
            } else {
                $homepoint = 0;
                $awaypoint = 3;
            }

            $data = [
                'home_id' => $validatedData['home_id'][$key],
                'away_id' => $validatedData['away_id'][$key],
                'home_score' => $validatedData['home_score'][$key],
                'away_score' => $validatedData['away_score'][$key],
                'home_point' => $homepoint,
                'away_point' => $awaypoint
            ];

            $cek = Fight::where('home_id', $validatedData['home_id'][$key])
                ->where('away_id', $validatedData['away_id'][$key])
                ->get();

            if ($validatedData['home_id'][$key] == $validatedData['away_id'][$key]) {
                return redirect('/dashboard/pertandingan')->with('failed', 'tidak boleh lawan tim yang sama');
            } else if (count($cek) != 0) {
                return redirect('/dashboard/pertandingan')->with('failed', 'pertandingan sudah pernah dilakukan');
            }

            Fight::create($data);
        }

        return redirect('/dashboard/pertandingan')->with('success', 'pertandingan sukses ditambahkan');
    }
}
