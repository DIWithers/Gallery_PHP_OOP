<?php include("includes/header.php"); ?>
<?php 
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 4;
    $items_total_count = Photo::count_all();
    $paginate = new Paginate($page, $items_per_page, $items_total_count);
    $sql = "SELECT * FROM photos ";
    $sql .= "LIMIT {$items_per_page} ";
    $sql .= "OFFSET {$paginate->offset()}";
    $photos = Photo::run_query($sql);
?>
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
        <div class="row">
            <ul class="pager">
                <?php 
                    if ($paginate->page_total() > 1) {
                        if ($paginate->has_next()) echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                        if ($paginate->has_previous()) echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    } 
                ?>
            </ul>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
