@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Izmjena podatka o klijentu</h3>
        <hr class="style-two">
        <form method="post" action="{{url('klijent')}}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (\Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif

            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Ime:</span>
                </div>
                <input type="text" class="form-control" name="ime" autocomplete="off" value="{{$klijent->ime}}">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Prezime:</span>
                </div>
                <input type="text" class="form-control" name="prezime" autocomplete="off" value="{{$klijent->prezime}}">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Broj telefona:</span>
                </div>
                <input type="text" class="form-control" name="broj_telefona" autocomplete="off" value="{{$klijent->broj_telefona}}">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">E-mail:</span>
                </div>
                <input type="text" class="form-control" name="email" autocomplete="off" value="{{$klijent->email}}">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Datum rođenja:</span>
                </div>
                <input type="text" class="form-control" id="datum_rodjenja" name="datum_rodjenja" autocomplete="off" value="{{$klijent->datum_rodjenja}}">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Adresa:</span>
                </div>
                <input type="text" class="form-control" name="adresa" autocomplete="off" value="{{$klijent->adresa}}">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Općina:</span>
                </div>
                <input type="text" class="form-control" name="opcina" autocomplete="off" value="{{$klijent->opcina}}">
            </div>

            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text width_200px" id="basic-addon3">Pol:</span>
                </div>
                <div class="btn-group btn-group-toggle btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-outline-secondary">
                        <input type="radio" name="pol"  value="M" autocomplete="off"> M
                    </label>
                    <label class="btn btn-outline-secondary">
                        <input type="radio" name="pol" value="Z" autocomplete="off"> Ž
                    </label>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="form-group pr-3">
                    <button type="submit" class="btn myButton">Spasi</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $( function() {
            $( "#datum_rodjenja" ).datepicker({
                dateFormat : 'yy/mm/dd',
                changeMonth: true,
                changeYear: true
            });
        } );
    </script>
@endsection