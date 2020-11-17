<div class="content container-fluid">
    <form id="<?php echo $form['id'];?>" name="<?php echo $form['name'];?>" action="<?php echo $route;?>" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <div class="row">
            <?php if(hasMessage('message')) { ?>
                <div class="alert alert-success alert-dismissible"><i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo getMessage('message');?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php } ?>
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title"><?php echo $heading;?></h4>
            </div>
            <div class="col-sm-8 text-right m-b-30">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <a href="<?php echo $back;?>" class="btn btn-primary"><i class="fa fa-back"></i> Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h3 class="page-title"><?php echo $title;?></h3>
                    <div class="row">
                        <div class="col-sm-3 col-lg-3">
                            <div class="form-group">

                                <a href="javascript:void(0);" id="thumb-image" data-toggle="image" class="" type="image"><img src="<?php echo $thumb;?>" alt="" title="" data-placeholder="<?php echo $placeholder;?>"/></a>
                                <input type="hidden" name="image" value="<?php echo $image;?>" id="input-image" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $entryFirstname;?><span class="text-danger">*</span></label>
                                <input placeholder="<?php echo $entryFirstname;?>" value="<?php echo $firstname;?>" name="firstname" class="form-control"  type="text" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $entryLastname;?><span class="text-danger">*</span></label>
                                <input placeholder="<?php echo $entryLastname;?>" value="<?php echo $lastname;?>" name="lastname" class="form-control"  type="text" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $entryUsername;?><span class="text-danger">*</span></label>
                                <input placeholder="<?php echo $entryUsername;?>" value="<?php echo $email;?>" name="email" id="email" class="form-control" type="email" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo $entryPassword;?> <span class="text-danger">*</span></label>
                                <input placeholder="<?php echo $entryPassword;?>" class="form-control floating" type="password" name="password" id="input-password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo $entryConfirmPassword;?><span class="text-danger">*</span></label>
                                <input placeholder="<?php echo $entryConfirmPassword;?>" class="form-control floating" type="password" name="confirm" id="input-confirm" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $entryGender;?></label>
                                <input <?php echo ($gender === 'Male') ? : "checked" ;?> type="radio" name="gender" value="Male"> Male
                                <input <?php echo ($gender === 'Female') ? : "checked" ;?> type="radio" name="gender" value="Female"> Female
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $entryBirthday;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $datePlaceholder;?>" value="<?php echo $birthday;?>" name="birthday" class="form-control datetimepicker"  type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $entryNric;?></label>
                                <input placeholder="<?php echo $entryNric;?>" value="<?php echo $nric;?>" name="nric" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $entryTelephone;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $entryTelephone;?>" value="<?php echo $phone;?>" name="phone" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryMobile;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $entryMobile;?>" value="<?php echo $mobile;?>" name="mobile" class="form-control " type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryFax;?></label>
                                <input placeholder="<?php echo $entryFax;?>" value="<?php echo $fax;?>" name="fax" class="form-control " type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryOccupation;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $entryOccupation;?>" value="<?php echo $occupation;?>" name="occupation" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryAddress;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $entryAddress;?>" value="<?php echo $address_1;?>" name="address_1" class="form-control" value="" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryCountry;?><span class="text-danger"></span></label>
                                <select name="country_id" class="form-control">
                                    <?php if(!empty($countries)) {
                                        foreach ($countries as $country) {?>
                                            <option value="<?php echo $country->id;?>" <?php echo ($country_id == $country->id) ? "selected" : "";?>><?php echo $country->name;?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryState;?><span class="text-danger"></span></label>
                                <select name="state_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryCity;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $entryCity;?>" value="<?php echo $city;?>" name="city" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label><?php echo $entryZipcode;?><span class="text-danger"></span></label>
                                <input placeholder="<?php echo $entryZipcode;?>" value="<?php echo $postcode;?>" name="postcode" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
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