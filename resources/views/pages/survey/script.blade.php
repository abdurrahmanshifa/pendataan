<script>
     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('survey') }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"klasifikasi"},
            {"data":"nama_objek"},
            {"data":"lokasi"},
            {"data":"status_lahan"},
            {"data":"media"},
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
            var url = '{{route("survey.simpan")}}';
        }else{
            var url = '{{route("survey.ubah")}}';
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
            url : "{{url('survey/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_form').modal('show');
                $('.modal-title').text('Ubah Data');
                $('[name="id"]').val(data.id);
                $('[name="klasifikasi"]').val(data.klasifikasi);
                $('[name="nama_objek"]').val(data.nama_objek);
                $('[name="id_status_lahan"]').val(data.id_status_lahan).change();
                $('.id_kec').val(data.id_kec).change();
                $.ajax({
                    url : "{{url('master/kelurahan/id-by-kec/')}}"+"/"+data.id_kec+'/'+data.id_kel,
                    type: "GET",
                    dataType: "HTML",
                    success: function(data){
                            $('[name="id_kel"]').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                            alert('Error get data from ajax');
                    }
                });
                $('[name="alamat"]').val(data.alamat);
                $('[name="lat"]').val(data.lat);
                $('[name="long"]').val(data.long);
                
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
                        url : "{{url('survey/hapus/')}}"+"/"+id,
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

    $("[name='id_kec']").change(function(){
        var id = $(this).val();
        $.ajax({
            url : "{{url('master/kelurahan/id-by-kec/')}}"+"/"+id,
            type: "GET",
            dataType: "HTML",
            success: function(data){
                    $('[name="id_kel"]').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
            }
        });
     });
    
     $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/survey") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
     });
</script>