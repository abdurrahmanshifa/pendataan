<script>
     var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('kelurahan') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"kecamatan"},
                {"data":"nama_kel"},
            ],
            columnDefs: [
            {
                targets: [0],
                className: 'text-center'
            },
          ]
    });

    $(".refresh").click(function(){
          table.ajax.reload(null,true);
    });
</script>