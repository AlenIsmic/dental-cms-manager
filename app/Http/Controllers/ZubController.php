<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zub = Zub::all();
        return view('zub', compact('zub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('zub-create')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zub = new Zub();
        $zub->pregled_id = $request->get('pregled_id');
        $zub->oznaka = $request->get('oznaka');
        $zub->napomena = $request->get('napomena');
        $zub->save();

        //return redirect("/")->with('success', 'Zub uspijesno dodan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zub = Zub::find($id);
        return view('zub', compact('zub', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zub = Zub::find($id);
        return view('zub-edit',compact('zub','id'));
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
        $zub = Zub::find($id);
        $zub->pregled_id = $request->get('pregled_id');
        $zub->oznaka = $request->get('oznaka');
        $zub->napomena = $request->get('napomena');
        $zub->save();
        return redirect('zub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zub = Zub::find($id);
        $zub->delete();
        return redirect('zub')->with('success','Information has been deleted');
    }
}
