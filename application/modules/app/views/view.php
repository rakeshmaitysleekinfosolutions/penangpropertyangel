<!----------------------Feature page------------------------->
<div class="top_para">
    <p><?php echo $project['name'];?></p>
</div>
<!----------------------fADE SLIDER ------------------------->
<!--<section class="fade_slider">-->
<!--    <div class="fade_slide_div">-->
<!--        <div class="container-fluid fade_div">-->
<!--            <div class="row">-->
<!--                --><?php //if(count($project['images']) > 0) {?>
<!--                    <div col-md-12>-->
<!--                        <div class="image_fade">-->
<!--                            --><?php //foreach ($project['images'] as $image) { ?>
<!--                                <img src="--><?php //$image['image'];?><!--" alt="" id="fade_img">-->
<!--                            --><?php //} ?>
<!--                            <h5>Sale Ends: 0 Day</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--                <h3>--><?php //echo $project['name'];?><!--</h3>-->
<!--                <div class="list_price">-->
<!--                    <ul>-->
<!--                        <li class="li_first"><span>--><?php //echo $project['price'];?><!--</span> --><?php //echo $project['fit'];?><!--/sq.ft</li>-->
<!--                        <li>--><?php //echo $project['fit1'];?><!-- - --><?php //echo $project['fit2'];?><!-- sq.ft</li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <p>--><?php //echo $project['description'];?><!--</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</section>-->


<!----------------------fADE SLIDER ------------------------->
    <section class="fade_slider">
        <div class="fade_slide_div">
          <div class="container-fluid fade_div">
            <div class="row">
                <?php if(count($project['images']) > 0) {?>
                    <div col-md-12>
                        <div class="row owl-carousel owl-theme features-banner-images">
                            <?php $index = 1; foreach ($project['images'] as $image) { ?>
                                <div class="item <?php echo ($index ==1) ? 'active' : '';?>">
                                    <img src="<?php echo resize($image['image'],1473, 600);?>" alt="<?php echo $project['name'];?>">
                                    <div class="carousel-caption">
                                        <h3>Sale Ends: 0 Day</h3>
                                    </div>
                                </div>
                            <?php
                            $index++;
                            } ?>
                        </div>
                    </div>
                <?php } ?>
                <h3><?php echo $project['name'];?></h3>
                <div class="list_price">
                    <ul>
                        <li class="li_first"><span><?php echo $project['price'];?></span> <?php echo $project['fit'];?>/sq.ft</li>
                        <li><?php echo $project['fit1'];?> - <?php echo $project['fit2'];?> SQ.FT</li>
                    </ul>
                </div>
                <p><?php echo $project['description'];?></p>
            </div>
          </div>
        </div>
        
      </section>

<!----------------------button ------------------------->

<?php if(count($project['subProjects']) > 0) { ?>
<section class="button_feature">
    <?php foreach ($project['subProjects'] as $subProject) { ?>
        <button type="button" class="btn sub-project" data-sub_project_id="<?php echo $subProject['id'];?>" id="btn_<?php echo $subProject['id'];?>"><?php echo $subProject['name'];?></button>
    <?php } ?>
</section>
<section class="feature_slider">
    <div class="f_slider_start">
        <?php foreach ($project['subProjects'] as $subProject) { ?>
            <div class="fea_div<?php echo $subProject['id'];?>">
                <h2><?php echo $subProject['name'];?></h2>
                <div class="owl-carousel owl-theme feature-banner-images">
                    <?php $images = array();$images = $subProject->images($subProject['id']);if(count($images) > 0) { ?>
                        <?php foreach ($images as $image) { ?>
                            <div class="item">
                                <img src="<?php echo resize($image['image'],1473, 600);?>" alt="<?php echo $subProject['name'];?>" height="500px" width="100%">
                            </div>
                            <?php
                            $index++;
                        } ?>
                    <?php } ?>
                </div>
                <p><?php echo $subProject['description'];?></p>
            </div>
        <?php } ?>
    </div>
</section>
<!----------------------feature_slider ------------------------->
<?php } ?>
<!----------------------feature- details ------------------------->
<section class="feature_details">
    <div class="fea_detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="snap_shot">
                        <h4>Snapshot</h4>
                        <?php echo $project['snapshot'];?>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="fea_ture">
                        <h4>Features</h4>
                        <?php echo $project['features'];?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
    myLabel.fetchSubProject    = '<?php echo url('fetchSubProject');?>';
</script>