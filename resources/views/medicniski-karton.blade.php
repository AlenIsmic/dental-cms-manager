@extends('layouts.app')
@section('content')
    <div class="container m-auto">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered table-sm sortable" id="dijagnoze">
                    <thead>
                    <tr>
                        <th onclick="sortTable(0)">Klijent</th>
                        <th onclick="sortTable(0)">Krvna grupa</th>
                        <th onclick="sortTable(0)">Alergije</th>
                        <th onclick="sortTable(0)">Trenutne bolesti</th>
                        <th colspan="3">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kartoni as $karton)
                        <tr>
                            <td>{{$karton['klijent_id']}}</td>
                            <td>{{$karton['krvna_grupa']}}</td>
                            <td>{{$karton['alergije']}}</td>
                            <td>{{$karton['trenutne_bolesti']}}</td>
                            <td><a href="{{action('MedicinskiKartonController@show', $karton['id'])}}" class="btn btn-info">Pregledaj</a></td>
                            <td><a href="{{action('MedicinskiKartonController@edit', $karton['id'])}}" class="btn btn-warning">Izmjeni</a></td>
                            <td>
                                <form action="{{action('MedicinskiKartonController@destroy', $karton['id'])}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Obrisi</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $kartoni->links() }}
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("dijagnoze");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount ++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
@endsection