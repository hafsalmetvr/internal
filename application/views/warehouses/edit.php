<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1600") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("warehouses/edit_pro/" . $warehouses->ID), array("class" => "form-horizontal","id"=>"update_warehouse")) ?>
<div class="form-group" id="namebox">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1614") ?></label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="name" value="<?php echo $warehouses->name ?>">
                        <span  class="help-block"></span>
                    </div>
            </div>
            <div class="form-group" >
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1607") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="manager" value="<?php echo $warehouses->manager ?>" id="manager-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1608") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="charge" value="<?php echo $warehouses->in_charge ?>" id="charge-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1609") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="phone" value="<?php echo $warehouses->phone ?>" id="phone-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1610") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="location" value="<?php echo $warehouses->location ?>" id="location-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1611") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="rack" value="<?php echo $warehouses->total_rack ?>" id="rack-search">
                </div>
            </div>
             <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1612") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="space" value="<?php echo $warehouses->space_available ?>" id="space-search">
                </div>
            </div>
             <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1613") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="store" value="<?php echo $warehouses->store_keeper ?>" id="store-search">
                </div>
            </div>
<input type="submit" class="btn btn-primary form-control" id="edit_warehouse" value="<?php echo lang("ctn_1625") ?>">
<?php echo form_close() ?>
</div>
</div>


</div>


<script type="text/javascript">

    $('#edit_warehouse').click(function(e)
    {
       e.preventDefault(); 
       var Name =   $("[name='name']").val().trim();
        var a=0;
        if(Name.length > 0){
            a=1; 
            $( "#namebox" ).removeClass( "has-error" );
            $("#namebox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#namebox" ).addClass( "has-error" ); 
            $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        if(a==1){
            $( "#update_warehouse" ).submit();
        }
   });
    
</script>