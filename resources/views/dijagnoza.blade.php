@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="modal fade" id="modalDijagnoza" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Nova dijagnoza</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Odustani">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{url('dijagnoza')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fa fa-user prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="form3">Naziv:</label>
                                <input type="text" class="form-control" name="naziv">
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn myButton" type="submit">Unesi <i class="fa fa-paper-plane-o ml-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDijagnozaEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Izmjena dijagnoze</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Odustani">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="dijagnozaEditForm">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fa fa-user prefix grey-text"></i>
                                <label for="naziv">Naziv:</label>
                                <input type="text" class="form-control" name="naziv" id="nazivEdit" value="">
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn myButton" type="submit">Azuriraj <i class="fa fa-paper-plane-o ml-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <br>
                <a href="" class="btn myButton" data-toggle="modal" data-target="#modalDijagnoza">Nova dijagnoza</a>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Pregled postojećih dijagnoza</h3>
                <hr class="style-two">
                <table id="dijagnoze" class="table table-striped table-bordered responsive no-wrap">
                    <thead>
                    <tr>
                        <th onclick="sortTable(0)" class="width60">Naziv</th>
                        <th class="no-sort remove_right_border" style="max-width: 90px;">Akcija</th>
                        <th class="no-sort remove_right_border remove_left_border" style="max-width: 90px;"></th>
                        <th class="no-sort remove_right_border remove_left_border" style="max-width: 90px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dijagnoze as $dijagnoza)
                        <tr>
                            <td class="width60">{{$dijagnoza['naziv']}}</td>
                            <td style="width: 90px; text-align: center"><a href="{{action('DijagnozaController@show', $dijagnoza['id'])}}" class="action"><img src="/images/search.png">Pregled</a></td>
                            <td style="width: 90px; text-align: center"><a onclick="editDiagnose({{$dijagnoza->id}})" class="action" data-toggle="modal" data-target="#modalDijagnozaEdit"><img src="/images/edit.png">Izmjena</a></td>
                            <td class="block text-center" style="width: 90px;">
                                <form action="{{action('DijagnozaController@destroy', $dijagnoza['id'])}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="action" type="submit" onclick="return confirm('Da li ste sigurni da želite da izbrišete dijagnozu?');"><img src="/images/delete.png">Obriši</button>
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
            $('#dijagnoze').DataTable( {
                "language": {
                    "decimal":        "",
                    "emptyTable":     "Nema podataka",
                    "info":           "Prikaz _START_ do _END_ od _TOTAL_ dijagnoza",
                    "infoEmpty":      "Prikaz 0 do 0 od 0 klijenata",
                    "infoFiltered":   "(filterisano od _MAX_ ukupno dijagnoza)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Prikazi _MENU_ dijagnoza",
                    "loadingRecords": "Ucitavanje...",
                    "processing":     "Procesiranje...",
                    "search":         "Pretraga:",
                    "zeroRecords":    "Nije pronadjeno",
                    "paginate": {
                        "first":      "Početna",
                        "last":       "Zadnja",
                        "next":       "Naredna",
                        "previous":   "Prethodna"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ],
                "info": false
            } );
        } );
        function editDiagnose(id) {
            var hostname = window.location.hostname;
            var port = window.location.port;
            var protocol = window.location.protocol;
            document.getElementById('dijagnozaEditForm').action = protocol + "//" + hostname + ":" + port + "/dijagnoza/" + id + "/edit";
        }

    </script>
@endsection