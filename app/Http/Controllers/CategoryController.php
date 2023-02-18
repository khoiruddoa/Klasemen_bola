<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fight;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'dashboard.categories.index',
            [
                'categories' => Category::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
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

            'name' => 'required|max:150|unique:categories',
            'city' => 'required|max:150'
        ]);
        Category::create($validatedData);
        return redirect('/dashboard/categories')->with('success', 'klub sukses ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $cek = Fight::where('home_id', $category->id)->get();
        $cek2 = Fight::where('away_id', $category->id)->get();

        if(count($cek) > 0 || count($cek2) > 0){
            return redirect('/dashboard/categories')->with('failed', 'Klub sudah bertanding. tidak bisa dihapus');

        }
        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', 'Klub dihapus');
    }
}
