/**************************Scroll Up*****************************/
$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});
$('.scrollup').click(function () {
    $("html, body").animate({scrollTop: 0}, 600);
    return false;
});
/****************************************/
$('[data-toggle="tooltip"]').tooltip();
/****************************************/
var canClick = 1;
$(".buyNow").click(function () {
    if (canClick == 0) {
        return;
    }
    $.ajax({
        url: $(".buyNow").attr("data-bind"),
        method: "POST",
        beforeSend: function (xhr) {
            $('.faAni').removeClass("fa-cart-plus").addClass("fa-spinner").addClass("fa-spin");
            canClick = 0;
            $(".buyNow").addClass("disabled");
        }
    }).done(function (data) {
        data = jQuery.parseJSON(data);
        if (data.status === -1) {
            $('.popup-signin').modal('show');
            canClick = 1;
            $(".buyNow").removeClass("disabled");
            $('.faAni').addClass("fa-cart-plus").removeClass("fa-spinner").removeClass("fa-spin");
        } else if (data.status === 1) {
            $(location).attr('href', data.url);
        } else {
            $('#systemModalText').html(data.msg);
            $('#systemModal').modal('show');
            canClick = 1;
            $(".buyNow").removeClass("disabled");
            $('.faAni').addClass("fa-cart-plus").removeClass("fa-spinner").removeClass("fa-spin");
        }
    });
});

//Resize Image
if ($(".autoSizeItem").width() != null) {
    setSize();
}
//Resizr Post Image
if ($(".autoSizePost").width() != null) {
    setSizePost();
}
$(window).resize(function () {
    setSize();
    setSizePost();
});
function setSizePost() {
    if ($(".autoSizePost").width() != null) {
        var sizeHeight = ($(".autoSizePost").width() * 500) / 750;
        $(".sThumbnailPost").attr("width", $(".autoSizePost").width());

        $(".sThumbnailPost").attr("height", sizeHeight);
        $(".sThumbnailPost").css("width", $(".autoSizePost").width() + "px").css("height", sizeHeight + "px");
        $(".sThumbnailPost").children("img.lazy").css("width", $(".autoSizePost").width() + "px").css("height", sizeHeight + "px");
    }
}
function setSize() {
    if ($(".autoSizeItem").width() != null) {
        var sizeHeight = ($(".autoSizeItem").width() * 500) / 750;
        $(".sThumbnail").attr("width", $(".autoSizeItem").width());

        $(".sThumbnail").attr("height", sizeHeight);
        $(".sThumbnail").css("width", $(".autoSizeItem").width() + "px").css("height", sizeHeight + "px");
        $(".sThumbnail").children("img.lazy").css("width", $(".autoSizeItem").width() + "px").css("height", sizeHeight + "px");
    }
}
//Load image
$(function () {
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
});
//Submit comment
$(".submitComment").submit(function (event) {
    var ele = $(this);
    var details = ele.find(".form-control").val();
    var pId = $("#pId").attr("data-bind");
    var cId = $("#cId").attr("data-bind");
    if (details !== "") {
        var data = "pId=" + pId + "&details=" + details + "&cId=" + cId;
        var url = "/item/comments";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            beforeSend: function (xhr) {
                ele.find("button").addClass("disabled");
                ele.find("button").attr("disabled", "disabled");
                ele.find(".fa-comments-o").addClass("fa-spinner").addClass("fa-spin");
            },
            success: function (datas) {
                var server = JSON.parse(datas);
                if (typeof server === 'object') {
                    if (server.status === 1) {
                        getComments(server.id, pId, 1, ele);
                    }
                }
            },
            error: function () {
                ele.find(".form-control").val("");
                ele.find("button").removeClass("disabled");
                ele.find("button").removeAttr("disabled");
                ele.find(".fa-comments-o").removeClass("fa-spinner").removeClass("fa-spin");
            }
        });
    } else {
        ele.find(".form-control").focus();
    }
    event.preventDefault();
    return false;
});
//load comment
$(document).ready(function () {
    $('body').on('click', '.loadComments', function () {
        loadComments(this);
    });
});
$(".loadComments").click(function () {
    loadComments($(this));
});
function loadComments(e) {
    var page = $(e).attr("data-bind");
    var pId = $("#pId").attr("data-bind");
    var mId = $("#cId").attr("data-bind");
    var data = "pId=" + pId + "&p=" + page + "&cId=" + mId;
    var ele = $(e);
    var url = "/item/getComments";
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        beforeSend: function (xhr) {
            ele.addClass("disabled");
            ele.attr("disabled", "disabled");
            ele.find(".cur").addClass("bgddd");
            ele.find(".fa").addClass("fa-spinner").addClass("fa-spin");
        },
        success: function (datas) {
            if (datas !== '') {
                $(".media-list").html(datas);
            }
            ele.removeClass("disabled");
            ele.removeAttr("disabled");
            ele.find(".cur").removeClass("bgddd");
            ele.find(".fa").removeClass("fa-spinner").removeClass("fa-spin");
            $("html, body").animate({scrollTop: $("#totalComments").offset().top}, 600);
        },
        error: function () {
            ele.removeClass("disabled");
            ele.removeAttr("disabled");
            ele.find(".cur").removeClass("bgddd");
            ele.find(".fa").removeClass("fa-spinner").removeClass("fa-spin");
        }
    });
}

function getComments(cId, pId, page, ele) {
    var data = "cId=" + cId + "&p=" + page + "&pId=" + pId;
    var url = "/item/getComments";
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function (datas) {
            if (datas !== '') {
                $(".media-list").prepend(datas);
                $("html, body").animate({scrollTop: $("#totalComments").offset().top}, 600);
            }
            ele.find(".form-control").val("");
            ele.find("button").removeClass("disabled");
            ele.find("button").removeAttr("disabled");
            ele.find(".fa-comments-o").removeClass("fa-spinner").removeClass("fa-spin");
        },
        error: function () {
            ele.find(".form-control").val("");
            ele.find("button").removeClass("disabled");
            ele.find("button").removeAttr("disabled");
            ele.find(".fa-comments-o").removeClass("fa-spinner").removeClass("fa-spin");
        }
    });
}

$(".preview").click(function () {
    var id = $(this).attr("data-bind");
    if (id === "imgPrev") {
        $("#videoPrev").hide();
        $("#" + id).show();
    } else if (id === "videoPrev") {
        $("#imgPrev").hide();
        $("#" + id).show();
    } else {
        window.open($(this).attr("data-link"),'_blank');
    }
});