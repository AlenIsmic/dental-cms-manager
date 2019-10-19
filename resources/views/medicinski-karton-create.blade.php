@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Unos medicinskog kartona</h3>
                <hr class="style-two">
                <form method="post" action="{{url('medicinski-karton')}}" enctype="multipart/form-data">
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

                    <div class="input-group mb-1" hidden>
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Klijent:</span>
                        </div>
                        <input type="text" class="form-control" name="klijent_id" value="{{$id}}">
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Krvna grupa:</span>
                        </div>
                        <div class="btn-group btn-group-toggle btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "0-") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa" value="0-" autocomplete="off"> 0-
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "0+") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="0+" autocomplete="off"> 0+
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "A-") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="A-" autocomplete="off"> A-
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "A+") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="A+" autocomplete="off"> A+
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "B-") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="B-" autocomplete="off"> B-
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "B+") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="B+" autocomplete="off"> B+
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "AB-") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="AB-" autocomplete="off"> AB-
                            </label>
                            <label class="btn btn-outline-secondary @if (old('krvna_grupa') == "AB+") active focus @endif">
                                <input type="radio" class="" name="krvna_grupa"  value="AB+" autocomplete="off"> AB+
                            </label>
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Alergije:</span>
                        </div>
                        <input type="text" class="form-control" name="alergije" autocomplete="off">
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_200px" id="basic-addon3">Trenutne bolesti:</span>
                        </div>
                        <input type="text" class="form-control" name="trenutne_bolesti" autocomplete="off">
                    </div>

                    <div class="row justify-content-end">
                        <div class="form-group pr-3">
                            <button type="submit" class="btn myButton">Spasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

    </script>
@endsection