$(function () {
    'use strict';
    var url = '/user/upload_file';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {

                if (file.error) {
                    $('#uploadMsg').addClass('alert-danger').html(file.message);
                    $('#progress .progress-bar').css('width', 0 + '%');
                    $('#progress .progress-bar').html('');
                    $('#progress .progress-bar').removeClass("active");

                }

                if (file.error === 0) {
                    $('#progress .progress-bar').removeClass("active");
                    $('.dataFile').append('<option value="' + file.hash + '">' + file.name + '</option>');
                    $('#uploadMsg').removeClass('alert-danger').addClass('alert-success').html(file.message);
                }

            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css('width', progress + '%');
            $('#progress .progress-bar').html(progress + '%');
            $('#progress .progress-bar').removeClass("active").addClass("active");
        },
        fileuploadfail: function (e, data) {
            $('#progress .progress-bar').css('width', 0 + '%');
            $('#progress .progress-bar').removeClass("active");
            $('#progress .progress-bar').html('');
            $('#uploadMsg').removeClass('alert-success').addClass('alert-danger').html("Upload Error!");
        }
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

//Upload Avatar
$(function () {
    'use strict';
    var url = '/user/upload_image';
    $('.fileuploadCover').fileupload({
        url: url,
        dataType: 'json',
        beforeSend: function (xhr) {
            $('.faAniProfile').removeClass("fa-cloud-upload").addClass("fa-spinner").addClass("fa-spin");
            canClick = 0;
            $(".fileuploadCover").addClass("disabled");
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {

                if (file.error === 0) {
                    if (file.type === 1) {
                        $('.avatarSpan').css("background-image", "url(" + file.name + ")");
                    } else {
                        $('.coverSpan').css("background-image", "url(" + file.name + ")");
                    }
                }
                $('#systemModalText').html(file.message);
                $('#systemModal').modal('show');

                $(".fileuploadCover").removeClass("disabled");
                $('.faAniProfile').addClass("fa-cloud-upload").removeClass("fa-spinner").removeClass("fa-spin");
            });
        },
        fileuploadfail: function (e, data) {
            $('#systemModalText').html("Upload Error!");
            $('#systemModal').modal('show');
            $(".fileuploadCover").removeClass("disabled");
            $('.faAniProfile').addClass("fa-cloud-upload").removeClass("fa-spinner").removeClass("fa-spin");
        }
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

//Upload Image Blog
$(function () {
    'use strict';
    var url = '/user/upload_blog';
    $('#fileuploadBlog').fileupload({
        url: url,
        dataType: 'json',
        beforeSend: function (xhr) {
            $("#fileuploadBlog").addClass("disabled");
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {

                if (file.error === 0) {
                    $('#imgBlog').attr("src", file.name);
                    $('#image').val(file.hash);
                }
                $('#systemModalText').html(file.message);
                $('#systemModal').modal('show');

                $("#fileuploadBlog").removeClass("disabled");
            });
        },
        fileuploadfail: function (e, data) {
            $('#systemModalText').html("Upload Error!");
            $('#systemModal').modal('show');
            $("#fileuploadBlog").removeClass("disabled");
        }
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

