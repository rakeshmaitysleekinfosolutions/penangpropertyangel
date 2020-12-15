<section class="r_list">
    <div class="container">
        <h2>RENT LISTING</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="row" id="render-filter-data">
                    <?php if(count($items) > 0) {
                        foreach ($items as $item) { ?>
                                <div class="col-md-6 col-12">
                                    <div class="rent_list_image">
                                        <a href="<?php echo $item['url'];?>"><img src="<?php echo $item['img'];?>" alt="<?php echo $item['title'];?>"></a>
                                        <p><?php echo readMore($item['title'],100, $options = array('href' => $item['url'],'class' => ''));?></p>
                                        <h3><span><?php echo $item['price'];?></span> per month <?php echo $item['area'];?></h3>
                                    </div>
                                </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-md-12">
                            <div class="rent_list_image">
                                <h3><span>No record(s) found.</span></h3>
                            </div>
                        </div>
                    <?php } ?>


<!--                    <div class="pagination">-->
<!--                        <a href="#">Previous</a>-->
<!--                        <a href="#">1</a>-->
<!--                        <a class="active" href="#">2</a>-->
<!--                        <a href="#">3</a>-->
<!--                        <a href="#">Next</a>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="side_form">
                    <form action="<?php echo url('item/filter');?>" method="post" id="frm-rent-filter">
                        <input type="hidden" value="<?php echo $type;?>" name="type">
                        <input type="hidden" value="<?php echo $slug;?>" name="slug">
                        <?php if(count($bedrooms1) > 0) { ?>
                            <div class="rent_listing_form">
                                <select name="bedroom1" id="bedroom1">
                                    <option value="">Bedroom</option>
                                    <?php foreach ($bedrooms1 as $bedroom1) { ?>
                                        <option value="<?php echo $bedroom1;?>"><?php echo $bedroom1;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <?php if(count($bedrooms2) > 0) { ?>
                            <div class="rent_listing_form">
                                <select name="bedroom2" id="bedroom2">
                                    <option value="">Bedroom</option>
                                    <?php foreach ($bedrooms2 as $bedroom2) { ?>
                                        <option value="<?php echo $bedroom2;?>"><?php echo $bedroom2;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <?php if(count($states) > 0) { ?>
                            <div class="rent_listing_form">
                                <select name="state_id" id="state_id">
                                    <option value="">parent state</option>
                                    <?php foreach ($states as $state) { ?>
                                        <option value="<?php echo $state->id;?>"><?php echo $state->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="rent_listing_form">
                            <select name="childstate_id" id="childstate_id">
                                <option value="">child state</option>
                            </select>
                        </div>
<!--                        <div class="rent_listing_checkbox">-->
<!--                            <label for="property">Tenanted Properties</label>-->
<!--                            <input type="checkbox" id="property" name="property" value="property">-->
<!--                        </div>-->

                        <div class="ui-content">
                            <div>
                                <label for="price-min">Floor Area (sq.ft.)</label>
                                <div id="area-range" name="rangeInput"></div>
                                <ul>
                                    <li><input type="number" min=0 max="999999999" oninput="validity.valid||(value='0');" id="min_area" name="min_area" class="price-range-field" /></li>
                                    <li><input type="number" min=0 max="999999999" oninput="validity.valid||(value='10000');" id="max_area" name="max_area" class="price-range-field" /></li>
                                </ul>
                            </div>
                        </div>
                        <div data-role="main" class="ui-content">
                            <div data-role="rangeslider">
                                <label for="price-min">PRICE RANGE (MYR)</label>
                                <div id="price-range" class="price-filter-range" name="rangeInput"></div>
                                <ul>
                                    <li><input type="number" min=1 max="999999999" oninput="validity.valid||(value='1');" id="min_price" name="min_price" class="price-range-field" /></li>
                                    <li><input type="number" min=1 max="999999999" oninput="validity.valid||(value='999999999');" id="max_price" name="max_price" class="price-range-field" /></li>
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn reset" id="btn-reset">Reset</button>
                        <button type="submit" class="btn search" >Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
    myLabel.childStates     = '<?php echo url('item/childstate');?>';
</script>