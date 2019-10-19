@extends('layouts.app')

@section('content')
    <div class="container bg-transparent">
        <div class="row justify-content-md-center pt-5">
            <div class="col mx-3 card2 pt-3 pb-3">
                <a href="/klijent"><img src="/images/client.png" class="float-left"><h3>KLIJENTI</h3></a>
            </div>
            <div class="col mx-3 card2 pt-3 pb-3">
                <a href="/dijagnoza"><img src="/images/medical-record.png" class="float-left"><h3>DIJAGNOZE</h3></a>
            </div>
        </div>
        <div class="row justify-content-md-center pt-5">
            <div class="col-6 mx-3 card2 pt-3 pb-3">
                <a href="/recept" target="_blank"><img src="/images/invoice.png" class="float-left"><h3>RECEPTI</h3></a>
            </div>
        </div>
    </div>
@endsection
