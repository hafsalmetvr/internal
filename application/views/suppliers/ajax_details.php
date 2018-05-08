
    <?php if($update) : ?><?php echo form_open(site_url("suppliers/update_user/" . $user->ID), array("id" => "invoice_form")) ?><?php endif; ?>

    <div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_429") ?></label>
        <input type="text" class="form-control input-sm" name="address_line_1" value="<?php echo $user->address_1 ?>" <?php if(!$update) : ?>disabled<?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_430") ?></label>
        <input type="text" class="form-control input-sm" name="address_line_2" value="<?php echo $user->address_2 ?>" <?php if(!$update) : ?>disabled<?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_431") ?></label>
        <input type="text" class="form-control input-sm" name="city" value="<?php echo $user->city ?>" <?php if(!$update) : ?>disabled<?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_432") ?></label>
        <input type="text" class="form-control input-sm" name="state" value="<?php echo $user->state ?>" <?php if(!$update) : ?>disabled<?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_433") ?></label>
        <input type="text" class="form-control input-sm" name="zipcode" value="<?php echo $user->zipcode ?>" <?php if(!$update) : ?>disabled<?php endif; ?>>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_434") ?></label>
        <input type="text" class="form-control input-sm" name="country" value="<?php echo $user->country ?>" <?php if(!$update) : ?>disabled<?php endif; ?>>
    </div>

  </div><div class="col-md-6">
    <div class="form-group">
        <p><strong><?php echo lang("ctn_1540") ?></strong>: <?php echo $user->username ?></p>
        <p><strong><?php echo lang("ctn_24") ?></strong>: <?php echo $user->email ?></p>
        <?php if($role->num_rows() > 0) : ?>
                <?php $role = $role->row(); ?>
            <p><strong><?php echo lang("ctn_322") ?></strong>: <?php echo $role->name ?></p>
        <?php endif; ?>
        <p><strong><?php echo lang("ctn_1541") ?></strong>: <?php echo $supplier_detail->company_phone_number ?></p>
        <p><strong><?php echo lang("ctn_1532") ?></strong>: <?php echo $supplier_detail->contact_person_name ?></p>
         <p><strong><?php echo lang("ctn_1543") ?></strong>: <?php echo $supplier_detail->contact_person_number ?></p>
          <p><strong><?php echo lang("ctn_1544") ?></strong>: <?php echo $supplier_detail->contact_person_email ?></p>
          <p><strong><?php echo lang("ctn_1546") ?></strong>: <?php echo $supplier_detail->vat_id ?></p>
          <p><strong><?php echo lang("ctn_1116") ?></strong>: <?php echo $supplier_detail->address ?></p>
        <p><strong><?php echo lang("ctn_1547") ?></strong>: <?php echo $supplier_detail->web_url ?></p>
    </div>
    <hr>

  </div>

<?php if($update) : ?>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_13") ?>">
<?php echo form_close() ?><?php endif; ?>