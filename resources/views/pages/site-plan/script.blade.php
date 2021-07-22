<script>
     $("[name=form_site_plan]").on('submit', function(e) {
        e.preventDefault();

        $('.help').empty();
        $("div").removeClass("has-error");
        $('#btn_siteplan').text('sedang menyimpan...');
        $('#btn_siteplan').attr('disabled', true);

        var form = $('[name="form_site_plan"]')[0];
        var data = new FormData(form);
        var url = '{{route("site-plan.simpan")}}';
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
                    $('#btn_siteplan').text('Simpan');
                    $('#btn_siteplan').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn_siteplan').text('Simpan');
                    $('#btn_siteplan').attr('disabled', false);
                }
            }
        });
    });
</script>