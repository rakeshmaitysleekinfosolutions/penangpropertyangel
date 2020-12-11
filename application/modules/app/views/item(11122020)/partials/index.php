<?php if(count($items) > 0) {
    foreach ($items as $item) { ?>
        <div class="col-md-6 col-12">
            <div class="rent_list_image">
                <img src="<?php echo $item['img'];?>" alt="<?php echo $item['title'];?>">
                <p><?php echo $item['title'];?></p>
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
