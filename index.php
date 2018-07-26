<?php include("includes/header.php"); ?>
<?php $photos = Photo::find_all(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php foreach($photos as $photo) : ?>
                <div class="col-xs-6 col-md-3">
                    <a href="photo.php?id=<?php echo $photo->id ?>" class="thumbnail">
                        <img src="admin/<?php echo $photo->image_path();?>" class="home-page-photo img-responsive" alt="">
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
