@php 
    if(isset($data->pembangunan->id))
    {
        $id_pembangunan = $data->pembangunan->id;
    }else{
        $id_pembangunan = 0;
    }
@endphp
@include('pages.pembangunan.script');
@include('pages.rehabilitasi.script');
@include('pages.spesifikasi.script');
@include('pages.kondisi.script');

<script>
    $(document).on("click", ".zoom", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src',myBookId);
          $(".modal-body #img-title").html(title);
     });

    $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/jenis-ruangan") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
    });
</script>