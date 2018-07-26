<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 
    $id =  $_GET['id'];
    $message = "";
    if (empty($id)) redirect("photos.php");
    $photo = Photo::find_by_id($id);
    $photo_path = 'images'. DS . $photo->filename;
    $comments = Comment::find_comments($id);
    if (!$comments) $message = "No comments found.";
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
                        Comments
                        <small>Subheading</small>
                    </h1>
                    <h4><?php echo $message ?></h4>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($comments as $comment) : ?>
                                <tr>
                    
                                    <td> <img class="admin-photo-thumbnail" src="<?php echo $photo_path ?>" alt=""></td>
                                    <td><?php echo $comment->id; ?> </td>
                                    <td><?php echo $comment->author; ?>
                                        <div class="actions_link">
                                            <a href="delete_comment.php?id=<?php echo $comment->id ?>">Delete</a>
                                        </div>
                                    </td>
                                    <td><?php echo $comment->body; ?></td>
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