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
                    <h4 class="bg-success"><?php echo $message ?></h4>
                    <h1 class="page-header">
                        Users
                    </h1>
                    <a href="add_user.php" class="btn btn-primary">Add User</a>
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

                                    <td><img class="admin-user-thumbnail user-image" src="<?php echo $user->image_path_or_placeholder() ?>" alt="<?php echo $user->username; ?>"/></td>
                                    <td><?php echo $user->username; ?>
                                        <div class="actions_link">
                                            <a href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
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