<table class="table table-responsive table-bordered">
    <thead class="table-info">
        <tr class="text-center">
            <th>No</th>
            <th>No Antrian</th>
            <th>Loket</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($antrian as $index => $a)
        <tr class="{{ $a->status == 1 ? 'table-danger' : '' }}" id="rowId{{ $a->id }}">
            <td width="50">{{ $loop->iteration }}</td>
            <td>{{ $a->no_antrian }}</td>
            <td>{{ $a->loket->nama_loket }}</td>
            <td>
                @if ($a->status == 'Selesai')
                <span class="badge bg-danger">
                    <i class="mdi mdi-check"></i> Selesai
                </span>
            @else
                {{ ucfirst($a->status) }}
            @endif
            </td>
            <td width="250" class="tombolAksi">
                <a href="" class="btn btn-sm btn-danger tombolPrevious" data-tipe="previous" data-id="{{ $a->id }}"><i class="mdi mdi-skip-previous"></i></a>
                <a href="" class="btn btn-sm btn-success tombolPanggil" data-id="{{ $a->id }}" data-nomor="{{ $a->nomor_antrian }}" data-loket="{{ $loket->nama_loket }}"><i class="mdi mdi-bell-ring"></i> Panggil</a>

                <a href="" class="btn btn-sm btn-danger tombolNext" data-tipe="next" data-id="{{ $a->id }}"><i class="mdi mdi-skip-next"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var loketId = '{{ $loket->id }}';  // Pastikan ini adalah ID yang benar
        function fetchAntrian() {
            $.ajax({
                url: `/api/antrian/${loketId}`, // Memastikan bahwa URL adalah dinamis dan benar
                type: 'GET',
                success: function(data) {
                    console.log(data);  // Debug data
                    var rows = '';
                    $.each(data.antrian, function(i, a) {
                        rows += '<tr>' +
                                    '<td>' + (i + 1) + '</td>' +
                                    '<td>' + a.no_antrian + '</td>' +
                                    '<td>' + a.loket.nama_loket + '</td>' +
                                    '<td>' + (a.status === 0 ? 'Belum' : 'Sudah') + '</td>' +
                                    '<td>Action buttons here</td>' +
                                '</tr>';
                    });
                    $('tbody').html(rows);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", status, error);  // Debug error
                }
            });
        }
        setInterval(fetchAntrian, 5000); // Setiap 5 detik
    });
    </script>

