<!----------------------social icon ------------------------->
<div class="right_icon">
    <ul>
        <li><i class="fa fa-facebook"></i></li>
        <li><i class="fa fa-twitter"></i></li>
        <li><i class="fa fa-linkedin"></i></li>
        <li><i class="fa fa-youtube-square"></i></li>
        <li><i class="fa fa-instagram"></i></li>
        <li><i class="fa fa-wifi"></i></li>
    </ul>
</div>
<!-- The Modal -->
<div class="modal register" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">


            <!-- Modal body -->
            <div class="modal-body" id="my-container">
                <div class="container signup-form">
                    <h2>REGISTRATION NOW</h2>
                    <form name="<?php echo $registerForm['name'];?>" id="<?php echo $registerForm['name'];?>" class="was-validated" action="<?php echo $registerForm['action'];?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" name="firstname" autocomplete="off" required>
<!--                            <div class="valid-feedback">Valid.</div>-->
<!--                            <div class="invalid-feedback">Please fill out this field.</div>-->
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="input-lastname" placeholder="Enter Lastname" name="lastname" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="input-email" placeholder="Email Address" name="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="input-password" placeholder="Enter password" name="password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="input-confirm" placeholder="Repeat password" name="confirm" autocomplete="off" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" id="input-agree" type="checkbox" name="agree" required>
                                I agree.
                            </label>
                        </div>
                        <button type="submit" class="btn send">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal register" id="myModal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="loginFormContainer">
                <div class="container loginForm">
                    <h2>SIGN IN</h2>
                    <form name="<?php echo $loginForm['name'];?>" id="<?php echo $loginForm['name'];?>" class="was-validated" action="<?php echo $loginForm['action'];?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="input-login-email" placeholder="Enter username" name="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="input-login-password" placeholder="Enter password" name="password" autocomplete="off" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" id="input-remember" type="checkbox" name="remember" <?php if(isset($_COOKIE["remember_me"])) { ?> checked <?php } ?>>
                                Remember Me.
                            </label>
                        </div>
                        <button type="submit" class="btn send">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------Banner ------------------------->
<section class="banner">
    <div id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo url();?>image/banner.jpg" alt="banner">
                <div class="carousel-caption">
                    <h3>SEARCH PENANG PROPERTY ANGEL LISTINGS</h3>
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div data-role="main" class="ui-content">
                                    <div data-role="rangeslider">
                                        <label for="price-min">PRICE:</label>
                                        <input type="range" name="price-min" id="price-min" value="0" min="0" max="1000" class="price">
                                        <!-- <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <select name="neighborhood" id="neighborhood" class="neighborhood">
                                    <option value="a">NEIGHBORHOOD</option>
                                    <option value="b">b</option>
                                    <option value="c">c</option>
                                    <option value="d">d</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <select name="bed" id="bed" class="bed">
                                    <option value="a">MIN BEDS</option>
                                    <option value="b">b</option>
                                    <option value="c">c</option>
                                    <option value="d">d</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <select name="bath" id="bath" class="bath">
                                    <option value="a">MIN BATHS</option>
                                    <option value="b">b</option>
                                    <option value="c">c</option>
                                    <option value="d">d</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control add" id="add" placeholder="SEARCH LISTING BY ADDRESS" name="address">
                            </div>
                        </div>
                        <button type="submit" class="btn search ">SEARCH</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!----------------------Featured ------------------------->
<section class="featured">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 details">
                <h3>FEATURED</h3>
                <h5>LISTINGS</h5>
                <a href="<?php echo url('/features');?>">View All Properties</a>
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
<!----------------------Handbook ------------------------->
<section class="handbook">
    <div class="container">
        <h2>PGPA HANDBOOK</h2>
        <?php if(count($handbooks) > 0) { ?>
            <div class="row">
                <?php foreach ($handbooks as $handbook) { ?>
                    <div class="col-md-3 col-12">
                        <div class="book">
                            <img src="<?php echo $handbook['img'];?>" alt="">
                            <h3><?php echo readMoreDots($handbook['name'],20);?></h3>
                            <a href="<?php echo $handbook['url'];?>">See More</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
<!----------------------Buy ------------------------->
<?php if(count($buyItems) > 0) { ?>
    <section class="buy_home">
        <div class="container">
            <h2>BUY</h2>
            <div class="row">
                <?php foreach ($buyItems as $buyItem) { ?>
                    <div class="col-md-6">
                        <div class="card">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?php echo url('image/'.$buyItem['img']);?>" alt="<?php echo $buyItem['title'];?>">
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title"><?php echo $buyItem['title'];?></h4>
                                <ul>
                                    <li>Location: <?php echo $buyItem['location'];?></li>
                                    <li>Land size: <?php echo $buyItem['landSize'];?> sqft</li>
                                    <li>Price: <?php echo $buyItem['price'];?></li>
                                    <li>Price/sqft: <?php echo $buyItem['perSqPrice'];?></li>
                                </ul>
                                <a href="<?php echo $buyItem['url'];?>" class="btn ">read more<i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                    </div>
               <?php } ?>
            </div>
<!--            <a href="#" class="home_more">MORE</a>-->
        </div>
    </section>
<?php } ?>

<!----------------------Rent ------------------------->


<?php if(count($rentItems) > 0) { ?>
    <section class="buy_home">
        <div class="container">
            <h2>Rent</h2>
            <div class="row">
                <?php foreach ($rentItems as $rentItem) { ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="<?php echo url('image/'.$rentItem['img']);?>" alt="<?php echo $rentItem['title'];?>">
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title"><?php echo $rentItem['title'];?></h4>
                                    <ul>
                                        <li>Location: <?php echo $rentItem['location'];?></li>
                                        <li>Land size: <?php echo $rentItem['landSize'];?> sqft</li>
                                        <li>Price: <?php echo $rentItem['price'];?></li>
                                        <li>Price/sqft: <?php echo $rentItem['perSqPrice'];?></li>
                                    </ul>
                                    <a href="<?php echo $rentItem['url'];?>" class="btn ">read more<i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--            <a href="#" class="home_more">MORE</a>-->
        </div>
    </section>
<?php } ?>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>
