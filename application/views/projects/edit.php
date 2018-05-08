<script type="text/javascript">
$(document).ready(function() {
CKEDITOR.replace('project-description', { height: '100'});
});
</script>
<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_766") ?></div>
    <div class="db-header-extra">
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("projects/edit_project_pro/" . $project->ID), array("class" => "form-horizontal")) ?>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_767") ?></label>
        <div class="col-md-8 ui-front">
            <input type="text" class="form-control" name="name" value="<?php echo $project->name ?>">
        </div>
</div>

<div class="form-group">
    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1434") ?></label>
    <div class="col-md-8">
        <select name="userid" class="form-control">
            <option value="">Please Select</option>
                <?php foreach($clients->result() as $r) : ?>
                    <option value="<?php echo $r->ID ?>" <?php if($r->ID == $project->userid) echo "selected" ?>><?php echo $r->username ?></option>
                <?php endforeach; ?>
        </select>
    </div>
</div>
 <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1559") ?></label>
                    <div class="col-md-8">
                        <select name="vendorid" class="form-control">
                            <option value="">Please Select</option>
                            <?php foreach($vendors->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>" <?php if($r->ID == $project->vendorid) echo "selected" ?>><?php echo $r->username ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1696") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="project_at" value="<?php echo $project->project_at ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1697") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="project_value" value="<?php echo $project->project_value ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1698") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="purchase_order_no" value="<?php echo $project->purchase_order_no ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_644") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control datepicker input-sm" name="start_date" value="<?php echo date("Y/m/d", strtotime($project->start_date)); ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_645") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control datepicker input-sm" name="end_date" value="<?php echo date("Y/m/d", strtotime($project->end_date)); ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1719") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="project_in_charge" value="<?php echo $project->project_in_charge ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1677") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="buyer" value="<?php echo $project->buyer ?>">
                    </div>
            </div>
             <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1720") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control datepicker input-sm" name="po_date" value="<?php echo date("Y/m/d", strtotime($project->po_date)); ?>">
                    </div>
            </div>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_768") ?></label>
        <div class="col-md-8 ui-front">
        	<img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $project->image ?>" class="user-icon" />
            <input type="file" class="form-control" name="userfile">
            <span class="help-block"><?php echo lang("ctn_769") ?></span>
        </div>
</div>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_770") ?></label>
        <div class="col-md-8">
            <textarea name="description" id="project-description"><?php echo $project->description ?></textarea>
        </div>
</div>
<div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_771") ?></label>
                    <div class="col-md-8">
                        <input type="text" name="complete" class="form-control" value="<?php echo $project->complete ?>" >
                        <span class="help-block"><?php echo lang("ctn_772") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_773") ?></label>
                    <div class="col-md-8">
                        <input type="checkbox" name="complete_sync" value="1" <?php if($project->complete_sync) : ?>checked<?php endif; ?> >
                        <span class="help-block"><?php echo lang("ctn_774") ?></span>
                    </div>
            </div>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_775") ?></label>
        <div class="col-md-8">
            <select name="catid" class="form-control">
            <?php foreach($categories->result() as $r) : ?>
            	<option value="<?php echo $r->ID ?>" <?php if($r->ID == $project->catid) echo "selected" ?>><?php echo $r->name ?></option>
            <?php endforeach; ?>
            </select>
        </div>
</div>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_776") ?></label>
        <div class="col-md-8">
            <select name="status" class="form-control">
                <option value="0"><?php echo lang("ctn_777") ?></option>
                <option value="1" <?php if($project->status == 1) echo "selected" ?>><?php echo lang("ctn_778") ?></option>
            </select>
        </div>
</div>
<h4><?php echo lang("ctn_779") ?></h4>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_780") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="calendar_id" value="<?php echo $project->calendar_id ?>">
                        <span class="help-block"><?php echo lang("ctn_781") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_782") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control jscolor" name="calendar_color" value="<?php echo $project->calendar_color ?>">
                    </div>
            </div>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_783") ?>">
<?php echo form_close() ?>
</div>
</div>


</div>