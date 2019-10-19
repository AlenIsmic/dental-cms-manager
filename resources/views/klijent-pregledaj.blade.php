@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Informacije o klijentu</h3>
                <hr class="style-two">
                @csrf
            </div>
            <div class="col-6">
                <h3>Medicinski karton</h3>
                <hr class="style-two">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6 border-right">
                <input name="_method" type="hidden" value="PATCH">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Ime:</span>
                    </div>
                    <p type="text" class="form-control" name="ime" style="height: auto">{{$klijent->ime}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Prezime:</span>
                    </div>
                    <p type="text" class="form-control" name="prezime" style="height: auto">{{$klijent->prezime}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Broj telefona:</span>
                    </div>
                    <p type="text" class="form-control" name="broj_telefona" style="height: auto">{{$klijent->broj_telefona}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">E-mail:</span>
                    </div>
                    <p type="text" class="form-control" name="email" style="height: auto">{{$klijent->email}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Datum rođenja:</span>
                    </div>
                    <p type="text" class="form-control" name="datum_rodjenja" style="height: auto;">{{$klijent->datum_rodjenja}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Adresa:</span>
                    </div>
                    <p type="text" class="form-control" name="adresa" style="height: auto">{{$klijent->adresa}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Opcina:</span>
                    </div>
                    <p type="text" class="form-control" name="broj_zdrastvenog_osiguranja" style="height: auto">{{$klijent->opcina}}</p>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Pol:</span>
                    </div>
                    <p type="text" class="form-control" name="pol" style="height: auto;">{{$klijent->pol}}</p>
                </div>
            </div>
            <div class="form-group col-6 border-right">
                @if ($karton == null)
                    <a class="btn myButton" href="/medicinski-karton/create/{{$klijent->id}}">Kreiraj medicinski karton</a>
                @else
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Krvna grupa:</span>
                        </div>
                        <p type="text" class="form-control" name="krvna_grupa">{{$karton->krvna_grupa}}</p>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Alergije:</span>
                        </div>
                        <p type="text" class="form-control" name="alergije">{{$karton->alergije}}</p>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Trenutne bolesti:</span>
                        </div>
                        <p type="text" class="form-control" name="trenutne_bolesti">{{$karton->trenutne_bolesti}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Pregledi</h3>
            </div>
        </div>
        <hr class="style-two">
        <div class="row pl-3">
            @if ($karton != null)
                <a class="btn myButton" href="/pregled/create/{{$karton->id}}">Novi pregled</a>
            @endif
        </div>
        <br>
        <div class="row">
            <div class="form-group col-4">
            @if ($pregledi != null)
                <!--hr class="style-two"-->
                    <ul class="p-0 m-0">
                        @foreach($pregledi as $pregled)
                            <li class="liRemoveBullet">
                                <a class="btn btn-default" target="_blank" href="/pregled/{{$pregled->id}}"><b>[{{$pregled->datum}}]</b> Cijena pregleda: {{$pregled->cijena}} KM  Plaćeno: {{$pregled->placeno}}
                                    @php
                                        $zubi = App\Zub::where('pregled_id', $pregled->id)->get();
                                        for ($i = 0; $i < sizeof($zubi); $i++) {
                                            if ($zubi[$i]->napomena != null || $zubi[$i]->pozicija != null || $zubi[$i]->lijekovi != null) echo ("\t\tZub: " . $zubi[$i]->oznaka . " Lijekovi:" . $zubi[$i]->lijekovi);
                                        }
                                    @endphp
                                </a>
                                <hr class="m-0 p-0"/>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection