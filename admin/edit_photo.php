<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
    $id = $_GET['id'];
    if (empty($id)) {
        redirect("photos.php");
    }
    else {
        $photo = Photo::find_by_id($id);
    }
?>
<?php 
    if (isset($_POST['update'])) {
        if ($photo) {
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alt_text = $_POST['alt_text'];
            $photo->description = $_POST['description'];
            $photo->save();
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
                        PHOTOS
                        <small>Edit</small>
                    </h1>
                    <form action="" method="post">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="title" value="<?php echo $photo->title ?>" class="form-control">
                            </div>
                            <div class="form-group">
                            <a class="thumbnail" href=""><img src="<?php echo $photo->image_path() ?>" alt=""></a>
                            </div>
                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input type="text" name="caption" value="<?php echo $photo->caption ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alt-text">Alternate Text</label>
                                <input type="text" name="alt_text" value="<?php echo $photo->alt_text ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo $photo->description ?></textarea>
                            </div>
                        </div>
                        <!-- start / need to check form -->
                        <div class="col-md-4">
                            <div class="photo-info-box">
                                <div class="info-box-header">
                                    <h4> Save
                                        <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span>
                                    </h4>
                                </div>
                                <div class="inside">
                                    <div class="box-inner">
                                        <p class="text">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            Uploaded on...
                                        </p>
                                        <p class="text">
                                            Photo Id: 
                                            <span class="data photo_id_box">34</span>
                                        </p>
                                        <p class="text">
                                            Filename: 
                                            <span class="data">image.jpg</span>
                                        </p>
                                        <p class="text">
                                            File Type: 
                                            <span class="data">JPG</span>
                                        </p>
                                        <p class="text">
                                            File Size: 
                                            <span class="data">12345</span>
                                        </p>
                                    </div>
                                    <div class="info-box-footer clearfix">
                                        <div class="info-box-delete pull-left">
                                        <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg">Delete</a>
                                        </div>
                                        <div class="info-box-update pull-right">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end -->
                </div>
            </div>
        </div>
    </div>
  <?php include("includes/footer.php"); ?>