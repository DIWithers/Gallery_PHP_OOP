<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 
    $photos = Photo::find_all();
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
                    </h1>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>ID</th>
                                    <th>Filename</th>
                                    <th>Title</th>
                                    <th>Size</th>
                                    <th>Comments</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($photos as $photo) : ?>
                                <tr>
                                    <td><img class="admin-photo-thumbnail" src="<?php echo $photo->image_path() ?>" alt="<?php echo $photo->title; ?>"/>
                                        <div class="actions_link">
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>   
                                            <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>  
                                            <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>  
                                        </div>
                                    </td>
                                    <td><?php echo $photo->id; ?> </td>
                                    <td><?php echo $photo->filename; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->size; ?></td>
                                    <td>
                                        <?php 
                                        $comments = Comment::find_comments($photo->id);
                                        $comment_count = count($comments);
                                        ?>
                                        <a href="photo_comment.php?id=<?php echo $photo->id; ?>"><?php echo $comment_count ?></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include("includes/footer.php"); ?>