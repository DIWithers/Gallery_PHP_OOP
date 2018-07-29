<?php require_once("init.php"); ?>
<?php 
    if (isset($_POST['image_filename'])) {
        $user_image = $database->escape_string($_POST['image_filename']);
        $user_id = $database->escape_string($_POST['user_id']);
        $user->user_image = $user_image;
        $user = User::find_by_id($user_id);
        $user->user_image = $user_image;
        $user->update();
    }
    if (isset($_POST['photo_id'])){
        Photo::display_sidebar_data($_POST['photo_id']);
    }
?>
