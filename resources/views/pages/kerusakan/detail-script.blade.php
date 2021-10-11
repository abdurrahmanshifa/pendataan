
<script>
     $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src',myBookId);
          $(".modal-body #img-title").html(title);
     });

     var table_kondisi = $('#table-kondisi').DataTable({
          pageLength: 10,
          processing: true,
          serverSide: true,
          info :false,
          ajax: {
               url: "{{ route('kerusakan.detail',['id' => $data->id]) }}",
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
                    targets: [0,-1,-2,-3],
                    className: 'text-center'
               },
          ]
     });

     var table_riwayat = $('#table-riwayat').DataTable({
          pageLength: 10,
          processing: true,
          serverSide: true,
          info :false,
          ajax: {
               url: "{{ route('kerusakan.riwayat',['id' => $data->id]) }}",
               data: function (data) {
                    data.filter = {   
                         'tahun'    : $('.tahun').val(),
                    };
               }
          },
          columns: [
               {"data":"DT_RowIndex"},
               {"data":"jenis"},
               {"data":"tahun"},
               {"data":"luas"},
               {"data":"media"},
               {"data":"aksi"},
          ],
          columnDefs: [
               {
                    targets: [0,-1,-2,-3],
                    className: 'text-center'
               },
          ]
     });

     $(".tahun").change(function(){
          table_kondisi.ajax.reload(null,true);
     });

     function table_riwayats()
     {
          table_riwayat.ajax.reload(null,true);
     }

     function ubah_kondisi(id,tahun)
     {
          save_method = 'add';
          $('#form_riwayat')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help').empty();
          $('.lainnya').html('');
          counterkondisi = 0;
          $.ajax({
               url : "{{url('survey/kondisi/data/')}}"+"/"+id+"/"+tahun,
               type: "GET",
               dataType: "JSON",
               success: function(data){
                    $('#modal_kondisi').modal('show');
                    $('.modal-title').text('Riwayat Perbaikan');
                    table_riwayats();
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

     $("#addButton_kondisi").click(function () {            
          if(counterkondisi>10){
               alert("Maksimal 10 Data Lainnya");
               return false;
          }   
          
          counterkondisi++;
          var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv_kondisi' + counterkondisi);        
          newTextBoxDiv.after().html('<div class="row input">'+
                                        '<div class="col-md-8">'+
                                             '<div class="form-group row mb-4">'+
                                                  '<div class="col-sm-3 col-md-3">'+
                                                       '<select name="jenis[]" class="form-control select2">@foreach($data->kondisi as $val) <option value="{{$val->id}}">{{$val->nama}}</option> @endforeach</select>'+
                                                  '</div>'+
                                                  '<div class="col-md-3">'+
                                                       '<input type="text" name="tahun[]" class="form-control" placeholder="Tahun Perbaikan">'+
                                                       '<span class="help form-control-label"></span>'+
                                                  '</div>'+
                                                  '<div class="col-md-3">'+
                                                       '<input type="text" name="luas[]" class="form-control" placeholder="Luas / Jumlah Perbaikan">'+
                                                       '<span class="help form-control-label"></span>'+
                                                  '</div>'+
                                                  '<div class="col-md-3">'+
                                                       '<select name="satuan[]" class="form-control select2">@foreach($satuan as $val) <option value="{{$val->nama}}">@php echo $val->nama; @endphp</option> @endforeach</select>'+
                                                       '<span class="help form-control-label"></span>'+
                                                  '</div>'+
                                             '</div>'+
                                        '</div>'+
                                        '<div class="col-md-4">'+
                                             '<div class="form-group row mb-4">'+
                                                  '<div class="col-md-12">'+
                                                       '<input required type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_kondisi[]">'+
                                                       '<span class="help form-control-label"></span><p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>'+
                                                  '</div>'+
                                             '</div>'+
                                        '</div>'+
                                   '</div>');

          newTextBoxDiv.appendTo("#TextBoxesGroup_kondisi");        
     });

     $("#removeButton_kondisi").click(function () {
          $("#TextBoxDiv_kondisi" + counterkondisi).remove();
          counterkondisi--;   
               
     });

     $("[name=form_riwayat]").on('submit', function(e) {
          e.preventDefault();

          $('.help-block').empty();
          $("div").removeClass("has-error");
          $('#btn-kondisi').text('sedang menyimpan...');
          $('#btn-kondisi').attr('disabled', true);

          var form = $('[name="form_riwayat"]')[0];
          var data = new FormData(form);
          var url = '{{route("riwayat.simpan")}}';
          
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
                              Swal.fire({
                                   text: obj.message,
                                   title: "Perhatian!",
                                   icon: "success",
                                   button: true,
                              }).then((result) => {
                                   if (result.value) {
                                        $('.lainnya').html('');
                                        table_riwayats();
                                   }
                              });
                         }
                         $('#btn-kondisi').text('Simpan');
                         $('#btn-kondisi').attr('disabled', false);
                    }else{
                         Swal.fire({
                              text: obj.error_string[0],
                              title: "Perhatian!",
                              icon: "error",
                              button: true,
                              timer: 1000
                         });
                         $('#btn-kondisi').text('Simpan');
                         $('#btn-kondisi').attr('disabled', false);
                    }
               }
          });
     });

     function ubah(id)
     {
          $.ajax({
               url : "{{url('riwayat/detail/')}}"+"/"+id,
               type: "GET",
               dataType: "JSON",
               success: function(data){
                    $('.lainnya').html('');
                    $('.lainnya').html(
                         '<div class="row input">'+
                              '<div class="col-md-8">'+
                                   '<div class="form-group row mb-4">'+
                                        '<div class="col-sm-3 col-md-3">'+
                                             '<input type="hidden" name="id_perbaikan" value="'+data.id+'">'+
                                             '<select name="jenis_edit" class="form-control select2">@foreach($data->kondisi as $val) <option '+(data.id_kondisi == '{{$val->id}}'?'selected':'')+' value="{{$val->id}}">{{$val->nama}}</option> @endforeach</select>'+
                                        '</div>'+
                                        '<div class="col-md-3">'+
                                             '<input type="text" name="tahun_edit" class="form-control" value="'+data.tahun+'" placeholder="Tahun Perbaikan">'+
                                             '<span class="help form-control-label"></span>'+
                                        '</div>'+
                                        '<div class="col-md-3">'+
                                             '<input type="text" name="luas_edit" class="form-control" placeholder="Luas / Jumlah Perbaikan" value="'+data.luas+'">'+
                                             '<span class="help form-control-label"></span>'+
                                        '</div>'+
                                        '<div class="col-md-3">'+
                                             '<select name="satuan_edit" class="form-control select2">@foreach($satuan as $val) <option '+(data.satuan == '{{$val->nama}}'?'selected':'')+' value="{{$val->nama}}">@php echo $val->nama; @endphp</option> @endforeach</select>'+
                                             '<span class="help form-control-label"></span>'+
                                        '</div>'+
                                   '</div>'+
                              '</div>'+
                              '<div class="col-md-4">'+
                                   '<div class="form-group row mb-4">'+
                                        '<div class="col-md-12">'+
                                             '<input required type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_kondisi_edit">'+
                                             '<span class="help form-control-label"></span><p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>'+
                                        '</div>'+
                                   '</div>'+
                              '</div>'+
                         '</div>'
                    );
                    
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
                         url : "{{url('riwayat/hapus/')}}"+"/"+id,
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
                                   table_riwayats();
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
</script>