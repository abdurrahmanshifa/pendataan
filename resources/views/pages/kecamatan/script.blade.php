<script>
     var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
<<<<<<< HEAD
            info :true,
=======
            info :false,
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
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