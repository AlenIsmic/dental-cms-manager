<?php

namespace App\Http\Controllers;

use App\MedicinskiKarton;
use App\Pregled;
use Illuminate\Http\Request;
use App\Klijent;
use Validator;
use Exception;

class KlijentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klijenti = Klijent::all();
        return view('klijent', compact('klijenti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klijent-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        if($request->hasfile('filename'))
        {
            $file = $request->file('filename');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
        }
        */
        $validator = Validator::make($request->all(), [
            'ime' => 'required|max:20',
            'prezime' => 'required|max:20',
            'email' => 'nullable|email',
            'datum_rodjenja' => 'required|max:20|date:YY/mm/DD',
            'pol' => 'required|max:1',
        ], [
            'ime.required' => 'Morate unijeti ime!',
            'prezime.required' => 'Morate unijeti prezime!',
            'email.email' => 'Email adresa mora biti validna!',
            'datum_rodjenja.required' => 'Morate unijeti datum rodjenja!',
            'datum_rodjenja.date' => 'Datum mora biti u formatu YYYY/mm/dd npr. 2000/01/20',
            'pol.required' => 'Morate unijeti pol za osobu!'
        ]);

        if ($validator->fails()) {
            return redirect('klijent/create')
                ->withErrors($validator)
                ->withInput();
        }

        $klijent= new Klijent();
        $klijent->ime=$request->get('ime');
        $klijent->prezime=$request->get('prezime');
        $klijent->broj_telefona=$request->get('broj_telefona');
        $klijent->email=$request->get('email');
        $klijent->datum_rodjenja = $request->get('datum_rodjenja');
        $klijent->adresa=$request->get('adresa');
        $klijent->pol=$request->get('pol');
        $klijent->opcina=$request->get('opcina');
        $klijent->save();
        return redirect('klijent/' . $klijent->id )->with('success', 'Klijent uspijesno dodan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $klijent = Klijent::find($id);
        $karton = MedicinskiKarton::where('klijent_id', $klijent->id)->first();
        $pregledi = null;
        try {
            $pregledi = Pregled::where('medicinski_karton_id', $karton->id)->get();
        }
        catch (Exception $ex) {

        }
        return view('klijent-pregledaj')->with('klijent', $klijent)
            ->with('karton', $karton)
            ->with('pregledi', $pregledi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $klijent = \App\Klijent::find($id);
        return view('klijent-edit',compact('klijent','id'));
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
        $klijent= Klijent::find($id);
        $klijent->ime=$request->get('ime');
        $klijent->prezime=$request->get('prezime');
        $klijent->broj_telefona=$request->get('broj_telefona');
        $klijent->email=$request->get('email');
        $klijent->datum_rodjenja=$request->get('datum_rodjenja');
        $klijent->adresa=$request->get('adresa');
        $klijent->pol=$request->get('pol');
        $klijent->opcina=$request->get('opcina');
        $klijent->save();
        return redirect('klijent');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $klijent = Klijent::find($id);
        $klijent->delete();
        return redirect('klijent')->with('success','Information has been  deleted');

    }
}
