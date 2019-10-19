<?php

namespace App\Http\Controllers;

use App\Zub;
use App\ZubKarton;
use Illuminate\Http\Request;
use App\MedicinskiKarton;

class MedicinskiKartonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kartoni = MedicinskiKarton::paginate(10);
        return view('medicniski-karton', compact('kartoni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('medicinski-karton-create')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karton= new MedicinskiKarton();
        $karton->klijent_id=$request->get('klijent_id');
        $karton->krvna_grupa=$request->get('krvna_grupa');
        $karton->alergije=$request->get('alergije');
        $karton->trenutne_bolesti=$request->get('trenutne_bolesti');
        $karton->save();

        return redirect("klijent/$karton->klijent_id")->with('success', 'Medicinski karton za klijenta uspijesno dodan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karton = MedicinskiKarton::find($id);
        return view('medicinski-karton-pregledaj', compact('karton', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karton = MedicinskiKarton::find($id);
        return view('medicinski-karton-edit',compact('karton','id'));
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
        $karton = MedicinskiKarton::find($id);
        $karton->klijent_id=$request->get('klijent_id');
        $karton->krvna_grupa=$request->get('krvna_grupa');
        $karton->alergije=$request->get('alergije');
        $karton->trenutne_bolesti=$request->get('trenutne_bolesti');
        $karton->save();
        return redirect('medicinski-karton');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karton = MedicinskiKarton::find($id);
        $karton->delete();
        return redirect('medicinski-karton')->with('success','Information has been deleted');
    }
}