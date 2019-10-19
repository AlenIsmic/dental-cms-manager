<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('/css/paper.css')}}">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');
        @page { size: A4 }
        body {
            font-family: Roboto !important;
        }
    </style>

    <title>Dental</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!--title>{{ config('app.name', 'Laravel') }}</title-->
</head>
<body>
<page size="A4">
    <div style="height: 265mm">
        <table style="width: 100%">
            <tr>
                <td>
                    <img src="/images/logo.png"/>
                    <br/>
                    <small class="racun">Josipa Štadlera br.8, Sarajevo, Bosna i Hercegovina</small>
                    <small class="racun">+387 33 213 655</small>
                </td>
                <td>
                    <p style="margin-bottom: 0px; margin-top: 0px">MINISTARTSVO ZDRAVLJA</p>
                    <p style="margin-bottom: 0px; margin-top: 0px">KANTON SARAJEVO</p>
                    <p style="margin-bottom: 0px; margin-top: 0px">RJEŠENJE BR: 10-50-91/98</p>
                </td>
            </tr>
        </table>

        <br>
        <h1 class="text-center" style="font-size: 1cm;">Nalaz <input type="text" style="padding-left: 5px; font-size: 1cm; font-weight: bold; width: 30%; border: 0px !important;"></h1>
        <br>

        <table style="width: 100%">
            <tr>
                <td width="80%">
                    <h3>{{$klijent->prezime}}&nbsp;{{$klijent->ime}}</h3>
                </td>
                <td>
                    <p class="p-0 m-0">Datum: <b>@if ($pregled->datum != null) {{$pregled->datum}}</b>@endif</p>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <h5 class="ml-2 pl-2">Stavke pregleda: </h5>
        <table style="width: 100%;">
            @for($i = 0; $i<32; $i++)
                @if($zubi[$i]->pozicija != "")
                    <tr>
                        <td>
                            <div style="border-bottom: 1px solid black;"><b>ZUB: {{$zubi[$i]->oznaka}}</b></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-bottom: 0.3cm;">
                                <p><small>POZICIJA: </small>{{$zubi[$i]->pozicija}}</p>
                                <small>DIJAGNOZA: </small>
                                @php
                                    foreach ($zubidijagnoze[$i] as $zd) {
                                    if ($zd->zub_id == $zubi[$i]->id) {
                                    for ($k = 0; $k < sizeof($dijagnoze); $k++) {
                                    if ($dijagnoze[$k]->id == $zd->dijagnoza_id) {
                                    echo("".$dijagnoze[$k]->naziv."; ");
                                    }
                                    }
                                    }
                                    }
                                @endphp
                                <p><small>LIJEKOVI: </small>{{$zubi[$i]->lijekovi}}</p>
                                <p><small>NAPOMENA: </small>{{$zubi[$i]->napomena}}</p>
                            </div>
                        </td>
                    </tr>
                @endif
            @endfor
        </table>
        <br>
        <hr>
        @if ($pregled->napomena != null)
            <table>
                <tr>
                    <td>
                        <div>
                            <div>
                                <p style="font-size: medium">NAPOMENA: {{$pregled->napomena}}</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        @endif
        <table style="width: 100%">
            <tr>
                <td style="width: 80%">
                    <div>
                        <p>Cijena slovima:&nbsp;<input type="text" style="border: 0px; font-size: medium"></p>
                        <p>Način plaćanja:&nbsp;<input type="text" value="Gotovina" style="border: 0px; font-size: medium"></p>
                    </div>
                </td>
                <td>
                    <p>Cijena: <b>@if ($pregled->cijena != null) {{$pregled->cijena}} KM</b> @endif</p>
                </td>
            </tr>
        </table>
        <br>
    </div>

    <!-- FOOTER -->
    <div style="bottom: 0; height: auto; margin-bottom: 0">
        <table style="width: 100%;">
            <tr>
                <td>
                </td>
                <td>
                    <div style="float-right; width: 100%">
                        <p class="text-right"><b>Dr. Merima Hrapović Mamić</b></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 13cm">
                    <p style="margin-bottom: 0; margin-top: 0">Adresa: Josipa Štadlera br.8, Sarajevo, BiH</p>
                    <p style="margin-bottom: 0; margin-top: 0">Telefon: +387 33 213 655</p>
                    <p style="margin-bottom: 0; margin-top: 0">Web: h-mm.ba</p>
                    <p style="margin-bottom: 0; margin-top: 0">E-mail: merima.hrapovic@gmail.com</p>
                </td>
                <td style="">
                    <p style="margin-bottom: 0; margin-top: 0">UniCredit banka: 3389002205529653</p>
                    <p style="margin-bottom: 0; margin-top: 0">Identifikacijski broj: 4300498290009</p>
                    <p style="margin-bottom: 0; margin-top: 0">Porezni broj: 01845013</p>
                </td>
            </tr>
        </table>
    </div>

</page>
</body>
</html>