<?php require_once("init.php"); ?>
<?php 
    $user_image = $database->escape_string($_POST['image_filename']);
    $user_id = $database->escape_string($_POST['user_id']);
    $user->user_image = $user_image;
    $user = User::find_by_id($user_id);
    $user->user_image = $user_image;
    $user->update();
?>