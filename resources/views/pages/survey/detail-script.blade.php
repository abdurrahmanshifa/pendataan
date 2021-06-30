<script>
     var table = $('#table-jenis-ruangan').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('pembangunan') }}",
            data : {
               id   : '{{ $data->id }}',
          },
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"ruangan"},
            {"data":"jumlah_ruangan"},
            {"data":"luas"},
            {"data":"media"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
                className: 'text-center'
            },
        ]
    });
</script>