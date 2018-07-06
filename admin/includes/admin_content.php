
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php
            //testing sandbox
            /////////////////
            $user = new User();
            $user->username = "BobRobbbbbb";
            $user->first_name = "Bobby";
            $user->last_name = "Ross";
            $user->password = "123";
            $user->save();

            // $user = User::find_by_id(5);
            // echo $user->username;
            // $user->delete();

            // $user = User::find_user_by_id(14);
            // echo $user->firstname;
            // $user->username = "Harriet";
            // $user->update();

            // $photos = Photo::find_all();
            // foreach($photos as $photo) {
            //     echo $photo->title;
            // }
            // $photo = new Photo();
            // $photo->title = "BobRob";
            // $photo->size = 20;
            // $photo->save();
            /////////////////
            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->