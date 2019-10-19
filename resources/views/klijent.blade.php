@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <br>
                <a class="btn myButton" href="/klijent/create">Novi klijent</a>
                <br>
            </div>
        </div>
        <div class="row flex-grow-1">
            <div class="col-12 d-flex flex-grow-1 flex-column">
                <h3>Pregled postojećih klijenata</h3>
                <hr class="style-two">
                <table id="klijenti" class="table table-striped table-bordered no-wrap">
                    <thead>
                    <tr>
                        <th>Prezime</th>
                        <th>Ime</th>
                        <th>adresa</th>
                        <th>opcina</th>
                        <th class="no-sort remove_right_border" style="width: auto">Akcija</th>
                        <th class="no-sort remove_right_border remove_left_border" style="width: auto"></th>
                        <th class="no-sort remove_right_border remove_left_border" style="width: auto"></th>
                    </tr>
                    </thead>
                    <tbody >
                    @foreach($klijenti as $klijent)
                        <tr>
                            <td>{{$klijent['prezime']}}</td>
                            <td>{{$klijent['ime']}}</td>
                            <td>{{$klijent['adresa']}}</td>
                            <td>{{$klijent['opcina']}}</td>
                            <td class="block text-center" style="min-width: 90px;">
                                <a href="{{action('KlijentController@show', $klijent['id'])}}" class="action"><img src="/images/search.png">Pregled</a>
                            </td>
                            <td class="block text-center" style="min-width: 90px;">
                                <a href="{{action('KlijentController@edit', $klijent['id'])}}" class="action"><img src="/images/edit.png">Izmjena</a></td>
                            <td class="block text-center" style="min-width: 90px;">
                                <form action="{{action('KlijentController@destroy', $klijent['id'])}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="action" type="submit" onclick="return confirm('Da li ste sigurni da želite da izbrišete klijenta?');"><img src="/images/delete.png">Obriši</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        var table = $(document).ready(function() {
            $('#klijenti').DataTable( {
                "language": {
                    "decimal":        "",
                    "emptyTable":     "Nema podataka",
                    "info":           "Prikaz _START_ do _END_ od _TOTAL_ klijenata",
                    "infoEmpty":      "Prikaz 0 do 0 od 0 klijenata",
                    "infoFiltered":   "(filterisano od _MAX_ ukupno klijenata)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Prikaz _MENU_ klijenata",
                    "loadingRecords": "Učitavanje...",
                    "processing":     "Procesiranje...",
                    "search":         "Pretraga:",
                    "zeroRecords":    "Nije pronađeno",
                    "paginate": {
                        "first":      "Početna",
                        "last":       "Zadnja",
                        "next":       "Naredna",
                        "previous":   "Prethodna"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                },
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ],
                "info": false
            } );
        } );
    </script>
@endsection