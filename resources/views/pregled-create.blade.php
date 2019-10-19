@extends('layouts.app')

@section('content')
    <form method="post" action="{{url('pregled')}}" enctype="multipart/form-data">
        <div class="container pb-3">

            <div class="row">
                <div class="col-12">
                    <h3>Unos novog pregleda</h3>
                    <hr class="style-two">
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
                </div>
            </div>

            <div class="row justify-content-end pr-3">
                <div class="form-group">
                    <button type="submit" class="btn myButton">Spasi</button>
                </div>
            </div>

            <div class="row pb-3">
                <!--for id fetch purpose-->
                <div hidden>
                    <div>
                        <label for="medicinski_karton_id">Medicniski karton:</label>
                        <input type="text" class="form-control" name="medicinski_karton_id" value="{{$id}}">
                    </div>
                </div>
                <div hidden>
                    <div>
                        <label for="klijent_id">Klijent ID:</label>
                        <input type="text" class="form-control" name="klijent_id" value="{{$klijent_id}}">
                    </div>
                </div>

                <div class="input-group mb-1 px-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon3">Datum:</span>
                    </div>
                    <input type="text" class="form-control" id="datum_pregleda" name="datum_pregleda" autocomplete="off">
                </div>

                <div class="input-group mb-1 px-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text label_pregled width_200px">Cijena:</span>
                    </div>
                    <input type="text" class="form-control" id="cijena" name="cijena" autocomplete="off" value="{{old('cijena')}}">
                </div>

                <div class="input-group mb-1 px-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text width_200px" id="basic-addon4">Plaćeno:</span>
                    </div>
                    <div class="btn-group btn-group-toggle btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-outline-secondary">
                            <input type="radio" class="" name="placeno" value="DA" autocomplete="off">DA
                        </label>
                        <label class="btn btn-outline-secondary">
                            <input type="radio" class="" name="placeno"  value="NE" autocomplete="off">NE
                        </label>
                    </div>
                </div>

                <div class="input-group mb-1  px-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text label_pregled width_200px">Napomena:</span>
                    </div>
                    <textarea class="form-control" id="napomena_pregled" name="napomena_pregled" autocomplete="off">{{old('napomena_pregled')}}</textarea>
                </div>

            </div>

            <div class="row teeth_border py-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 d-inline-flex flex-row">
                            @for ($i = 18; $i >= 11; $i--)
                                <div class="flex-fill" id="zub_div{{$i}}">
                                    <img src="/images/zubi/{{$i}}.png" id="zub{{$i}}" onclick="dijag({{$i}})" style="width: 30px; height: 70px;">
                                </div>
                            @endfor
                        </div>
                        <div class="col-6 d-inline-flex flex-row">
                            @for ($i = 21; $i <= 28; $i++)
                                <div class="flex-fill" id="zub_div{{$i}}">
                                    <img src="/images/zubi/{{$i}}.png" id="zub{{$i}}" onclick="dijag({{$i}})" style="width: 30px; height: 70px;">
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 d-inline-flex flex-row">
                            @for ($i = 48; $i >= 41; $i--)
                                <div class="flex-fill" id="zub_div{{$i}}">
                                    <img src="/images/zubi/{{$i}}.png" id="zub{{$i}}" onclick="dijag({{$i}})" style="width: 30px; height: 70px;">
                                </div>
                            @endfor
                        </div>
                        <div class="col-6  d-inline-flex flex-row">
                            @for ($i = 31; $i <= 38; $i++)
                                <div class="flex-fill" id="zub_div{{$i}}">
                                    <img src="/images/zubi/{{$i}}.png" id="zub{{$i}}" onclick="dijag({{$i}})" style="width: 30px; height: 70px;">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-3 pt-3" id="zub_dijagnoza_dodavanje" style="height: 0px;">
                <div class="form-group col-12" id="dijagnoze" style="visibility: hidden">
                    <h5 id="zub_id"></h5>
                    <h5 id="zub_id2" hidden></h5>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_100px" id="basic-addon4">Pozicija:</span>
                        </div>
                        <div class="btn-group btn-group-toggle btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" class="" name="M" value="M" autocomplete="off"> M
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" class="" name="O"  value="O" autocomplete="off"> O
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" class="" name="D"  value="D" autocomplete="off"> D
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" class="" name="I"  value="I" autocomplete="off"> I
                            </label>
                        </div>
                    </div>
                    <div class="btn-group btn-group-toggle btn-group-justified mb-2" data-toggle="buttons">
                        @foreach ($dijagnoze as $dijagnoza)
                            <label class="btn btn-outline-secondary">
                                <input type="checkbox" class="custom-checkbox" name="{{$dijagnoza->naziv}}">
                                <label for="{{$dijagnoza->naziv}}">{{$dijagnoza->naziv}}</label>
                            </label>
                        @endforeach
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_100px" for="lijekovi">Lijekovi:</span>
                        </div>
                        <input type="text" class="form-control" name="lijekovi" id="lijekovi" autocomplete="off">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text width_100px" for="napomena">Napomena:</span>
                        </div>
                        <input type="text" class="form-control" name="napomena" id="napomena" autocomplete="off">
                    </div>
                    <div class="row justify-content-end px-3">
                        <button type="button" class="myButton" onclick="dodajNaListu()">Dodaj</button>
                    </div>
                </div>
            </div>
            <div id="zub_dijagnoze" class="container pt-3">
                <div class="row">
                    <div class="col-3">
                        @for ($i = 11; $i <= 18; $i++)
                            <div class=" zub_info_background">
                                <label for="zub_pozicije_{{$i}}" class="zub_background">Zub {{$i}} &nbsp</label>
                                <input id="zub_pozicije_{{$i}}" name="zub_pozicije_{{$i}}" value="{{old('zub_pozicije_'.$i)}}" hidden>
                                <ul id="zub_pozicije_li_{{$i}}"></ul>

                                <input id="zub_dijagnoze_{{$i}}" name="zub_dijagnoze_{{$i}}" value="{{old('zub_dijagnoze_'.$i)}}" hidden>
                                <ul id="zub_dijagnoze_li_{{$i}}"></ul>

                                <input id="lijekovi_zub_{{$i}}" name="lijekovi_zub_{{$i}}" value="{{old('lijekovi_zub_'.$i)}}" hidden>
                                <ul id="lijekovi_zub_li_{{$i}}"></ul>

                                <input id="napomena_zub_{{$i}}" name="napomena_zub_{{$i}}" value="{{old('napomena_zub_'.$i)}}" hidden>
                                <ul id="napomena_zub_li_{{$i}}"></ul>
                            </div>
                        @endfor
                    </div>
                    <div class="col-3">
                        @for ($i = 21; $i <= 28; $i++)
                            <div class=" zub_info_background">
                                <label for="zub_pozicije_{{$i}}" class="zub_background">Zub {{$i}} &nbsp</label>
                                <input id="zub_pozicije_{{$i}}" name="zub_pozicije_{{$i}}" value="{{old('zub_pozicije_'.$i)}}" hidden>
                                <ul id="zub_pozicije_li_{{$i}}"></ul>

                                <input id="zub_dijagnoze_{{$i}}" name="zub_dijagnoze_{{$i}}" value="{{old('zub_dijagnoze_'.$i)}}" hidden>
                                <ul id="zub_dijagnoze_li_{{$i}}"></ul>

                                <input id="lijekovi_zub_{{$i}}" name="lijekovi_zub_{{$i}}" value="{{old('lijekovi_zub_'.$i)}}" hidden>
                                <ul id="lijekovi_zub_li_{{$i}}"></ul>

                                <input id="napomena_zub_{{$i}}" name="napomena_zub_{{$i}}" value="{{old('napomena_zub_'.$i)}}" hidden>
                                <ul id="napomena_zub_li_{{$i}}"></ul>
                            </div>
                        @endfor
                    </div>
                    <div class="col-3">
                        @for ($i = 31; $i <= 38; $i++)
                            <div class=" zub_info_background">
                                <label for="zub_pozicije_{{$i}}" class="zub_background">Zub {{$i}} &nbsp</label>
                                <input id="zub_pozicije_{{$i}}" name="zub_pozicije_{{$i}}" value="{{old('zub_pozicije_'.$i)}}" hidden>
                                <ul id="zub_pozicije_li_{{$i}}"></ul>

                                <input id="zub_dijagnoze_{{$i}}" name="zub_dijagnoze_{{$i}}" value="{{old('zub_dijagnoze_'.$i)}}" hidden>
                                <ul id="zub_dijagnoze_li_{{$i}}"></ul>

                                <input id="lijekovi_zub_{{$i}}" name="lijekovi_zub_{{$i}}" value="{{old('lijekovi_zub_'.$i)}}" hidden>
                                <ul id="lijekovi_zub_li_{{$i}}"></ul>

                                <input id="napomena_zub_{{$i}}" name="napomena_zub_{{$i}}" value="{{old('napomena_zub_'.$i)}}" hidden>
                                <ul id="napomena_zub_li_{{$i}}"></ul>
                            </div>
                        @endfor
                    </div>
                    <div class="col-3">
                        @for ($i = 41; $i <= 48; $i++)
                            <div class=" zub_info_background">
                                <label for="zub_pozicije_{{$i}}" class="zub_background">Zub {{$i}} &nbsp</label>
                                <input id="zub_pozicije_{{$i}}" name="zub_pozicije_{{$i}}" value="{{old('zub_pozicije_'.$i)}}" hidden>
                                <ul id="zub_pozicije_li_{{$i}}"></ul>

                                <input id="zub_dijagnoze_{{$i}}" name="zub_dijagnoze_{{$i}}" value="{{old('zub_dijagnoze_'.$i)}}" hidden>
                                <ul id="zub_dijagnoze_li_{{$i}}"></ul>

                                <input id="lijekovi_zub_{{$i}}" name="lijekovi_zub_{{$i}}" value="{{old('lijekovi_zub_'.$i)}}" hidden>
                                <ul id="lijekovi_zub_li_{{$i}}"></ul>

                                <input id="napomena_zub_{{$i}}" name="napomena_zub_{{$i}}" value="{{old('napomena_zub_'.$i)}}" hidden>
                                <ul id="napomena_zub_li_{{$i}}"></ul>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script type="text/javascript">
        function dijag(zub){
            document.getElementById('zub_id').innerHTML = "Zub " + zub;
            document.getElementById('zub_id2').innerHTML = zub;
            document.getElementById('zub_dijagnoza_dodavanje').style.height = "auto";
            document.getElementById('dijagnoze').style.visibility = "visible";
        }

        function dodajNaListu() {
            var zub = document.getElementById("zub_id2").innerText;
            const dijagnoze = {!! $dijagnoze !!};

            document.getElementById("zub_pozicije_li_"+zub).innerHTML = "<small>POZICIJA</small> <hr class=\"mpNull\"/>";
            document.getElementById("zub_pozicije_"+zub).value = "";
            var pozicije = ['M', 'O', 'D', 'I'];
            for (let i = 0; i<pozicije.length; i++) {
                var chi = document.getElementsByName(pozicije[i])[0].checked;
                if (chi == true) {
                    document.getElementById("zub_pozicije_li_"+zub).innerHTML += "<li class=\"liPregledZuba\">" + pozicije[i] + "</li>";
                    document.getElementById("zub_pozicije_"+zub).value += pozicije[i] + ";";
                }
            }

            document.getElementById("zub_dijagnoze_li_"+zub).innerHTML = "<small>DIJAGNOZA</small> <hr class=\"mpNull\"/>";
            document.getElementById("zub_dijagnoze_"+zub).value = "";
            for (let i = 0; i<dijagnoze.length; i++) {
                var chi = document.getElementsByName(dijagnoze[i].naziv)[0].checked;
                if (chi == true) {
                    document.getElementById("zub_dijagnoze_li_"+zub).innerHTML += "<li class=\"liPregledZuba\">" + document.getElementsByName(dijagnoze[i].naziv)[0].name + "</li>";
                    document.getElementById("zub_dijagnoze_"+zub).value += document.getElementsByName(dijagnoze[i].naziv)[0].name + ";";
                }
            }

            document.getElementById("lijekovi_zub_li_"+zub).innerHTML = "<small>LIJEKOVI</small> <hr class=\"mpNull\"/>";
            document.getElementById("lijekovi_zub_"+zub).value = "";
            if (document.getElementById('lijekovi_zub_'+zub).value != null) {
                document.getElementById('lijekovi_zub_'+zub).value = document.getElementById('lijekovi').value;
                document.getElementById('lijekovi_zub_li_'+zub).innerHTML += "<li class=\"liPregledZuba\">" + document.getElementById('lijekovi').value + "</li>";
            }

            document.getElementById("napomena_zub_li_"+zub).innerHTML = "<small>NAPOMENA</small> <hr class=\"mpNull\"/>";
            document.getElementById("napomena_zub_"+zub).value = "";
            if (document.getElementById('napomena_zub_'+zub).value != null){
                document.getElementById('napomena_zub_'+zub).value += document.getElementById('napomena').value;
                document.getElementById('napomena_zub_li_'+zub).innerHTML += "<li class=\"liPregledZuba\">"  + document.getElementById('napomena').value + "</li>";
            }
        }

        $( function() {
            $( "#datum_pregleda" ).datepicker();
            $( "#datum_pregleda" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
        } );
    </script>
@endsection