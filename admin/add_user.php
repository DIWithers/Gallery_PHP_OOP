<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 
    if (isset($_POST['update'])) {
        if ($user) {
            $user->title = $_POST['title'];
            $user->caption = $_POST['caption'];
            $user->alt_text = $_POST['alt_text'];
            $user->description = $_POST['description'];
            $user->save();
        }
    }
?>

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
                        <small>Add</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </form>
                    <!-- end -->
                </div>
            </div>
        </div>
    </div>
  <?php include("includes/footer.php"); ?>