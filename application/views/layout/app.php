<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php echo $this->template->meta; ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>image/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php echo base_url();?>image/favicon.png">
    <title>Penang Property Angel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url();?>dist/index.css">
    <?php echo $this->template->stylesheet; ?>
</head>
<body>
<!----------------------Header ------------------------->
<header>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="<?php echo url('/');?>"><img src="<?php echo url('image/logo_1.png');?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">FEATURES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('buy/');?>">BUY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('rent/');?>">RENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('agents');?>">AGENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SELL/LEASE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">BLOG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FOREIGNER'S HANDBOOK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ABOUT</a>
                </li>
                <li class="nav-item con_none">
                    <a class="nav-link con_none_a" href="#">CONTACT</a>
                </li>
            </ul>
            <ul class="navbar-nav icon">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-envelope-o"></i></a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="dropdown-menu">
                        <?php if(isLogged()) {?>
                            <a class="dropdown-item logoutBtn" href="javascript:void(0);" onclick="return logout();"><i class="fas fa-sign-out-alt"></i>LOGOUT</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">REGISTRATION</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal_1">LOGIN</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php echo $this->template->content; ?>
<!----------------------Footer ------------------------->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <ul>
                    <li><a href="">FEATURES</a></li>
                    <li><a href="">BUY</a></li>
                    <li><a href="">RENT</a></li>
                    <li><a href="">AGENTS</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-12">
                <ul>
                    <li><a href="">SELL/LEASE</a></li>
                    <li><a href="">BLOG</a></li>
                    <li><a href="">FOREIGNER'S HANDBOOK</a></li>
                    <li><a href="">ABOUT</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-12 footer_1">
                <ul>
                    <li><a href="">CONTACT</a></li>
                    <li><a href="">PRIVACY POLICY</a></li>
                    <li><a href="">TERMS & CONDITIONS</a></li>

                </ul>
            </div>
            <div class="col-md-3 col-12 footer_2">
                <img src="<?php echo url('image/footer_1.png');?>" alt="">
            </div>
        </div>
    </div>
</footer>
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <p><i class="fa fa-copyright"></i> Copyright 2010 penangpropertyangel.com</p>
            </div>
            <div class="col-md-6 col-12 power">
                <p>powered by<img src="<?php echo url('image/footer_2.png');?>" alt=""></p>
            </div>
        </div>
    </div>
</section>
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
<script src="<?php echo base_url();?>dist/index.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php echo $this->template->javascript; ?>
<script>
    var myLabel = myLabel || {};
    myLabel.baseUrl = '<?php echo base_url();?>';
    function logout () {
        window.location.href = myLabel.baseUrl + 'logout';
        // return true or false, depending on whether you want to allow the `href` property to follow through or not
    }
</script>
</body>
</html>