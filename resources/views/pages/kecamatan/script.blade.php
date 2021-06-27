<script>
     var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('kecamatan') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"nama_kec"},
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