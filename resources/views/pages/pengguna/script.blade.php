<script>
     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :true,
        ajax: {
            url: "{{ route('pengguna') }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"name"},
            {"data":"email"},
            {"data":"group"},
            {"data":"last_login"},
            {"data":"aksi"},
        ],
        columnDefs: [
            {
                targets: [0,-2,-1],
                className: 'text-center'
            },
        ]
    });

    $(".refresh").click(function(){
          table.ajax.reload(null,true);
    });

    function table_data(){
        table.ajax.reload(null,true);
    }

    $("[name=form_data]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('sedang menyimpan...');
        $('#btn').attr('disabled', true);

        var form = $('[name="form_data"]')[0];
        var data = new FormData(form);
        if(save_method == 'add'){
            var url = '{{route("pengguna.simpan")}}';
        }else{
            var url = '{{route("pengguna.ubah")}}';
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

    $(".tambah").click(function(){
        save_method = 'add';
        $('#form_data')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Data');
        $('#field').attr('style','display:none');
        $('.id_klasifikasi').val([]).change();
        $('[name="group"]').val(1).change();
        $('[name="id_instansi"]').val('').change();
    });

    function ubah(id)
    {
        save_method = 'edit';
        $('#form_data')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();

        $('#field').attr('style','display:none');
        $('.id_klasifikasi').val([]).change();
        $('[name="id_instansi"]').val('').change();

        $.ajax({
            url : "{{url('pengguna/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_form').modal('show');
                $('.modal-title').text('Ubah Data');
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.name);
                $('[name="email"]').val(data.email);
                $('[name="group"]').val(data.group).change();
                if(data.group == 2)
                {
                    var Values = new Array();
                    data.groups.forEach((element) => {
                        Values.push(element.id_klasifikasi);
                    });
                    $('.id_klasifikasi').val(Values).change();
                    $('[name="id_instansi"]').val(data.id_instansi).change();
                }
                
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
                        url : "{{url('pengguna/hapus/')}}"+"/"+id,
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

    $("#group").change(function(){
        var id = $(this).val();
        if(id == 2)
        {
            $('#field').removeAttr('style','display:none');
        }else{
            $('#field').attr('style','display:none');
        }
    });
</script>