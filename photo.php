<?php include("includes/header.php"); ?>

<?php 
    require_once("admin/includes/init.php");

    $id = $_GET['id'];
    $message = "";
    if (empty($id)) redirect("index.php");
    if ($id) {
        $photo = Photo::find_by_id($_GET['id']);
    }
    $comments = Comment::find_comments($photo->id);
    if (isset($_POST['submit'])) {
        $author = trim($_POST['author']);
        $body = trim($_POST['body']);
        $new_comment = Comment::create_comment($photo->id, $author, $body);
        if ($new_comment && $new_comment->save()) {
            redirect("photo.php?id={$photo->id}");
        }
        else {
            $message = "Error: Problem saving comment. Be sure all fields are completed.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>GALLERY</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/blog-post.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php echo $photo->title ?></h1>
                    <p class="lead">
                        by <a href="index.php"><?php echo "User" ?></a>
                    </p>
                    <hr>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
                    <hr>
                    <h4><?php echo $message ?></h4>
                    <img class="img-responsive" src="admin/<?php echo $photo->image_path() ?>" alt="">
                    <hr>
                    <p class="lead"><?php echo $photo->caption;?></p>
                    <p><?php echo $photo->description; ?></p>

                    <hr>
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" name="author" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" rows="3"></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <hr>
                    <?php foreach ($comments as $comment): ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment->author; ?>
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                <?php echo $comment->body; ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <hr>
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center">Copyright &copy; Your Website 2018</p>
                    </div>
                </div>
            </footer>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
