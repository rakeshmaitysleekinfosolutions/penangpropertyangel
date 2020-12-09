<!----------------------compare page------------------------->
<div class="top_para">
    <h2>COMPARE PROPERTIES</h2>
    <h4>Compare ELYSIAN vs Bhaiji RV Panchajanya vs Prestige lvy League</h4>
</div>

<!----------------------compare-div page------------------------->
<section class="compare-div">
    <div class="container-fluid">
        <div class="row">
            <?php if($compare1 || $compare2 || $compare3) { ?>
            <div class="col-md-3 col-12 campare_detail_div">
                <h4><i class="fa fa-home"></i> Specifications</h4>
                <ul>
                    <li>Sq.Ft From - Sq.Ft To</li>
                    <li>Price/RM/Sq.Ft</li>
                    <li>Snapshot</li>
                    <li>Features</li>
                </ul>
            </div>
            <?php } ?>
            <div class="col-md-3 col-12 campare_detail_div">
                <?php if(count($projects) > 0) { ?>
                    <select name="compare1" id="compare1" class="product-dropdown">
                        <option value="">select option</option>
                        <?php
                        foreach ($projects as $project) { ?>
                            <option <?php echo (isset($compare1['id']) && $compare1['id'] == $project->id) ? 'selected' : '';?> value="<?php echo $project->id;?>"><?php echo $project->name;?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <?php if(count($compare1)) { ?>
                    <div id="product1">
                        <img src="<?php echo $compare1['img'];?>" alt="">
                        <h5><?php echo $compare1['name'];?></h5>
<!--                        <h3>#189 - ELYSIAN</h3>-->
                        <ul>
                            <li><?php echo $compare1['fit1'];?> - <?php echo $compare1['fit2'];?> sq.ft</li>
                            <li><button type="btn" class="dark_btn"><?php echo $compare1['price'];?>/sq.ft</button></li>
                            <li><?php echo $compare1['snapshot'];?></li>
                            <li><?php echo $compare1['features'];?></li>
                        </ul>
                        <a href="<?php echo $compare1['url'];?>" class="view">View Project</a>
                    </div>
                <?php } ?>

            </div>
            <div class="col-md-3 col-12 campare_detail_div">
                <?php if(count($projects) > 0) { ?>
                    <select name="compare2" id="compare2" class="product-dropdown">
                        <option value="">select option</option>
                        <?php
                        foreach ($projects as $project) { ?>
                            <option <?php echo (isset($compare2['id']) && $compare2['id'] == $project->id) ? 'selected' : '';?> value="<?php echo $project->id;?>"><?php echo $project->name;?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <?php if(count($compare2)) { ?>
                    <div id="product2">
                        <img src="<?php echo $compare2['img'];?>" alt="">
                        <h5><?php echo $compare2['name'];?></h5>
                        <!--                        <h3>#189 - ELYSIAN</h3>-->
                        <ul>
                            <li><?php echo $compare2['fit1'];?> - <?php echo $compare2['fit2'];?> sq.ft</li>
                            <li><button type="btn" class="dark_btn"><?php echo $compare2['price'];?>/sq.ft</button></li>
                            <li><?php echo $compare2['snapshot'];?></li>
                            <li><?php echo $compare2['features'];?></li>
                        </ul>
                        <a href="<?php echo $compare2['url'];?>" class="view">View Project</a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3 col-12 campare_detail_div">
                <?php if(count($projects) > 0) { ?>
                    <select name="compare3" id="compare3" class="product-dropdown">
                        <option value="">select option</option>
                        <?php
                        foreach ($projects as $project) { ?>
                            <option <?php echo (isset($compare3['id']) && $compare3['id'] == $project->id) ? 'selected' : '';?> value="<?php echo $project->id;?>"><?php echo $project->name;?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <?php if(count($compare3)) { ?>
                    <div id="product2">
                        <img src="<?php echo $compare3['img'];?>" alt="">
                        <h5><?php echo $compare3['name'];?></h5>
                        <!--                        <h3>#189 - ELYSIAN</h3>-->
                        <ul>
                            <li><?php echo $compare3['fit1'];?> - <?php echo $compare3['fit2'];?> sq.ft</li>
                            <li><button type="btn" class="dark_btn"><?php echo $compare3['price'];?>/sq.ft</button></li>
                            <li><?php echo $compare3['snapshot'];?></li>
                            <li><?php echo $compare3['features'];?></li>
                        </ul>
                        <a href="<?php echo $compare3['url'];?>" class="view">View Project</a>
                    </div>
                <?php } ?>
            </div>



        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
    myLabel.addCompare      = '<?php echo url('compare/add/');?>';
    myLabel.removeCompare   = '<?php echo url('compare/remove');?>';
</script>