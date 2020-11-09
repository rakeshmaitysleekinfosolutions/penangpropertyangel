<div class="content container-fluid">
    <form id="<?php echo $form['id'];?>" name="<?php echo $form['name'];?>" action="<?php echo $route;?>" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title"><?php echo $title;?></h4>
            </div>
            <div class="col-sm-8 text-right m-b-30">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save & Update</button>
                <a href="<?php echo $back;?>" class="btn btn-primary"><i class="fa fa-back"></i> Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <?php if(hasMessage('message')) { ?>
                        <div class="alert alert-info alert-dismissible"><i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo getMessage('message');?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php } ?>
                    <h3 class="card-title">Basic Informations</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-img-wrap">
                                <a href="javascript:void(0);" id="thumb-image" data-toggle="image" class="" type="image"><img src="<?php echo $thumb;?>" alt="" title="" data-placeholder="<?php echo $placeholder;?>"/></a>
                                <input type="hidden" name="image" value="<?php echo $image;?>" id="input-image" />
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="control-label"><?php echo $entryFirstname;?><span class="text-danger">*</span></label>
                                            <input value="<?php echo $firstname;?>" name="firstname" class="form-control floating"  type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="control-label"><?php echo $entryLastname;?><span class="text-danger">*</span></label>
                                            <input value="<?php echo $lastname;?>" name="lastname" class="form-control floating"  type="text" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="control-label"><?php echo $entryBirthday;?><span class="text-danger"></span></label>
                                            <input value="<?php echo $birthday;?>" name="birthday" class="form-control floating datetimepicker"  type="text" placeholder="dd-mm-yyyy" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus select-focus">
                                            <label class="control-label"><?php echo $entryGender;?></label>
                                            <select class="select form-control floating" name="gender">
                                                <option value="">Select Gendar</option>
                                                <option value="Male" <?php echo ($gender == 'Male') ? "selected" : "" ;?>>Male</option>
                                                <option value="Female" <?php echo ($gender == 'Female') ? "selected" : "" ;?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-focus">
                                            <label class="control-label"><?php echo $entryUsername;?><span class="text-danger">*</span></label>
                                            <input value="<?php echo $email;?>" name="email" id="email" class="form-control floating" type="email" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box">
                    <h3 class="card-title">Password Informations</h3>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryNric;?></label>
                                    <input value="<?php echo $nric;?>" name="nric" class="form-control floating" type="text" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryOccupation;?><span class="text-danger"></span></label>
                                    <input value="<?php echo $occupation;?>" name="occupation" class="form-control floating" type="text" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryPassword;?> <span class="text-danger">*</span></label>
                                    <input placeholder="<?php echo $entryPassword;?>" class="form-control floating" type="password" name="password" id="input-password" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryConfirmPassword;?><span class="text-danger">*</span></label>
                                    <input placeholder="<?php echo $entryConfirmPassword;?>" class="form-control floating" type="password" name="confirm" id="input-confirm" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box">
                    <h3 class="card-title">Contact Informations</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryAddress;?><span class="text-danger"></span></label>
                                <input value="<?php echo $address_1;?>" name="address_1" class="form-control floating" value="" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryCountry;?><span class="text-danger"></span></label>
                                <select name="country_id" class="form-control floating">
                                    <?php if(!empty($countries)) {
                                        foreach ($countries as $country) {?>
                                            <option value="<?php echo $country->id;?>" <?php echo ($country_id == $country->id) ? "selected" : "";?>><?php echo $country->name;?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryState;?><span class="text-danger"></span></label>
                                <select name="state_id" class="form-control floating"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryZipcode;?><span class="text-danger"></span></label>
                                <input value="<?php echo $postcode;?>" name="postcode" class="form-control floating" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryCity;?><span class="text-danger"></span></label>
                                <input value="<?php echo $city;?>" name="city" class="form-control floating" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryTelephone;?><span class="text-danger"></span></label>
                                <input value="<?php echo $phone;?>" name="phone" class="form-control floating" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryMobile;?><span class="text-danger"></span></label>
                                <input value="<?php echo $mobile;?>" name="mobile" class="form-control floating" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryFax;?></label>
                                <input value="<?php echo $fax;?>" name="fax" class="form-control floating" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryStatus;?> <span class="text-danger">*</span></label>
                                <select name="status" class="select floating" id="input-payment-status" autocomplete="off" required>
                                    <option value="0">Inactive</option>
                                    <option value="1" selected>Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<script>
    //var myLabel             = myLabel || {};
    //myLabel.baseUrl         = '<?php //echo base_url();?>//';
    //myLabel.users           = '<?php //echo admin_url('agent/onLoadDatatableEventHandler');?>//';
    //myLabel.updateStatus    = '<?php //echo admin_url('agent/onChangeStatusEventHandler');?>//';
    //myLabel.delete          = '<?php //echo admin_url('agent/delete');?>//';
    //myLabel.states          = '<?php //echo admin_url('agent/states');?>//';
    //myLabel.edit            = '<?php //echo admin_url('agent/edit/');?>//';
</script>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
    myLabel.states          = '<?php echo url('agent/states');?>';
    myLabel.filemanager     = '<?php echo url('filemanager');?>';
    myLabel.state_id        = '<?php echo $state_id;?>';
</script>