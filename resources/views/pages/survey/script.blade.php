<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> 
<<<<<<< HEAD
<script>    
=======
<script>
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout(timer);
            timer = setTimeout(callback,ms);
        };
    })();  

>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
    var lat = -6.071530
    var long = 106.359520;
    var marker = {};

    // peta(lat,long);
    document.getElementById('main-map').innerHTML = "<div id='mapid' style='width: 100%; height: 400px;'></div>";
    var map = L.map('mapid', {
        center: [lat, long],
        minZoom: 8,
        zoom: 20,
    });

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '<a href="https://tangerangkota.go.id" target="_blank" style="float:left">Kota Tangerang&nbsp;|&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ['a', 'b', 'c'],
    }).addTo(map);

    map.panTo(L.latLng(lat, long));
    marker = L.marker([lat, long]).addTo(map);

    map.on('click', function(e) {
        
        map.removeLayer(marker);
        marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
        
        $('[name="lat"]').val(e.latlng.lat);
        $('[name="long"]').val(e.latlng.lng);
    });
          
    L.Control.geocoder().addTo(map);

     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :true,
        ajax: {
            url: "{{ route('survey') }}",
<<<<<<< HEAD
=======
            data: function (data) {
                data.filter = {
                        'tahun' : $('[name="filter_tahun"]').val(),
                        'kec'    : $('[name="filter_kec"]').val(),
                        'kel'   : $('[name="filter_kel"]').val(),
                        'kla'   : $('[name="filter_kla"]').val(),
                };
            }
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"klasifikasi"},
            {"data":"lokasi"},
<<<<<<< HEAD
            {"data":"status_lahan"},
            {"data":"kelengkapan"},
            {"data":"media"},
            {"data":"petugas"},
=======
            {"data":"pembangunan"},
            {"data":"status_lahan"},
            {"data":"media"},
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
            {"data":"aksi"},
        ],
        columnDefs: [
            {
<<<<<<< HEAD
                targets: [0,-2,-1],
                className: 'text-center'
            },
            @if(Auth::user()->group != 1)
            {
                targets: [-2],
                visible: false
            },
            @endif
=======
                targets: [0,-1],
                className: 'text-center'
            },
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
        ]
    });

    $(".refresh").click(function(){
<<<<<<< HEAD
          table.ajax.reload(null,true);
=======
        table_data();
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
    });

    function table_data(){
        table.ajax.reload(null,true);
    }

<<<<<<< HEAD
=======
    $('[name="filter_tahun"]').keyup(delay(function (e) {
        table_data();
    }, 9000));

>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
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
        $('[name="klasifikasi"]').val('').change();
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
                $('[name="klasifikasi"]').val(data.klasifikasi).change();
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
<<<<<<< HEAD
    
=======

     $("[name='filter_kec']").change(function(){
        var id = $(this).val();
        $.ajax({
            url : "{{url('master/kelurahan/id-by-kec/')}}"+"/"+id,
            type: "GET",
            dataType: "HTML",
            success: function(data){
                    $('[name="filter_kel"]').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
            }
        });
        table_data();
     });
     $("[name='filter_kla']").change(function(){
        table_data();
     });
     $("[name='filter_kel']").change(function(){
        table_data();
     });
     $("[name='filter_stat']").change(function(){
        table_data();
     });
     
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
     $(document).on("click", ".open-AddBookDialog", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src','{{ url("show-image/survey") }}/'+myBookId);
          $(".modal-body #img-title").html(title);
     });
    
    
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            Swal.fire({
                text: "Geolocation tidak support pada browser ini!",
                title: "Perhatian",
                icon: "error",
                button: true,
            });
        }
    }

    function showPosition(position) {
        $('[name="lat"]').val(position.coords.latitude);
        $('[name="long"]').val(position.coords.longitude);
    }
</script>