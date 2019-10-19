@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Izmjeni podatke o dijagnozi</h2><br  />
        <form method="post" action="{{action('DijagnozaController@update', $id)}}">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="naziv">Naziv:</label>
                    <input type="text" class="form-control" name="naziv" value="{{$dijagnoza->naziv}}">
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