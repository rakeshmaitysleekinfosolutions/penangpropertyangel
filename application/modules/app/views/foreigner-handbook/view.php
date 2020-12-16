<div class="top_para">
    <p><?php echo $handbook['name'];?></p>
</div>
<section class="cell_property">
    <div class="container-fluid">
        <div class="row">
            <div class="<?php echo (count($handbooks) > 0) ? 'col-md-9' : 'col-md-12';?>">
                <div class="cell_details handbook-details">
<!--                    <h5>--><?php //echo $handbook['name'];?><!--</h5>-->
                    <div class="cell_details_para">
                        <p><?php echo $handbook['small_description'];?></p>
                    </div>
                    <div class="sell_para">
                        <p><?php echo $handbook['long_description'];?></p>
                    </div>
                </div>
            </div>
            <?php if(count($handbooks) > 0) {?>
                <div class="col-md-3 col-12">
                    <div class="side_details remove-line">
                        <?php foreach ($handbooks as $value) {?>
                            <div class="col-md-12 col-12">
                                <div class="book">
                                    <img src="<?php echo $value['img'];?>" alt="">
                                    <h3><?php echo $value['name'];?></h3>
                                    <a href="<?php echo $value['url'];?>">See More</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>