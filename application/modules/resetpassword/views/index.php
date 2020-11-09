<div class="content container-fluid" id="my-container">
    <form id="<?php echo $form['id'];?>" action="<?php echo $route;?>" method="post">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card-box" id="containerBox">
                    <h3 class="card-title"><?php echo $title;?></h3>
                    <div class="experience-box frmResetPassword">
                        <div class="form-group">
                            <label><?php echo $entryOldPassword;?></label>
                            <input id="input-old" name="old" type="password" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label><?php echo $entryPassword;?></label>
                            <input id="input-password" name="password" type="password" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label><?php echo $entryConfirmPassword;?></label>
                            <input id="input-confirm" name="confirm" type="password" class="form-control" required/>
                        </div>
                        <button type="submit" id="btnReset" class="btn btn-primary"><i class="fa fa-save"></i> Reset</button>
                    </div>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>

    </form>
</div>

<script>
    var myLabel = myLabel || {};
    myLabel.baseUrl = '<?php echo base_url();?>';

</script>