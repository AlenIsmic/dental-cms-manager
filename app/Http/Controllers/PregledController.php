<?php

namespace App\Http\Controllers;

use App\Dijagnoza;
use App\Klijent;
use App\MedicinskiKarton;
use App\Pregled;
use App\Zub;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use Validator;
use DB;

class PregledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pregledi = Pregled::all();
        return view('pregledi', compact('pregledi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dijagnoze = Dijagnoza::all();
        $karton = MedicinskiKarton::find($id);
        return view('pregled-create')->with('id', $id)
            ->with('dijagnoze', $dijagnoze)
            ->with('klijent_id', $karton->klijent_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datum_pregleda' => 'required|max:20|date:YY/mm/DD',
            'cijena' => 'required|numeric',
            'placeno' => 'required'
        ], [
            'datum_pregleda.required' => 'Morate unijeti datum pregleda!',
            'datum_pregleda.date' => 'Datum mora biti u formatu YYYY/mm/dd npr. 2000/01/20',
            'cijena.required' => 'Morate unijeti cijenu pregleda!',
            'cijena.numeric' => 'Cijena mora biti u brojevima',
            'placeno.required' => 'Morate unijeti informaciju da li je pregled plaćen'
        ]);

        if ($validator->fails()) {
            return redirect('pregled/create/' . $request->get('medicinski_karton_id'))
                ->withErrors($validator)
                ->withInput();
        }
        $pregled = new Pregled();
        $pregled->medicinski_karton_id = $request->get('medicinski_karton_id');
        $pregled->datum = $request->get('datum_pregleda');
        $pregled->napomena = $request->get('napomena_pregled');
        $pregled->cijena = $request->get('cijena');
        $pregled->placeno = $request->get('placeno');

        $pregled->save();

        for ($i = 11; $i<=18; $i++) {
            $zub = new Zub();
            $zub->pregled_id = $pregled->id;
            $zub->oznaka = $i;
            $zub->pozicija = $request->get('zub_pozicije_' . $i);
            $zub->lijekovi = $request->get('lijekovi_zub_' . $i);
            $zub->napomena = $request->get('napomena_zub_' . $i);
            $zub->save();

            $zub_dijagnoza = $request->get('zub_dijagnoze_' . $i);
            $zub_dijagnoze = preg_split("~;~", $zub_dijagnoza);

            for ($j = 0; $j < sizeof($zub_dijagnoze); $j++) {
                $dijagnoza = Dijagnoza::where('naziv', $zub_dijagnoze[$j])->get();
                $zub->dijagnoze()->attach($dijagnoza);
            }
        }

        for ($i = 21; $i<=28; $i++) {
            $zub = new Zub();
            $zub->pregled_id = $pregled->id;
            $zub->oznaka = $i;
            $zub->pozicija = $request->get('zub_pozicije_' . $i);
            $zub->lijekovi = $request->get('lijekovi_zub_' . $i);
            $zub->napomena = $request->get('napomena_zub_' . $i);
            $zub->save();

            $zub_dijagnoza = $request->get('zub_dijagnoze_' . $i);
            $zub_dijagnoze = preg_split("~;~", $zub_dijagnoza);

            for ($j = 0; $j < sizeof($zub_dijagnoze); $j++) {
                $dijagnoza = Dijagnoza::where('naziv', $zub_dijagnoze[$j])->get();
                $zub->dijagnoze()->attach($dijagnoza);
            }
        }
        for ($i = 31; $i<=38; $i++) {
            $zub = new Zub();
            $zub->pregled_id = $pregled->id;
            $zub->oznaka = $i;
            $zub->pozicija = $request->get('zub_pozicije_' . $i);
            $zub->lijekovi = $request->get('lijekovi_zub_' . $i);
            $zub->napomena = $request->get('napomena_zub_' . $i);
            $zub->save();

            $zub_dijagnoza = $request->get('zub_dijagnoze_' . $i);
            $zub_dijagnoze = preg_split("~;~", $zub_dijagnoza);

            for ($j = 0; $j < sizeof($zub_dijagnoze); $j++) {
                $dijagnoza = Dijagnoza::where('naziv', $zub_dijagnoze[$j])->get();
                $zub->dijagnoze()->attach($dijagnoza);
            }
        }
        for ($i = 41; $i<=48; $i++) {
            $zub = new Zub();
            $zub->pregled_id = $pregled->id;
            $zub->oznaka = $i;
            $zub_pozicije = $request->get('zub_pozicije_' . $i);

            $zub->pozicija = $zub_pozicije;

            $zub->lijekovi = $request->get('lijekovi_zub_' . $i);
            $zub->napomena = $request->get('napomena_zub_' . $i);
            $zub->save();

            $zub_dijagnoza = $request->get('zub_dijagnoze_' . $i);
            $zub_dijagnoze = preg_split("~;~", $zub_dijagnoza);

            for ($j = 0; $j < sizeof($zub_dijagnoze); $j++) {
                $dijagnoza = Dijagnoza::where('naziv', $zub_dijagnoze[$j])->get();
                $zub->dijagnoze()->attach($dijagnoza);
            }
        }

        return redirect("/klijent/" . $request->get('klijent_id'))->with('success', 'Pregled uspijesno dodan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pregled = Pregled::find($id);
        $mkarton = MedicinskiKarton::find($pregled->medicinski_karton_id);
        $klijent = Klijent::find($mkarton->klijent_id);
        $zubi = Zub::where('pregled_id', $pregled->id)->get();

        $zubidijagnoze = [];
        for ($i = 0; $i <  sizeof($zubi); $i++)
        array_push($zubidijagnoze, DB::table('zub_dijagnoze')->select()->where('zub_id', '=', $zubi[$i]->id)->get());
        //echo(($zubidijagnoze[0]));
        $dijagnoze = Dijagnoza::all();
        //echo ($dijagnoze);
        return view('pregled')->with('pregled', $pregled)
                                    ->with('karton', $mkarton)
                                    ->with('klijent', $klijent)
                                    ->with('zubi', $zubi)
                                    ->with('zubidijagnoze', $zubidijagnoze)
                                    ->with('dijagnoze', $dijagnoze);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pregled = Pregled::find($id);
        return view('pregled-edit',compact('pregled','id'));
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
        $pregled = Pregled::find($id);
        $pregled->napomena = $request->get('napomena');
        $pregled->cijena = $request->get('cijena');
        $pregled->placeno = $request->get('placeno');
        $pregled->save();
        return redirect('pregled');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregled = Pregled::find($id);
        $pregled->delete();
        return redirect('pregled')->with('success','Information has been deleted');
    }
}
