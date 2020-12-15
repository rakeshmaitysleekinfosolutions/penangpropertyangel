<div class="top_para">
    <?php if(count($breadcrumbs) > 0) {?>
        <p>
            <?php foreach ($breadcrumbs as $breadcrumb) {?>
                <a href="<?php echo $breadcrumb['href'];?>"><?php echo $breadcrumb['text'];?>&nbsp;|</a>
            <?php } ?>
        </p>
    <?php } ?>
</div>
<section class="cell_property">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="cell_details">
                    <?php if($item['images'] > 0) {?>
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $index = 1; foreach ($item['images'] as $image) { ?>
                                    <div class="carousel-item <?php echo ($index ==1) ? 'active' : '';?>">
                                        <img src="<?php echo resize($image['image'],864, 450);?>" alt="">
                                    </div>
                                    <?php $index++;} ?>
                            </div>
                        </div>
                    <?php } ?>
                    <h5><?php echo $item['title'];?></h5>
                    <div class="list_price_sell">
                        <ul>
                            <li class="li_first_sell"><span><?php echo $item['type'];?> <?php echo $item['price'];?></span></li>
                            <li><button type="button" class="btn btn-dark">ADD TO WISHLIST</button></li>
                        </ul>
                    </div>
                    <ul>
                        <li>Title: <?php echo $item['hold'];?></li>
                        <li>Bedroom: <?php echo $item['bedroom'];?></li>
                        <li>Bathroom: <?php echo $item['bathroom'];?></li>
                        <li>Built-up Area: <?php echo $item['area'];?></li>
                    </ul>
                    <div class="cell_details_para">
                        <p><?php echo $item['small_description'];?></p>
                    </div>
                    <div class="sell_para">
                        <p><?php echo $item['long_description'];?></p>
                    </div>
                    <?php if($item['images'] > 0) {?>
                            <form action="<?php echo url('download-all-files');?>" method="post" id="download-all-files">
                                <?php foreach ($item['images'] as $image) { ?>
                                    <input type="hidden" name="files[]" value="<?php echo url('image/'.$image['image']);?>">
                                <?php } ?>
                                <button type="submit" class="btn down" id="download-all-files-btn">DOWNLOAD ALL PHOTOS</button>
                            </form>
                    <?php } ?>

                    <a href="<?php echo $item['youtube_link'];?>" class="youtube">Youtube link</a></li>
                </div>
                <?php if($item['map']) {?>
                <div class="map">
                    <?php echo $item['map'];?>
                    <p>
                        Lebuh Tunku Kudin 3, Metro-East, Gelugor, Penang</p>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-4 col-12">
                <div class="side_details">
                    <div class="row">
                        <?php
                        $agentName      = '';
                        $agentEmail     = '';
                        $agentMobile    = '';
                        $agentId        = '';
                        $agentImage     = resize('no_image.png', 111,111);

                        if(!empty($item['agent'])) {
                            $agentName      =  (isset($item['agent']->firstname)) ? $item['agent']->firstname.' '.$item['agent']->lastname : '';
                            $agentEmail     =  (isset($item['agent']->email)) ? $item['agent']->email : '';
                            $agentMobile    =  (isset($item['agent']->mobile)) ? $item['agent']->mobile : '';
                            $agentId        =  (isset($item['agent']->id)) ? $item['agent']->id : '';
                            $agentImage     =  (isset($item['agent']->image)) ? resize($item['agent']->image, 111,111) : resize('no_image.png', 111,111);
                        } ?>
                        <div class="col-md-8">
                            <ul>
                                <li>Realtor: <?php echo $agentName;?></li>
                                <li>Mobile: <?php echo $agentMobile;?></li>
                                <li>Email:<?php echo $agentEmail;?></li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <img src="<?php echo $agentImage;?>" alt="<?php echo $agentName;?>">
                        </div>

                    </div>
                </div>
                <div class="side_details_form">
                    <h3>0 Inspection arranged</h3>
                    <h6>Inspect Unit</h6>
                    <div id="message"></div>
                    <form action="<?php echo url('inspection-arranged');?>" method="post" id="inspection-arranged">
                        <input type="hidden" value="<?php echo $agentId;?>" name="agent_id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="inspection-arranged-datetime" placeholder="Date(mm/dd/yyyy)" name="datetime" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inspection-arranged-name" placeholder="Name" name="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="contact" class="form-control" id="inspection-arranged-contact" placeholder="Contact No" name="contact" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="inspection-arranged-email" placeholder="Email" name="email" required autocomplete="off">
                        </div>

<!--                        <div class="g-recaptcha" data-sitekey="6Ld9EAYaAAAAADFBgp7WvOJ8DmwqhlEHUVOnxYfC"></div>-->
<!--                        <br>-->
                        <div class="form-group">
                            <img src="<?php echo $builder->inline();?>" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inspection-arranged-verification" placeholder="Enter Captcha Code" name="code" required autocomplete="off">
                        </div>
                        <button type="submit" class="btn notify" id="inspection-arranged-btn">Notify PGPA</button>
                    </form>
                </div>
                <div class="side_details_image">
                    <?php if(count($related_item) > 0) {?>
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $index = 1; foreach ($related_item['images'] as $image) { ?>
                                    <div class="carousel-item <?php echo ($index ==1) ? 'active' : '';?>">
                                        <img src="<?php echo resize($image['image'],864, 450);?>" alt="">
                                        <div class="carousel-caption">
                                            <p><?php echo $related_item['title'];?></p>
                                        </div>
                                    </div>
                                    <?php $index++;} ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="side_details_form1">
                    <h3>Loan Calculator</h3>
                    <h6>We will attend to you within 24 hours</h6>
                    <form>
                        <div class="form-group">
                            <label for="email">Loan Amount</label>
                            <input type="text" class="form-control" id="amount" onchange="calculate();">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Down Payment</label>
                            <input type="down" class="form-control" id="down-payment" onchange="calculate();">
                        </div>
                        <div class="form-group">
                            <label for="email">Interest Rate</label>
                            <input type="text" class="form-control" placeholder="4.25%" id="apr" onchange="calculate();">
                        </div>
                        <div class="form-group">
                            <label for="email">Loan Period (Years)</label>
                            <select id="years" onchange="calculate();">
                                <option value=""></option>
                                <?php for($i = 1; $i <=45; $i++) {?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Payment Amount</label>
                            <input type="text" class="form-control" id="payment">
                        </div>
                        <button type="button" class="btn form_reset" onclick="resetCalculator();">RESET</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>