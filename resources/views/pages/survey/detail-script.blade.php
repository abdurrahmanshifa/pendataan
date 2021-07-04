@php 
    if(isset($data->pembangunan->id))
    {
        $id_pembangunan = $data->pembangunan->id;
    }else{
        $id_pembangunan = 0;
    }
@endphp
<script>
    var table = $('#table-jenis-ruangan').DataTable({
        pageLength: 10,
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

    $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/jenis-ruangan") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
    });

    $(document).on("click", ".open-spesifikasi", function () {
        var myBookId = $(this).data('id');
        var title = $(this).data('title');
        $(".modal-body #bookId").attr('src','{{ url("show-image/spesifikasi") }}/'+myBookId);
        $(".modal-body #img-title").html(title);
    });

    var table_rehabilitasi = $('#table-rehabilitasi').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('rehabilitasi',['id' => $data->id]) }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"nama"},
            {"data":"tahun"},
            {"data":"sumber_anggaran"},
            {"data":"aksi"},
        ],
        columnDefs: [
            {
                targets: [0,2,-1],
                className: 'text-center'
            },
        ]
    });

    $(".tambah_rehabilitasi").click(function(){
        save_method = 'add';
        $('#form_rehabilitasi')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('#modal_rehabilitasi').modal('show');
        $('.modal-title').text('Tambah Data Rehabilitasi');
    });

    $("[name=form_rehabilitasi]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('sedang menyimpan...');
        $('#btn').attr('disabled', true);

        var form = $('[name="form_rehabilitasi"]')[0];
        var data = new FormData(form);
        if(save_method == 'add'){
            var url = '{{route("rehabilitasi.simpan")}}';
        }else{
            var url = '{{route("rehabilitasi.ubah")}}';
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
                        table_rehabilitasi.ajax.reload(null,true);
                        $('#modal_rehabilitasi').modal('hide');
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

    function ubah_rehabilitasi(id)
    {
        save_method = 'edit';
        $('#form_rehabilitasi')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();

        $.ajax({
            url : "{{url('survey/rehabilitasi/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_rehabilitasi').modal('show');
                $('.modal-title').text('Ubah Data Rehabilitasi');
                $('[name="id_rehabilitasi"]').val(data.id);
                $('[name="tahun"]').val(data.tahun);
                $('[name="sumber_anggaran"]').val(data.sumber_anggaran);
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
                        url : "{{url('survey/rehabilitasi/hapus/')}}"+"/"+id,
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

    var table_spesifikasi = $('#table-spesifikasi').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('spesifikasi',['id' => $data->id]) }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"nama"},
            {"data":"jenis"},
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

    $(".tambah_spesifikasi").click(function(){
        save_method = 'add';
        $('#form_spesifikasi')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('#modal_spesifikasi').modal('show');
        $('.modal-title').text('Tambah Data Spesifikasi');
        $('#TextBoxesGroup').html('');
    });

    $(".tambah_spesifikasi_lain").click(function(){
        save_method = 'add';
        $('#form_spesifikasi_lain')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('#modal_spesifikasi_lain').modal('show');
        $('.modal-title').text('Tambah Data Spesifikasi Lainnya');
    });

    function ubah_spesifikasi(id)
    {
        save_method = 'edit';
        $('#form_spesifikasi')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();

        $.ajax({
            url : "{{url('survey/spesifikasi/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_spesifikasi_ubah').modal('show');
                $('.modal-title').text('Ubah Data Spesifikasi');
                $('.nama_spesifikasi').html(data.nama);
                $('.jenis_spesifikasi').html(data.type);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    $("[name=form_spesifikasi]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn_spesifikasi').text('sedang menyimpan...');
        $('#btn_spesifikasi').attr('disabled', true);

        var form = $('[name="form_spesifikasi"]')[0];
        var data = new FormData(form);
        var url = '{{route("spesifikasi.simpan")}}';
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
                        $('#modal_spesifikasi').modal('hide');
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
                    $('#btn_spesifikasi').text('Simpan');
                    $('#btn_spesifikasi').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn_spesifikasi').text('Simpan');
                    $('#btn_spesifikasi').attr('disabled', false);
                }
            }
        });
    });

    $("[name=form_spesifikasi_lain]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn_spesifikasi_lain').text('sedang menyimpan...');
        $('#btn_spesifikasi_lain').attr('disabled', true);

        var form = $('[name="form_spesifikasi_lain"]')[0];
        var data = new FormData(form);
        var url = '{{route("spesifikasi.simpan-lain")}}';
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

    $("[name=form_spesifikasi_ubah]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn_spesifikasi_ubah').text('sedang menyimpan...');
        $('#btn_spesifikasi_ubah').attr('disabled', true);

        var form = $('[name="form_spesifikasi_ubah"]')[0];
        var data = new FormData(form);
        var url = '{{route("spesifikasi.ubah")}}';
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
                        $('#modal_spesifikasi_ubah').modal('hide');
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
                    $('#btn_spesifikasi_ubah').text('Simpan');
                    $('#btn_spesifikasi_ubah').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn_spesifikasi_ubah').text('Simpan');
                    $('#btn_spesifikasi_ubah').attr('disabled', false);
                }
            }
        });
    });

    var counter = 1;
        
    $("#addButton").click(function () {            
        if(counter>10){
            alert("Maksimal 10 Data Lainnya");
            return false;
        }   
        
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);        
        newTextBoxDiv.after().html('<div class="row input">'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group row mb-4">'+
                                            '<div class="col-sm-4 col-md-4">'+
                                                '<input type="hidden" name="id_spesifikasi[]"><input type="text" name="nama[]" class="form-control" placeholder="Nama">'+
                                            '</div>'+
                                            '<div class="col-md-8">'+
                                                '<input type="text" name="jenis[]" class="form-control" placeholder="Jenis">'+
                                                '<span class="help form-control-label"></span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group row mb-4">'+
                                            '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>'+
                                            '<div class="col-sm-12 col-md-9">'+
                                                '<input type="file" class="form-control" name="foto[]">'+
                                                '<span class="help form-control-label"></span>'+
                                            '</div>'+
                                        '</div>'+
                                   '</div>'+
                                '</div>');

        newTextBoxDiv.appendTo("#TextBoxesGroup");        
        counter++;
    });

    $("#removeButton").click(function () {
        $("#TextBoxDiv" + counter).remove();
        counter--;   
            
    });

    var counterlain = 2;
    $("#addButton_lain").click(function () {            
        if(counterlain>10){
            alert("Maksimal 10 Data Lainnya");
            return false;
        }   
        
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv_lain' + counterlain);        
        newTextBoxDiv.after().html('<div class="row input">'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group row mb-4">'+
                                            '<div class="col-sm-4 col-md-4">'+
                                                '<input type="hidden" name="id_spesifikasi[]"><input type="text" name="nama[]" class="form-control" placeholder="Nama">'+
                                            '</div>'+
                                            '<div class="col-md-8">'+
                                                '<input type="text" name="jenis[]" class="form-control" placeholder="Jenis">'+
                                                '<span class="help form-control-label"></span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group row mb-4">'+
                                            '<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media</label>'+
                                            '<div class="col-sm-12 col-md-9">'+
                                                '<input type="file" class="form-control" name="foto[]">'+
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

    var table_kondisi = $('#table-kondisi').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('kondisi',['id' => $data->id]) }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"nama"},
            {"data":"jenis"},
            {"data":"media"},
            {"data":"aksi"},
            {"data":"aksi"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
                className: 'text-center'
            },
        ]
    });

</script>