<?php require_once("init.php"); ?>
<?php 
    $user = new User();
    $image_filename = $_POST['image_filename'];
    $user_id =  $_POST['user_id'];
    if (isset($image_filename)) {
        $user->save_user_image($image_filename, $user_id);
    }
?>