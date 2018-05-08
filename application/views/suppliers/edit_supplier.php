<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1525") ?></div>
    <div class="db-header-extra">
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("suppliers/edit_supplier_pro/" . $users->ID), array("class" => "form-horizontal")) ?>
<div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1549") ?></label>
        <div class="col-md-8 ui-front">
            <input type="text" class="form-control" name="companyname" value="<?php echo $users->username ?>">
        </div>
</div>

<div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1527") ?></label>
                    <div class="col-md-8 ui-front">
                         <select name="typeid" class="form-control">
                            <option value="">Please Select</option>
                            <?php foreach($types->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>" <?php if($r->ID == $suppliers->supplier_type){echo 'selected';} ?>><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
           <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1541") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="phone" value="<?php echo $suppliers->company_phone_number ?>" id="phone-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1542") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" value="<?php echo $users->email ?>" id="email-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1532") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cperson" value="<?php echo $suppliers->contact_person_name ?>" id="cperson-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1543") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cpersonphone" value="<?php echo $suppliers->contact_person_number ?>" id="cpersonphone-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1544") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cemail" value="<?php echo $suppliers->contact_person_email ?>" id="cemail-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1546") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="vat" value="<?php echo $suppliers->vat_id ?>" id="vat-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1116") ?></label>
                <div class="col-md-8">
                    <textarea class="form-control" name="address"  id="address-search"><?php echo $suppliers->address ?></textarea>
                </div>
            </div>
             <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1547") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="web_url" value="<?php echo $suppliers->web_url ?>" id="web_url-search">
                </div>
            </div>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_1557") ?>">
<?php echo form_close() ?>
</div>
</div>


</div>