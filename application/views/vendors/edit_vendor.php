<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1550") ?></div>
    <div class="db-header-extra">
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("vendors/edit_vendor_pro/" . $users->ID), array("class" => "form-horizontal")) ?>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1553") ?></label>
        <div class="col-md-8 ui-front">
            <input type="text" class="form-control" name="vendorname" value="<?php echo $users->username ?>">
        </div>
</div>
<div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1558") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="vendorno" value="<?php echo $vendors->vendor_number ?>" id="vendorno-search">
                </div>
</div>

<div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1551") ?></label>
                    <div class="col-md-8 ui-front">
                         <select name="typeid" class="form-control">
                            <option value="">Please Select</option>
                            <?php foreach($types->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>" <?php if($r->ID == $vendors->vendor_type){echo 'selected';} ?>><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
             <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1540") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cmpnynme" value="<?php echo $vendors->company_name ?>" id="cmpnynme-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1531") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="phone" value="<?php echo $vendors->phone_number ?>" id="phone-search" >
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_24") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email"  id="email-search" value="<?php echo $users->email ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1532") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cperson"  id="cperson-search" value="<?php echo $vendors->contact_person_name ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1533") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cpersonphone"  id="cpersonphone-search" value="<?php echo $vendors->contact_person_number ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1534") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="position" id="position-search" value="<?php echo $vendors->contact_person_position ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1555") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="vat"  id="vat-search" value="<?php echo $vendors->vendor_vat_id ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1116") ?></label>
                <div class="col-md-8">
                    <textarea class="form-control" name="address"  id="address-search"><?php echo $vendors->address ?></textarea>
                </div>
            </div>
            
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_1557") ?>">
<?php echo form_close() ?>
</div>
</div>


</div>