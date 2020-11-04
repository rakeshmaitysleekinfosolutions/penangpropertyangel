<div class="content container-fluid">
    <div class="row">
        <?php if(hasMessage('warning')) { ?>
            <div class="alert alert-success alert-dismissible"><i class="fa fa-exclamation-circle"></i><?php echo getMessage('warning');?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title"><?php echo $title;?></h4>
        </div>

        <div class="col-sm-8 text-right m-b-30">
            <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
            <a href="<?php echo $addLink;?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table ">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 2%;">
                            <label class="css-control css-control-primary css-checkbox py-0">
                                <input type="checkbox" class="css-control-input" id="checkAll" name="checkAll">
                                <span class="css-control-indicator"></span>
                            </label>
                        </th>
                        <?php if(count($columns)) {
                            foreach ($columns as $column) {?>
                                <th><?php echo $column;?></th>
                            <?php } ?>
                        <?php } ?>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
</div>

<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
    myLabel.users           = '<?php echo admin_url('agent/onLoadDatatableEventHandler');?>';
    myLabel.updateStatus    = '<?php echo admin_url('agent/onChangeStatusEventHandler');?>';
    myLabel.delete          = '<?php echo admin_url('agent/delete');?>';
    myLabel.states          = '<?php echo admin_url('agent/states');?>';
    myLabel.edit            = '<?php echo admin_url('agent/edit/');?>';
</script>