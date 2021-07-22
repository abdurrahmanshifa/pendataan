<script>
     $(".addButton_rehab").click(function () {            
          if(counterrehab>10){
               alert("Maksimal 10 Data Lainnya");
               return false;
          }   
          counterrehab++;
          var newTextBoxDiv = $(document.createElement('div')).attr("class", 'col-md-12 TextBoxDiv_rehab' + counterrehab);        
          newTextBoxDiv.after().html('<div class="row"><div class="col-md-4">'+
                                        '<div class="form-group row mb-4">'+
                                             '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>'+
                                             '<div class="col-sm-12 col-md-9">'+
                                                  '<input type="text" name="nama[]" class="form-control" required>'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                        '<div class="form-group row mb-4">'+
                                             '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>'+
                                             '<div class="col-sm-12 col-md-9">'+
                                                  '<input type="text" class="form-control" name="luas[]" required>'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                        '<div class="form-group row mb-4">'+
                                             '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>'+
                                             '<div class="col-sm-12 col-md-9">'+
                                                  '<input type="file" required accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div></div>');

          newTextBoxDiv.appendTo(".TextBoxesGroup_rehab");        
          
     });

     $(".removeButton_rehab").click(function () {
          //alert(counterrehab);
          $(".TextBoxDiv_rehab" + counterrehab).remove();
          counterrehab--;   
               
     });
     
     var table_rehabilitasi = $('#table-rehabilitasi').DataTable({
          pageLength: 10,
          processing: true,
          serverSide: true,
          info :false,
          ajax: {
               url: "{{ route('rehabilitasi-detail') }}",
               type: 'GET',
               data: function (data) {
                    data.filter = {
                         'id_rehabilitasi'    : $('.cari_rehabilitasi').val(),
                    };
               }
          },
          columns: [
               {"data":"DT_RowIndex"},
               {"data":"nama"},
               {"data":"luas"},
               {"data":"media"},
               {"data":"aksi"},
          ],
          columnDefs: [
               {
                    targets: [0,2,-1],
                    className: 'text-center'
               },
          ]
     });

     $('.cari_rehabilitasi').change(function () {
          table_rehabilitasi.ajax.reload(null,true); 
     });

     $(".tambah_rehabilitasi").click(function(){
          counterrehab = 0;
          save_method = 'add';
          $('#form_rehabilitasi')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();
          $('#modal_rehabilitasi').modal('show');
          $('.modal-title').text('Tambah Data Rehabilitasi');
          $('.lain_rehab').html('');
     });

     $("[name=form_rehabilitasi]").on('submit', function(e) {
          e.preventDefault();

          $('.help').empty();
          $("div").removeClass("has-error");
          $('#btn_rehabilitasi_t').text('sedang menyimpan...');
          $('#btn_rehabilitasi_t').attr('disabled', true);

          var form = $('[name="form_rehabilitasi"]')[0];
          var data = new FormData(form);
          var url = '{{route("rehabilitasi.simpan")}}';
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
                         $('#modal_rehabilitasi').modal('hide');
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
                         $('#btn_rehabilitasi_t').text('Simpan');
                         $('#btn_rehabilitasi_t').attr('disabled', false);
                    }else{
                         for (var i = 0; i < obj.input_error.length; i++) 
                         {
                         $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                         $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                         }
                         $('#btn_rehabilitasi_t').text('Simpan');
                         $('#btn_rehabilitasi_t').attr('disabled', false);
                    }
               }
          });
     });

     $("[name=form_rehabilitasi_ubah]").on('submit', function(e) {
          e.preventDefault();

          $('.help').empty();
          $("div").removeClass("has-error");
          $('#btn_rehabilitasi_u').text('sedang menyimpan...');
          $('#btn_rehabilitasi_u').attr('disabled', true);

          var form = $('[name="form_rehabilitasi_ubah"]')[0];
          var data = new FormData(form);
          var url = '{{route("rehabilitasi.ubah")}}';
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
                         $('#modal_rehabilitasi').modal('hide');
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
                         $('#btn_rehabilitasi_u').text('Simpan');
                         $('#btn_rehabilitasi_u').attr('disabled', false);
                    }else{
                         for (var i = 0; i < obj.input_error.length; i++) 
                         {
                         $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                         $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                         }
                         $('#btn_rehabilitasi_u').text('Simpan');
                         $('#btn_rehabilitasi_u').attr('disabled', false);
                    }
               }
          });
     });

     function ubah_rehabilitasi(id)
     {
          save_method = 'edit';
          $('#form_rehabilitasi_ubah')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();
          counterrehab = 0;

          $.ajax({
               url : "{{url('survey/rehabilitasi/data/')}}"+"/"+id,
               type: "GET",
               dataType: "JSON",
               success: function(data){
                    $('#modal_rehabilitasi_ubah').modal('show');
                    $('.modal-title').text('Ubah Data Rehabilitasi');
                    $('[name="id_rehabilitasi"]').val(data.id);
                    $('[name="tahun"]').val(data.tahun);
                    $('[name="sumber_anggaran"]').val(data.sumber_anggaran);

                    var hitung = 0;
                    for(let i=0; i < data.rehabilitasi_detail.length; i++)
                    {
                         hitung++;
                         var newTextBoxDiv = $(document.createElement('div')).attr("class", 'col-md-12 TextBoxDiv_rehab' + hitung);        
                         newTextBoxDiv.after().html('<div class="row"><div class="col-md-4">'+
                                        '<div class="form-group row mb-4">'+
                                             '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<span class="text-danger">*</span></label>'+
                                             '<div class="col-sm-12 col-md-9">'+
                                                  '<input type="text" required name="nama[]" class="form-control" value="'+data.rehabilitasi_detail[i].nama+'"><input type="hidden" name="foto_lama[]" value="'+data.rehabilitasi_detail[i].foto+'" class="form-control">'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                        '<div class="form-group row mb-4">'+
                                             '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas <span class="text-danger">*</span></label>'+
                                             '<div class="col-sm-12 col-md-9">'+
                                                  '<input type="text" class="form-control" name="luas[]" required value="'+data.rehabilitasi_detail[i].luas+'">'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div>'+
                                   '<div class="col-md-4">'+
                                        '<div class="form-group row mb-4">'+
                                             '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>'+
                                             '<div class="col-sm-12 col-md-9">'+
                                                  '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto[]">'+
                                                  '<span class="help form-control-label"></span>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div></div>');

                         newTextBoxDiv.appendTo(".TextBoxesGroup_rehab");
                    }
                    counterrehab = hitung
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

     function hapus_rehabilitasi(id)
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
                         url : "{{url('survey/rehabilitasi-detail/hapus/')}}"+"/"+id,
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
                                   table_rehabilitasi.ajax.reload(null,true);
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
                    table_rehabilitasi.ajax.reload(null,true); 
               }

          });
     }
</script>