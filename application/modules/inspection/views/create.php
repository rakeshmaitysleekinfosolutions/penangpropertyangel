<div class="content container-fluid">
    <form id="<?php echo $form['id'];?>" name="<?php echo $form['name'];?>" action="<?php echo $route;?>" method="post">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title"><?php echo $title;?></h4>
            </div>
            <div class="col-sm-8 text-right m-b-30">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $btnSave;?></button>
                <a href="<?php echo $back;?>" class="btn btn-primary"><i class="fa fa-back"></i> <?php echo $btnBack;?></a>
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
                    <h3 class="card-title">Inspection Details</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-focus select-focus">
                                    <label class="control-label"><?php echo $entryAgent;?><span class="text-danger">*</span></label>
                                    <select class="select form-control floating" name="agent_id" required>
                                        <?php if(count($agents)) {
                                            foreach ($agents as $agent) {
                                                $selected = '';
                                                if($agent_id == $agent->id){
                                                    $selected = 'selected';
                                                }?>
                                                <option value="<?php echo $agent->id;?>" <?php echo $selected;?>><?php echo $agent->firstname." ".$agent->lastname;?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryName;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $name;?>" name="name" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryDate;?><span class="text-danger"></span></label>
                                    <input value="<?php echo $date;?>" name="date" class="form-control floating datetimepicker"  type="text" placeholder="dd-mm-yyyy" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryTime;?><span class="text-danger"></span></label>
                                    <input value="<?php echo $time;?>" name="time"  class="form-control floating timepicker"  type="text" placeholder="00:00am" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryContact;?><span class="text-danger"></span></label>
                                    <input value="<?php echo $contact;?>" name="contact" class="form-control floating" type="text" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryEmail;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $email;?>" name="email" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entryRemarks;?></label>
                                    <textarea name="remarks" rows="5" class="form-control floating" type="text" autocomplete="off"><?php echo $remarks;?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>