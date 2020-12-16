<div class="content container-fluid">
    <form id="<?php echo $form['id'];?>" name="<?php echo $form['name'];?>" action="<?php echo $route;?>" method="post">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title"><?php echo $pageTitle;?></h4>
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
<!--                    <h3 class="card-title">Project Details</h3>-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entryTitle;?><span class="text-danger">*</span></label>
                                <input value="<?php echo $title;?>" name="title" class="form-control floating" type="text" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-focus">
                                <label class="control-label"><?php echo $entrySlug;?><span class="text-danger"></span></label>
                                <input value="<?php echo $slug;?>" name="slug" class="form-control floating" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo $entryHeading;?><span class="text-danger">*</span></label>
                                <textarea name="heading" rows="5" class="form-control" type="text" autocomplete="off" required><?php echo $heading;?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-focus select-focus">
                                <label class="control-label"><?php echo $entryStatus;?><span class="text-danger">*</span></label>
                                <select class="select form-control floating" name="status">
                                    <option value="1" <?php echo ($status == 1) ? "selected" : "" ;?>>Show</option>
                                    <option value="0" <?php echo ($status == 0) ? "selected" : "" ;?>>Off</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo $entryContent;?><span class="text-danger"></span></label>
                                <textarea name="content" rows="5" class="form-control summernote" type="text" autocomplete="off"><?php echo $content;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h3 class="card-title">Meta Data</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryMetaTitle;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $meta_title;?>" name="meta_title" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entryMetaDescription;?><span class="text-danger"></span></label>
                                    <textarea name="meta_description" rows="5" class="form-control floating" type="text" autocomplete="off"><?php echo $meta_description;?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entryMetaKeywords;?><span class="text-danger"></span></label>
                                    <textarea name="meta_keywords" rows="5" class="form-control floating" type="text" autocomplete="off"><?php echo $meta_keywords;?></textarea>
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
    myLabel.imageRow        = '<?php echo $imageRow;?>';
    myLabel.filemanager     = '<?php echo url('filemanager');?>';
    myLabel.placeholder     = '<?php echo $placeholder;?>';
</script>