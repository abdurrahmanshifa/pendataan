<script>
     var table = $('#table-jenis-ruangan').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('pembangunan',['id' => $data->pembangunan->id]) }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"ruangan"},
            {"data":"jml_ruangan"},
            {"data":"luas_ruangan"},
            {"data":"media"},
        ],
        columnDefs: [
            {
                targets: [0,-1,2,3],
                className: 'text-center'
            },
        ]
    });

    $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/jenis-ruangan") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
     });
</script>