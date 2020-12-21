<section class="buy">
    <div class="container">
        <h2>RENT</h2>
        <div class="row">
            <?php if(count($categories) > 0){ ?>
                <?php foreach ($categories as $category) { ?>
                    <div class="col-md-4 col-12 buy_category">
                        <div class="trans_box">
                            <img src="<?php echo $category['img'];?>" alt="<?php echo $category['name'];?>">
                            <a href="<?php echo $category['url'];?>"><h3><?php echo $category['name'];?></h3></a>
                            <!-- <div class="trans_box">
                            </div> -->
                        </div>
                    </div>

                <?php } ?>
            <?php } else { ?>
                <h3>Category Not Available</h3>
            <?php } ?>
        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>
