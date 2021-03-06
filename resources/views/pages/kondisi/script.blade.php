<script>
    var table_kondisi = $('#table-kondisi').DataTable({
        pageLength: 5,
        lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        processing: true,
        serverSide: true,
        info :true,
        ajax: {
            url: "{{ route('kondisi',['id' => $data->id]) }}",
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

    $(".tahun").change(function(){
        table_kondisi.ajax.reload(null,true);
    });

    $(".tambah_kondisi").click(function(){
        save_method = 'add';
        $('#form_kondisi')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('#modal_kondisi').modal('show');
        $('.modal-title').text('Tambah Kondisi');
        counterkondisi = 0;
        $('.tahun_kondisi').removeAttr('disabled');
        $('.tahun_kondisi').val('').change();
        $('.lainnya').html('');
    });

    function ubah_kondisi(id,tahun)
    {
        save_method = 'edit';
        $('#form_kondisi')[0].reset();
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
                $('.modal-title').text('Ubah Data Kondisi');
                $('.tahun_kondisi').attr('disabled','true');
                $('.tahun_kondisi').val(data[0].tahun).change();
                $('[name="pilih_tahun"]').val(data[0].tahun);
                var hitung = 0;
                for(let i=0; i < data.length; i++)
                {
                    var baik = rusak = '';
                    if(data[i].kondisi == 'Baik')
                    {
                        baik = 'selected';
                    }else{
                        rusak = 'selected';
                    }

                    hitung++;
                    var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv_kondisi' + counterkondisi);        
                    newTextBoxDiv.after().html('<div class="row input">'+
                                '<div class="col-md-7">'+
                                        '<div class="form-group row mb-4">'+
                                        '<div class="col-sm-4 col-md-4">'+
                                            '<input type="text" name="nama[]" class="form-control" placeholder="Kondisi" value="'+data[i].nama+'">'+
                                        '</div>'+
                                        '<div class="col-md-4">'+
                                            '<select name="kondisi[]" class="form-control"><option '+baik+' value="Baik">Baik</option><option '+rusak+' value="Ada Kerusakaan">Ada Kerusakan</option></select>'+
                                            '<span class="help form-control-label"></span>'+
                                        '</div>'+
                                        '<div class="col-md-4">'+
                                            '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_kondisi[]"><input type="hidden" class="form-control" name="foto_kondisi_lama[]" value="'+data[i].foto_kondisi+'">'+
                                            '<span class="help form-control-label"></span><span class="help-text form-control-label"><p>* Maksimal file 2 Mb, Kosongkan jika data tidak diubah</p></span>'+
                                        '</div>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="col-md-5">'+
                                        '<div class="form-group row mb-4">'+
                                        '<div class="col-sm-6 col-md-6">'+
                                        '<input type="text" name="luas[]" class="form-control" placeholder="Luas / Jumlah" value="'+data[i].luas+'"></div>'+
                                        '<div class="col-sm-6">'+
                                            '<input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_luas[]"><input type="hidden" class="form-control" name="foto_luas_lama[]" value="'+data[i].foto_luas+'">'+
                                            '<span class="help form-control-label"></span><span class="help-text form-control-label"><p>* Maksimal file 2 Mb, Kosongkan jika data tidak diubah</p></span>'+
                                        '</div>'+
                                        '</div>'+
                                '</div>'+
                            '</div>');
                    newTextBoxDiv.appendTo("#TextBoxesGroup_kondisi");
                }
                counterkondisi = hitung
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    $("[name=form_kondisi]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn-kondisi').text('sedang menyimpan...');
        $('#btn-kondisi').attr('disabled', true);

        var form = $('[name="form_kondisi"]')[0];
        var data = new FormData(form);
        if(save_method == 'edit')
        {
            var url = '{{route("kondisi.ubah")}}';
        }else{
            var url = '{{route("kondisi.simpan")}}';
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
                        $('#modal_kondisi').modal('hide');
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
                    $('#btn-kondisi').text('Simpan');
                    $('#btn-kondisi').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn-kondisi').text('Simpan');
                    $('#btn-kondisi').attr('disabled', false);
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

    $("#addButton_kondisi").click(function () {            
        if(counterkondisi>100){
            alert("Maksimal 100 Data Lainnya");
            return false;
        }   
        
        counterkondisi++;
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv_kondisi' + counterkondisi);        
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
                                                '<input required type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_kondisi[]">'+
                                                '<span class="help form-control-label"></span><p><label class="help-text form-control-label">* Maksimal File 2 Mb</label></p>'+
                                            '</div>'+
                                            '</div>'+
                                    '</div>'+
                                    '<div class="col-md-5">'+
                                            '<div class="form-group row mb-4">'+
                                            '<div class="col-sm-6 col-md-6">'+
                                            '<input type="text" name="luas[]" class="form-control" placeholder="Luas / Jumlah"></div>'+
                                            '<div class="col-sm-6">'+
                                                '<input required type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="foto_luas[]">'+
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
</script>