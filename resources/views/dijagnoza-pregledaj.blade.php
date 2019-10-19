@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Izmjeni podatke o dijagnozi</h2><br  />
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="naziv">Naziv:</label>
                <p type="text" class="form-control" name="naziv" style="height: auto">{{$dijagnoza->naziv}}</p>
            </div>
        </div>
    </div>
@endsection