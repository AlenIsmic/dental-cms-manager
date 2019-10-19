@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pregledaj medicinski karton</h2><br/>
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="klijent_id">Klijent:</label>
                <input type="text" class="form-control" name="klijent_id" value="{{$karton->klijent_id}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="krvna_grupa">Krvna grupa:</label>
                <input type="text" class="form-control" name="krvna_grupa" value="{{$karton->krvna_grupa}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="alergije">Alergije:</label>
                <input type="text" class="form-control" name="alergije" value="{{$karton->alergije}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="trenutne_bolesti">Trenutne bolesti:</label>
                <input type="text" class="form-control" name="trenutne_bolesti" value="{{$karton->trenutne_bolesti}}" disabled>
            </div>
        </div>
    </div>
@endsection