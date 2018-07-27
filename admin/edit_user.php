<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    $id = $_GET['id'];
    if (empty($id)) {
        redirect("users.php");
    }
    else {
        $user = User::find_by_id($id);
    }
?>
<?php 
    if (isset($_POST['update'])) {
        if (!empty($_FILES['user_image'])) {
            $photo = new Photo();
            $photo->set_file($_FILES['user_image']);
            $photo->save();
        }
        if ($user) {
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->password = $_POST['password'];
            $user->user_image = $photo->filename;
            $user->save();
            redirect("edit_user.php?id={$user->id}");
        }
    }
?>
<?php include("includes/photo_library_modal.php"); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php") ?>
    <?php include("includes/side_nav.php") ?>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    User
                    <small>Edit</small>
                </h1>
                <div class="col-md-4">
                    <a href="#" data-toggle="modal" data-target="#photo-library">
                    <img class="img-responsive" src="<?php echo $user->image_path_or_placeholder() ?>" alt="<?php echo $user->user_image; ?>"/>
                    </a>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="img_upload">Upload New Photo</label>
                            <input type="file" name="user_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?php echo $user->username ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="<?php echo $user->first_name ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="<?php echo $user->last_name ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="<?php echo $user->password ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                            <input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>