<div class="account-page">
    <div class="container">
        <h3 class="account-title"><?php echo $title;?></h3>

        <div class="account-box" >
            <div class="account-wrapper" id="containerBox">

                <div class="account-logo">
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.png" alt="Focus Technologies"></a>
                </div>

                <form class="adminLoginForm" action="<?php echo $route; ?>" method="post" id="<?php echo $form;?>" name="<?php echo $form;?>">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control floating" type="text" name="email" id="email" required autocomplete="off"">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input class="form-control floating" type="password" name="password" required autocomplete="off" >
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-block account-btn" type="submit" id="loginButton" >Log In</button>
                    </div>
                    <!-- <div class="text-center">
                        <a href="forgot-password.html">Forgot your password?</a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>