<section class="agent">
    <div class="container">
        <h2>AGENTS LIST</h2>
        <div class="row">
            <?php if(count($agents) > 0){ ?>
                <?php foreach ($agents as $agent) { ?>
                    <div class="col-md-4 col-12">
                        <div class="agent_div">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="<?php echo $agent['img'];?>" alt="">
                                </div>
                                <div class="col-md-6 agent_details">
                                    <h3><?php echo $agent['name'];?></h3>
                                    <h5><?php echo $agent['phone'];?><br>
                                        <?php echo $agent['email'];?>
                                    </h5>
                                    <a href="" class="click_agent">Click to View Listings</a>
                                </div>
                            </div>
                         </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <h3>Agent Not Available</h3>
            <?php } ?>
        </div>
    </div>
</section>