<script>
     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :true,
        ajax: {
            url: "{{ route('halaman') }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"nama"},
            {"data":"keterangan"},
            {"data":"aksi"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
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
            var url = '{{route("halaman.simpan")}}';
        }else{
            var url = '{{route("halaman.ubah")}}';
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
    });

    function ubah(id)
    {
        save_method = 'edit';
        $('#form_data')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();

        $.ajax({
            url : "{{url('master/halaman/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_form').modal('show');
                $('.modal-title').text('Ubah Data');
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="keterangan"]').val(data.keterangan);
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
                        url : "{{url('master/halaman/hapus/')}}"+"/"+id,
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
</script>