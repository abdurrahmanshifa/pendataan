@php 
    if(isset($data->pembangunan->id))
    {
        $id_pembangunan = $data->pembangunan->id;
    }else{
        $id_pembangunan = 0;
    }
@endphp
@include('pages.pembangunan.script');
@include('pages.rehabilitasi.script');
@include('pages.spesifikasi.script');
@include('pages.kondisi.script');
@include('pages.site-plan.script');
@include('pages.survey-validasi.script');
<script>
    function ResizeImage() {
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            var filesToUploads = document.getElementById('img-input').files;
            var file = filesToUploads[0];
            if (file) {

                var reader = new FileReader();
                // Set the image once loaded into file reader
                reader.onload = function(e) {

                    var img = document.createElement("img");
                    img.src = e.target.result;

                    var canvas = document.createElement("canvas");
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0);

                    var MAX_WIDTH = 600;
                    var MAX_HEIGHT = null;
                    var width = img.width;
                    var height = img.height;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, width, height);

                    dataurl = canvas.toDataURL(file.type);
                    //document.getElementById('output').src = dataurl;
                }
                reader.readAsDataURL(file);

            }

        } else {
            alert('The File APIs are not fully supported in this browser.');
        }
    }

    $(document).on("click", ".zoom", function () {
          var myBookId = $(this).data('id');
          var title = $(this).data('title');
          $(".modal-body #bookId").attr('src',myBookId);
          $(".modal-body #img-title").html(title);
     });
</script>