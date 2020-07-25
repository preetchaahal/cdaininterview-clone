$(document).ready(function(){

    $('#upload_form').on('submit', function(event){
        event.preventDefault();
        var uploadUrl = $(this).attr('action');
        $.ajax({
            url: uploadUrl,
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {
                $('#message').css('display', 'block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                $('#uploaded_image').html(data.uploaded_image);
            }
        })
    });

});