<script>
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout(timer);
            timer = setTimeout(callback,ms);
        };
    })();  

     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :true,
        ajax: {
            url: "{{ route('kerusakan') }}",
            data: function (data) {
                data.filter = {
                        'tahun' : $('[name="filter_tahun"]').val(),
                        'kec'    : $('[name="filter_kec"]').val(),
                        'kel'   : $('[name="filter_kel"]').val(),
                        'kla'   : $('[name="filter_kla"]').val(),
                };
            }
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"klasifikasi"},
            {"data":"lokasi"},
            {"data":"pembangunan"},
            {"data":"kerusakan"},
            {"data":"perbaikan"},
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
        table_data();
    });

    function table_data(){
        table.ajax.reload(null,true);
    }

    $('[name="filter_tahun"]').keyup(delay(function (e) {
        table_data();
    }, 9000));

    $("[name='filter_kec']").change(function(){
        var id = $(this).val();
        $.ajax({
            url : "{{url('master/kelurahan/id-by-kec/')}}"+"/"+id,
            type: "GET",
            dataType: "HTML",
            success: function(data){
                    $('[name="filter_kel"]').html(data);
                    table_data();
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
    
    $(document).on("click", ".open-AddBookDialog", function () {
        var myBookId = $(this).data('id');
        var title = $(this).data('title');
        $(".modal-body #bookId").attr('src','{{ url("show-image/survey") }}/'+myBookId);
        $(".modal-body #img-title").html(title);
    });

</script>