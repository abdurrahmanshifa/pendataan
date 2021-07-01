<script>
     var table = $('#table-jenis-ruangan').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
               url: "{{ route('pembangunan',['id' => $data->id]) }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"ruangan"},
            {"data":"jml_ruangan"},
            {"data":"luas_ruangan"},
            {"data":"media"},
            {"data":"aksi"},
        ],
        columnDefs: [
            {
                targets: [0,-1,2,3],
                className: 'text-center'
            },
        ]
    });

     $("[name=form_data]").on('submit', function(e) {
          e.preventDefault();

          $('.help-block').empty();
          $("div").removeClass("has-error");
          $('#btn').text('sedang menyimpan...');
          $('#btn').attr('disabled', true);

          var form = $('[name="form_data"]')[0];
          var data = new FormData(form);
          if(save_method == 'add'){
               var url = '{{route("pembangunan-ruangan.simpan")}}';
          }else{
               var url = '{{route("pembangunan-ruangan.ubah")}}';
          }
          $.ajax({
               url: url,
               type: 'post',
               data: data,
               processData: false,
               contentType: false,
               cache: false,
               success: function(obj) {
                    if(obj.status)
                    {
                         if (obj.success !== true) {
                              Swal.fire({
                                   text: obj.message,
                                   title: "Perhatian!",
                                   icon: "error",
                                   button: true,
                                   timer: 1000
                              });
                         }
                         else {
                              table_data();
                              $('#modal_form').modal('hide');
                              Swal.fire({
                                   text: obj.message,
                                   title: "Perhatian!",
                                   icon: "success",
                                   button: true,
                                   timer: 1000
                              });
                              
                         }
                         $('#btn').text('Simpan');
                         $('#btn').attr('disabled', false);
                    }else{
                         for (var i = 0; i < obj.input_error.length; i++) 
                         {
                              $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                              $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                         }
                         $('#btn').text('Simpan');
                         $('#btn').attr('disabled', false);
                    }
               }
          });
     });

     $("[name=form_pembangunan]").on('submit', function(e) {
          e.preventDefault();

          $('.help-block').empty();
          $("div").removeClass("has-error");
          $('#btn-input').text('sedang menyimpan...');
          $('#btn-input').attr('disabled', true);

          var form = $('[name="form_pembangunan"]')[0];
          var data = new FormData(form);
          var url = '{{route("pembangunan.simpan")}}';
          $.ajax({
               url: url,
               type: 'post',
               data: data,
               processData: false,
               contentType: false,
               cache: false,
               success: function(obj) {
                    if(obj.status)
                    {
                         if (obj.success !== true) {
                              Swal.fire({
                                   text: obj.message,
                                   title: "Perhatian!",
                                   icon: "error",
                                   button: true,
                                   timer: 1000
                              });
                              $('#btn-input').text('Simpan');
                              $('#btn-input').attr('disabled', false);
                         }
                         else {
                              Swal.fire({
                                   text: obj.message,
                                   title: "Perhatian!",
                                   icon: "success",
                                   button: true,
                                   }).then((result) => {
                                        if (result.value) {
                                             location.replace('{{ url("survey/detail/".$data->id_survey) }}');
                                        }
                                });
                              
                         }
                         $('#btn-input').text('Simpan');
                         $('#btn-input').attr('disabled', false);
                    }else{
                         for (var i = 0; i < obj.input_error.length; i++) 
                         {
                              $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                              $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                         }
                         $('#btn-input').text('Simpan');
                         $('#btn-input').attr('disabled', false);
                    }
               }
          });
     });

     $(".tambah").click(function(){
          save_method = 'add';
          $('#form_data')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();
          $('#modal_form').modal('show');
          $('[name="id_kec"]').val('').change();
          $('.modal-title').text('Tambah Data');
     });

     function ubah(id)
     {
          save_method = 'edit';
          $('#form_data')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();

          $.ajax({
               url : "{{url('survey/pembangunan/ruangan-data')}}"+"/"+id,
               type: "GET",
               dataType: "JSON",
               success: function(data){
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Ubah Data');
                    $('[name="id"]').val(data.id);
                    $('[name="id_jenis_ruangan"]').val(data.id_jenis_ruangan).change();
                    $('[name="jml_ruangan"]').val(data.jml_ruangan);
                    $('[name="luas"]').val(data.luas);
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

    function hapus(id)
    {
        Swal.fire({
            text: "Apakah Data ini Ingin Di Hapus?",
            title: "Perhatian",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#2196F3",
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url : "{{url('survey/pembangunan/ruangan-hapus/')}}"+"/"+id,
                        type: "POST",
                        data : {
                            '_method'   : 'delete',
                            '_token'    : '{{ csrf_token() }}',
                        },
                        dataType: "JSON",
                        success: function (obj) {
                            if (obj.success !== true) {
                                Swal.fire({
                                    text: obj.message,
                                    title: "",
                                    icon: "error",
                                    button: true,
                                    timer: 1000
                                });
                            }
                            else {
                                table_data();
                                Swal.fire({
                                    text: obj.message,
                                    title: "",
                                    icon: "success",
                                    button: true,
                                    timer: 1000
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error get data from ajax');
                        }
                });
            }else{
                table_data(); 
            }

        });
    }

     $(".refresh").click(function(){
          table_data();
     });

     function table_data(){
          table.ajax.reload(null,true);
     }

     $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/jenis-ruangan") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
     });
</script>