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
                    <h3 class="card-title">Project Details</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryName;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $name;?>" name="name" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entrySlug;?><span class="text-danger"></span></label>
                                    <input value="<?php echo $slug;?>" name="slug" class="form-control floating" type="text" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryFit;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $fit;?>" name="fit" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryFit1;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $fit1;?>" name="fit1" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryFit2;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $fit2;?>" name="fit2" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryPrice;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $price;?>" name="price" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entrySequence;?><span class="text-danger">*</span></label>
                                    <input value="<?php echo $sequence;?>" name="sequence" class="form-control floating" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label"><?php echo $entryDate;?><span class="text-danger"></span></label>
                                    <input value="<?php echo $date;?>" name="date" class="form-control floating datetimepicker"  type="text" placeholder="dd-mm-yyyy" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus select-focus">
                                    <label class="control-label"><?php echo $entrySlider;?><span class="text-danger">*</span></label>
                                    <select class="select form-control floating" name="slider">
                                        <option value="1" <?php echo ($slider == 1) ? "selected" : "" ;?>>Show</option>
                                        <option value="0" <?php echo ($slider == 0) ? "selected" : "" ;?>>Off</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus select-focus">
                                    <label class="control-label"><?php echo $entryStatus;?><span class="text-danger">*</span></label>
                                    <select class="select form-control floating" name="status">
                                        <option value="1" <?php echo ($status == 1) ? "selected" : "" ;?>>Show</option>
                                        <option value="0" <?php echo ($status == 0) ? "selected" : "" ;?>>Off</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h3 class="card-title">Description</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entryRemarks;?></label>
                                    <textarea name="remarks" rows="5" class="form-control floating" type="text" autocomplete="off"><?php echo $remarks;?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entrySmallDescription;?><span class="text-danger"></span></label>
                                    <textarea name="small_description" rows="5" class="form-control floating" type="text" autocomplete="off"><?php echo $small_description;?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entryLongDescription;?><span class="text-danger"></span></label>
                                    <textarea name="long_description" rows="5" class="form-control floating" type="text" autocomplete="off"><?php echo $long_description;?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entrySnapshot;?><span class="text-danger"></span></label>
                                    <textarea name="snapshot" rows="5" class="form-control floating summernote" type="text" autocomplete="off"><?php echo $snapshot;?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $entryFeatures;?><span class="text-danger"></span></label>
                                    <textarea name="features" rows="5" class="form-control floating summernote" type="text" autocomplete="off"><?php echo $features;?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="card-box">
                    <h3 class="card-title">Slider Images</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="images" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <th>
                                        Slider Image
                                    </th>
                                    <tr>
                                        <td class="text-left">Image</td>
                                        <td>Set Thumbnail</td>
                                        <td>Sort Order</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $imageRow = 0;
                                    if($images) {
                                        foreach ($images as $image) {?>
                                            <tr id="image-row<?php echo $imageRow;?>">
                                                <td class="text-left">
                                                    <a href="" type="image" id="thumb-image<?php echo $imageRow;?>" data-toggle="image" class="img-thumbnail">
                                                        <img src="<?php echo $image['thumb'];?>" alt="" title="" data-placeholder="<?php echo $placeholder;?>>"/>
                                                    </a>
                                                    <input type="hidden" name="images[<?php echo $imageRow;?>][image]" value="<?php echo $image['thumb'];?>" id="input-image<?php echo $imageRow;?>>"/>
                                                </td>
                                                <td>
                                                    <input type="radio" name="images[][thumbnail]" <?php echo ($image[$imageRow]['thumbnail']) ? "checked" : "";?>>
                                                </td>
                                                <td>
                                                    <input type="text" name="images[<?php echo $imageRow;?>][sort_order]" data-placeholder="Sort Order">
                                                </td>
                                                <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $imageRow;?>').remove();" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                            </tr>
                                        <?php } ?>
                                        <?php $imageRow++; }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-left"><button type="button" data-toggle="tooltip" title="Add" class="btn btn-primary addImage"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                    </tfoot>
                                </table>
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