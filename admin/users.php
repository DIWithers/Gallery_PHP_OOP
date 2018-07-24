<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 
    $users = User::find_all();
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
                        USERS
                        <small>Subheading</small>
                    </h1>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Photo</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user->id; ?> </td>

                                    <td><img class="admin-user-thumbnail" src="<?php echo $user->user_image ?>" alt="<?php echo $user->title; ?>"/></td>
                                    <td><?php echo $user->username; ?>
                                        <div class="actions_link">
                                            <a href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
                                            <a href="view_user.php?id=<?php echo$user->id ?>">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
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