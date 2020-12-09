<section class="buy">
    <div class="container">
        <h2>BUY</h2>
        <div class="row">
            <?php if(count($categories) > 0){ ?>
                <?php foreach ($categories as $category) { ?>
                    <div class="col-md-4 col-12 buy_category">
                        <div class="buy_1">
                            <h3><?php echo $category['name'];?></h3>
                            <div class="trans_box">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <h3>Category Not Available</h3>
            <?php } ?>
        </div>
    </div>
</section>