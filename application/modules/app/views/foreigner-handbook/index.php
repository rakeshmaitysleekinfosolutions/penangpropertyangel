<section class="handbook">
    <div class="container">
        <h2>PGPA HANDBOOK</h2>
        <?php if(count($handbooks) > 0) { ?>
        <div class="row">
            <?php foreach ($handbooks as $handbook) { ?>
            <div class="col-md-3 col-12">
                <div class="book">
                    <img src="<?php echo $handbook['img'];?>" alt="">
                    <h3><?php echo $handbook['name'];?></h3>
                    <a href="<?php echo $handbook['url'];?>">See More</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
            <h2>Record's Not Available!</h2>
        <?php } ?>
    </div>
</section>
