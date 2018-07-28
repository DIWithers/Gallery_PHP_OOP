// Init Trumbowyg
$('#photo_desc').trumbowyg();

$(document).ready(function() {
    var user_href;
    var user_id;
    var image_href;
    var image_filename;

    $(".modal_thumbnails").click(function() {
        $("#set_user_image").prop('disabled', false);
        user_href = $("#user-id-delete").prop('href').split("=");
        user_id = user_href[user_href.length - 1];
        image_href = $(this).prop("src").split("/");
        image_filename = image_href[image_href.length - 1];
    })
});