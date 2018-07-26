<?php include("includes/header.php"); ?>

<?php 
    require_once("admin/includes/init.php");

    $id = $_GET['id'];
    $message = "";
    if (empty($id)) redirect("index.php");
    if ($id) {
        $photo = Photo::find_by_id($_GET['id']);
        $photo_path = 'admin' .DS . 'images'. DS . $photo->filename;
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
                <div class="col-lg-8">
                    <h1>Blog Post Title</h1>
                    <p class="lead">
                        by <a href="#">Start Bootstrap</a>
                    </p>
                    <hr>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
                    <hr>
                    <h4><?php echo $message ?></h4>
                    <img class="img-responsive" src="<?php echo $photo_path ?>" alt="">
                    <hr>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>
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
                <div class="col-md-4">
                    <div class="well">
                        <h4>Blog Search</h4>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </div>
                    <div class="well">
                        <h4>Blog Categories</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="well">
                        <h4>Side Widget Well</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p>
                    </div>
                </div>
            </footer>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
