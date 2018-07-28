// Init Trumbowyg
$('#photo_desc').trumbowyg();

$(document).ready(function() {
    var user_href;
    var user_id;
    var image_src;
    var image_filename;

    $(".modal_thumbnails").click(function() {
        $("#set_user_image").prop('disabled', false);
        $(this).addClass('selected');

        user_href = $("#user-id-delete").prop('href').split("=");
        user_id = user_href[user_href.length - 1];
        image_src = $(this).prop("src");
        image_src_split =  image_src.split("/");
        image_filename = image_src_split[image_src_split.length - 1];
    });
    $("#set_user_image").click(function() {
        $.ajax({
            url: "includes/update_user_image.php",
            data: {
                image_filename: image_filename,
                user_id: user_id
            },
            type: "POST",
            success: function(data) {
                if (!data.error) {
                    $("#user-image").attr('src', image_src);
                }
            }
        })
    })
});