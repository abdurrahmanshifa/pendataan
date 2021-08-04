<script>
     var table_pembangunan = $('#table-jenis-ruangan').DataTable({
        pageLength: 5,
        lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('pembangunan',['id' => $id_pembangunan]) }}",
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

     function tambah_pembangunan() {
          counterruangan = 0;
          save_method = 'add';
          $('#form_pembangunan')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();
          $('.lain_ruangan').html(' ');
          $('#modal_pembangunan').modal('show');
          $('.modal-title').text('Tambah Data');
     }

     function table_pembangunan(){
          table_pembangunan.ajax.reload(null,true);
     }

     $("#addButton_ruangan").click(function () {
        if(counterruangan>50){
            alert("Maksimal 50 Data Lainnya");
            return false;
        }   
        counterruangan++;
        var newTextBoxDiv = $(document.createElement('div')).attr("class", 'col-md-12 TextBoxDiv_ruangan' + counterruangan);        
        newTextBoxDiv.after().html('<div class="row"><div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Jenis Ruangan <span class="text-danger">*</span></label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="hidden" name="foto_lama[]"><input type="text" class="form-control" name="id_jenis_ruangan[]">'+
                                   '<span class="help form-control-label"></span>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Jumlah Ruangan <span class="text-danger">*</span></label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="text" class="form-control" name="jml_ruangan[]">'+
                                   '<span class="help form-control-label"></span>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Luas <span class="text-danger">*</span></label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="text" class="form-control" name="luas_ruangan[]">'+
                                   '<span class="help form-control-label"></span>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Foto</label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">'+
                                   '<span class="help form-control-label"></span><p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div></div>');

        newTextBoxDiv.appendTo("#TextBoxesGroup_ruangan");        
        
     });

    $("#removeButton_ruangan").click(function () {
        //alert(counterruangan);
        $(".TextBoxDiv_ruangan" + counterruangan).remove();
        counterruangan--;
    });

     $("[name=form_pembangunan]").on('submit', function(e) {
          e.preventDefault();

          $('.help').empty();
          $("div").removeClass("has-error");
          $('#btn-pembangunan').text('sedang menyimpan...');
          $('#btn-pembangunan').attr('disabled', true);

          var form = $('[name="form_pembangunan"]')[0];
          var data = new FormData(form);
          if(save_method != 'edit'){
               var url = '{{route("pembangunan.simpan")}}';
          }else{
               var url = '{{route("pembangunan.ubah")}}';
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
                              $('#btn-pembangunan').text('Simpan');
                              $('#btn-pembangunan').attr('disabled', false);
                         }
                         else {
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
                    }else{
                         for (var i = 0; i < obj.input_error.length; i++) 
                         {
                              $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                              $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                         }
                         $('#btn-pembangunan').text('Simpan');
                         $('#btn-pembangunan').attr('disabled', false);
                    }
               }
          });
     });

     function ubah_pembangunan(id)
     {
          save_method = 'edit';
          $('#form_pembangunan')[0].reset();
          $('div').removeClass('has-error');
          $('.help').empty();
          $('.lain_ruangan').html(' ');
          $.ajax({
               url : "{{url('survey/pembangunan/data')}}"+"/"+id,
               type: "GET",
               dataType: "JSON",
               success: function(data){
                    $('#modal_pembangunan').modal('show');
                    $('.modal-title').text('Ubah Data');
                    $('[name="id_pembangunan"]').val(data.id);
                    $('[name="tahun"]').val(data.tahun);
                    $('[name="luas"]').val(data.luas);
                    $('[name="jml_lantai"]').val(data.jml_lantai);
                    $('[name="id_halaman"]').val(data.id_halaman).change();
                    $('[name="id_saluran"]').val(data.id_saluran).change();
                    $('[name="id_pagar"]').val(data.id_pagar).change();
                    $('[name="luas_halaman"]').val(data.luas_halaman);
                    $('[name="panjang_saluran"]').val(data.panjang_saluran);
                    $('[name="panjang_pagar"]').val(data.panjang_pagar);
                    var hitung = 0;
                    for (let i = 0; i < data.ruangan.length; i++) {
                         hitung++;

                         var newTextBoxDiv = $(document.createElement('div')).attr("class", 'col-md-12 TextBoxDiv_ruangan' + hitung);        
                         newTextBoxDiv.after().html('<div class="row"><div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Jenis Ruangan <span class="text-danger">*</span></label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="hidden" name="foto_lama[]" value="'+data.ruangan[i].foto+'"><input type="text" class="form-control" name="id_jenis_ruangan[]" value="'+data.ruangan[i].nama+'">'+
                                   '<span class="help form-control-label"></span>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Jumlah Ruangan <span class="text-danger">*</span></label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="text" class="form-control" name="jml_ruangan[]" value="'+data.ruangan[i].jml_ruangan+'">'+
                                   '<span class="help form-control-label"></span>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Luas <span class="text-danger">*</span></label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="text" class="form-control" name="luas_ruangan[]" value="'+data.ruangan[i].luas+'">'+
                                   '<span class="help form-control-label"></span>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                   '<label class="col-form-label col-12 col-md-5 col-lg-5">Foto</label>'+
                                   '<div class="col-sm-12 col-md-7">'+
                                   '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control foto-upload" name="foto[]">'+
                                   '<span class="help form-control-label"></span><p><label class="help-text form-control-label">* Maksimal File 2 Mb, Kosongkan jika data tidak diubah</label></p>'+
                                   '</div>'+
                                   '</div>'+
                                   '</div></div>');
                         newTextBoxDiv.appendTo("#TextBoxesGroup_ruangan");   
                    }
                    counterruangan = hitung;
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }
</script>