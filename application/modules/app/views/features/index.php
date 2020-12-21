<section class="featured">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 details">
                <h3>FEATURED</h3>
                <h5>LISTINGS</h5>
            </div>
            <?php if(count($projects) > 0) { ?>
                <?php $index = 0; foreach ($projects as $project) {
                    if($index != 0 && $index != 1) {?>
                        <div class="col-md-4 featured-next">
                            <div class="featured_image">
                                <img src="<?php echo $project['img'];?>" alt="">
                                <ul>
                                    <li class="dolor"><?php echo $project['price'];?></li>
                                    <li></li>
                                </ul>
                                <div class="overlay">
                                    <div class="text">
                                        <ul>
                                            <li><?php echo $project['fit'];?>/sq.ft <?php echo $project['fit1'];?> - <?php echo $project['fit2'];?> sq.ft</li>
                                            <li class="view"><a href="<?php echo $project['url'];?>">VIEW DETAILS</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-5">
                            <div class="featured_image">
                                <img src="<?php echo $project['img'];?>" alt="">
                                <ul>
                                    <li class="dolor"><?php echo $project['price'];?></li>
                                    <li></li>
                                </ul>
                                <div class="overlay">
                                    <div class="text">
                                        <ul>
                                            <li><?php echo $project['fit'];?>/sq.ft <?php echo $project['fit1'];?> - <?php echo $project['fit2'];?> sq.ft</li>
                                            <li class="view"><a href="<?php echo $project['url'];?>">VIEW DETAILS</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $index++;} ?>
            <?php } ?>
        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>
