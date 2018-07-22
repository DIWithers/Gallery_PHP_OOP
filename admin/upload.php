<?php include("includes/header.php"); ?>
<?php 
    if (!$session->is_signed_in()) {
        redirect("login.php");
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
                    UPLOAD
                    <small>Subheading</small>
                </h1>
                <div class="col-md-6">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <input type="file" name="file_upload"></input>
                        </div>
                        <input type="submit" name="submit"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>