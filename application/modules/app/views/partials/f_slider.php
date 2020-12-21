<?php if ($project)  { ?>
    <div class="fea_div<?php echo $project['id'];?>">
        <h2><?php echo $project['name'];?></h2>
        <div class="row owl-carousel owl-theme features-banner-images">
            <?php $images = array();$images = $project->images($project['id']);if(count($images) > 0) { ?>
                <?php foreach ($images as $image) { ?>
                    <div class="item">
                        <img src="<?php echo resize($image['image'],1473, 600);?>" alt="<?php echo $project['name'];?>" height="500px" width="100%">
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <p><?php echo $project['description'];?></p>
    </div>
<?php } ?>