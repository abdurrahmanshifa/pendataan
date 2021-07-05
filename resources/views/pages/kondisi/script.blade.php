<script>
     $(document).on("click", ".open-kondisi", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/kondisi") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
     });

     $(document).on("click", ".open-luas", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/luas-kondisi") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
     });

     var table_kondisi = $('#table-kondisi').DataTable({
          pageLength: 10,
          processing: true,
          serverSide: true,
          info :false,
          ajax: {
               url: "{{ route('kondisi',['id' => $survey->id]) }}",
               data: function (data) {
                    data.filter = {   
                         'tahun'    : $('.tahun').val(),
                    };
               }
          },
          columns: [
               {"data":"DT_RowIndex"},
               {"data":"nama"},
               {"data":"kondisi"},
               {"data":"foto_kondisi"},
               {"data":"luas"},
               {"data":"foto_luas"},
               {"data":"aksi"},
          ],
          columnDefs: [
               {
                    targets: [0,-1],
                    className: 'text-center'
               },
          ]
     });

     $(".tambah_kondisi").click(function(){
          save_method = 'add';
          $('#form_kondisi')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();
          $('#modal_kondisi').modal('show');
          $('.modal-title').text('Tambah Kondisi');
     });

     function ubah(id)
     {
          save_method = 'edit';
          $('#form_ubah')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();

          $.ajax({
               url : "{{url('survey/kondisi/data/')}}"+"/"+id,
               type: "GET",
               dataType: "JSON",
               success: function(data){
                    $('#modal_ubah').modal('show');
                    $('.modal-title').text('Ubah Data Kondisi');
                    $('[name="id_kondisi"]').val(data.id);
                    $('[name="nama_ubah"]').val(data.nama);
                    $('[name="kondisi_ubah"]').val(data.kondisi).change();
                    $('[name="luas_ubah"]').val(data.luas);
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

     $(".refresh").click(function(){
          table_kondisi.ajax.reload(null,true);
     });

     $(".tahun").change(function(){
          table_kondisi.ajax.reload(null,true);
     });

     $("[name=form_kondisi]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn_spesifikasi_lain').text('sedang menyimpan...');
        $('#btn_spesifikasi_lain').attr('disabled', true);

        var form = $('[name="form_kondisi"]')[0];
        var data = new FormData(form);
        var url = '{{route("kondisi.simpan")}}';
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
                        $('#modal_spesifikasi_lain').modal('hide');
                        Swal.fire({
                            text: obj.message,
                            title: "Perhatian!",
                            icon: "success",
                            button: true,
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                        
                    }
                    $('#btn_spesifikasi_lain').text('Simpan');
                    $('#btn_spesifikasi_lain').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn_spesifikasi_lain').text('Simpan');
                    $('#btn_spesifikasi_lain').attr('disabled', false);
                }
            }
        });
     });

     $("[name=form_ubah]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn_ubah').text('sedang menyimpan...');
        $('#btn_ubah').attr('disabled', true);

        var form = $('[name="form_ubah"]')[0];
        var data = new FormData(form);
        var url = '{{route("kondisi.ubah")}}';
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
                        $('#modal_ubah').modal('hide');
                        Swal.fire({
                            text: obj.message,
                            title: "Perhatian!",
                            icon: "success",
                            button: true,
                        }).then((result) => {
                            if (result.value) {
                              table_kondisi.ajax.reload(null,true);
                            }
                        });
                        
                    }
                    $('#btn_ubah').text('Simpan');
                    $('#btn_ubah').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn_ubah').text('Simpan');
                    $('#btn_ubah').attr('disabled', false);
                }
            }
        });
     });

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
                        url : "{{url('survey/kondisi/hapus/')}}"+"/"+id,
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
                                table_kondisi.ajax.reload(null,true);
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
                table_kondisi.ajax.reload(null,true); 
            }

        });
    }

     var counterlain = 2;
     $("#addButton_lain").click(function () {            
          if(counterlain>10){
               alert("Maksimal 10 Data Lainnya");
               return false;
          }   
          
          var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv_lain' + counterlain);        
          newTextBoxDiv.after().html('<div class="row input">'+
                                        '<div class="col-md-7">'+
                                             '<div class="form-group row mb-4">'+
                                             '<div class="col-sm-4 col-md-4">'+
                                                  '<input type="text" name="nama[]" class="form-control" placeholder="Kondisi">'+
                                             '</div>'+
                                             '<div class="col-md-4">'+
                                                  '<select name="kondisi[]" class="form-control"><option value="Baik">Baik</option><option value="Ada Kerusakaan">Ada Kerusakan</option></select>'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                             '<div class="col-md-4">'+
                                                  '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_kondisi[]">'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                             '</div>'+
                                        '</div>'+
                                        '<div class="col-md-5">'+
                                             '<div class="form-group row mb-4">'+
                                             '<div class="col-sm-6 col-md-6">'+
                                             '<input type="text" name="luas[]" class="form-control" placeholder="Luas / Jumlah"></div>'+
                                             '<div class="col-sm-6">'+
                                                  '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div>');

          newTextBoxDiv.appendTo("#TextBoxesGroup_lain");        
          counterlain++;
     });

     $("#removeButton_lain").click(function () {
          $("#TextBoxDiv_lain" + counterlain).remove();
          counterlain--;   
               
     });
</script>