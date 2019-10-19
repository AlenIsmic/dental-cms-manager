@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Izmjeni podatke o medicinskom kartonu</h2><br  />
        <form method="post" action="{{action('MedicinskiKartonController@update', $id)}}">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="klijent_id">Klijent:</label>
                    <p>{{$karton->klijent_id}}</p>
                    <input type="text" class="form-control" name="klijent_id" value="{{$karton->klijent_id}}" hidden>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="krvna_grupa">Krvna grupa:</label>
                    <input type="text" class="form-control" name="krvna_grupa" value="{{$karton->krvna_grupa}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="alergije">Alergije:</label>
                    <input type="text" class="form-control" name="alergije" value="{{$karton->alergije}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="trenutne_bolesti">Trenutne bolesti:</label>
                    <input type="text" class="form-control" name="trenutne_bolesti" value="{{$karton->trenutne_bolesti}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success w-100">Azuriraj</button>
                </div>
            </div>
        </form>
    </div>
@endsection