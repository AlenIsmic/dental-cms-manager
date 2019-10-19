<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dijagnoza;

class DijagnozaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dijagnoze = Dijagnoza::all();
        return view('dijagnoza', compact('dijagnoze'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dijagnoza-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'naziv' => 'unique:dijagnozas|required'
        ], [
            'naziv.unique' => 'Dijagnoza već postoji!',
            'naziv.required' => 'Morate unijeti naziv dijagnoze!'
        ]);
        $dijagnoza= new Dijagnoza();
        $dijagnoza->naziv=$request->get('naziv');
        $dijagnoza->save();
        return back()->with('success', 'Dijagnoza uspijesno dodana!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dijagnoza = Dijagnoza::find($id);
        return view('dijagnoza-pregledaj', compact('dijagnoza', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'naziv' => 'unique:dijagnozas|required'
        ], [
            'naziv.unique' => 'Dijagnoza već postoji!',
            'naziv.required' => 'Morate unijeti naziv dijagnoze!'
        ]);
        $dijagnoza = Dijagnoza::find($id);
        $dijagnoza->naziv=$request->get('naziv');
        $dijagnoza->save();
        return redirect('dijagnoza');
        //return view('dijagnoza-edit',compact('dijagnoza','id'));
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
        $dijagnoza = Dijagnoza::find($id);
        $dijagnoza->naziv=$request->get('naziv');
        $dijagnoza->save();
        return redirect('dijagnoza');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dijagnoza = Dijagnoza::find($id);
        $dijagnoza->delete();
        return redirect('dijagnoza')->with('success','Information has been  deleted');
    }
}
