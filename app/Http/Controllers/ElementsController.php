<?php

namespace App\Http\Controllers;

use App\Models\Elements;
use App\Models\Icons;
use App\Models\Shapes;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.dashboard.elements-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $icons = new Icons();
        $icons->name = $request->input('name');
        $icons->category = $request->input('category');
        $icons->svg = $request->input('svg');
        $icons->save();

//        $shapes = new Shapes();
//        $shapes->name = $request->input('name');
//        $shapes->svg = $request->input('svg');
//        $shapes->save();

        return redirect()->back()->with(['msg' => 'Added Successfully', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function show(Elements $elements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function edit(Elements $elements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Elements $elements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Elements $elements)
    {
        //
    }
}
