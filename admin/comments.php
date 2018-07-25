<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 
    $comments = Comment::find_all();
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
                    <a href="add_comment.php" class="btn btn-primary">Add Comment</a>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($comments as $comment) : ?>
                                <tr>
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