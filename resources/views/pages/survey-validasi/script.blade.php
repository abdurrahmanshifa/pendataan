<script>
     $("[name=form_survey]").on('submit', function(e) {
        e.preventDefault();

        $('.help').empty();
        $("div").removeClass("has-error");
        $('#btn_survey').text('sedang menyimpan...');
        $('#btn_survey').attr('disabled', true);

        var form = $('[name="form_survey"]')[0];
        var data = new FormData(form);
        var url = '{{route("survey-validasi.simpan")}}';
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
                    $('#btn_survey').text('Simpan');
                    $('#btn_survey').attr('disabled', false);
                }else{
                    for (var i = 0; i < obj.input_error.length; i++) 
                    {
                        $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                    }
                    $('#btn_survey').text('Simpan');
                    $('#btn_survey').attr('disabled', false);
                }
            }
        });
    });
</script>