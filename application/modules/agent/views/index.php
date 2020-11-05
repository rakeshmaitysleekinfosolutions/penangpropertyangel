<div class="content container-fluid">
    <div class="row">
        <?php if(hasMessage('message')) { ?>
            <div class="alert alert-info alert-dismissible"><i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo getMessage('message');?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <?php if(getWarning('message')) { ?>
            <div class="alert alert-warning alert-dismissible"><i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo getWarning('message');?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title"><?php echo $title;?></h4>
        </div>

        <div class="col-sm-8 text-right m-b-30">
            <button type="button" class="btn btn-primary" id="delete"><i class="fa fa-trash"></i> Delete</button>
            <a href="<?php echo $addLink;?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table" id="agentTable">
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
    myLabel.agents           = '<?php echo url('agent/onLoadDatatableEventHandler');?>';
    myLabel.updateStatus    = '<?php echo url('agent/onChangeStatusEventHandler');?>';
    myLabel.delete          = '<?php echo url('agent/delete');?>';
    myLabel.states          = '<?php echo url('agent/states');?>';
    myLabel.edit            = '<?php echo url('agent/edit/');?>';
</script>