<?php include("includes/init.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");}?>


  <?php 
    $id = $_GET['id'];
    if (empty($id)) {
      redirect("users.php");
    }
    $user = User::find_by_id($id);
    if ($user) {
      $user->delete();
      $session->message("The user {$user->username} has been deleted");
    }
    redirect("users.php");
  ?>