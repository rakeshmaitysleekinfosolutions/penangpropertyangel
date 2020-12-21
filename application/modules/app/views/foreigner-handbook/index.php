<section class="handbook">
    <div class="container">
        <h2>PGPA HANDBOOK</h2>
        <?php if(count($handbooks) > 0) { ?>
        <div class="row owl-carousel owl-theme handbook-slider">
            <?php $index = 1; foreach ($handbooks as $handbook) { ?>
                <div class="item">
                    <div class="book">
                        <img src="<?php echo $handbook['img'];?>" alt="">
                        <h3><?php echo $handbook['name'];?></h3>
                        <a href="<?php echo $handbook['url'];?>">See More</a>
                    </div>
                </div>
                <?php
                $index++;
            } ?>
        </div>
        <?php } else { ?>
            <h2>Record's Not Available!</h2>
        <?php } ?>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>