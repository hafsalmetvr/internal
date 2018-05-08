<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1616") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("product_settings/edit_pro/" . $unit->ID), array("class" => "form-horizontal","id"=>"update_unit")) ?>
           
             <div class="form-group" id="namebox">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1620") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" value="<?php echo $unit->unit_name ?>" id="name-search">
                    <span  class="help-block"></span>
                </div>
            </div>
             <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1619") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="code" value="<?php echo $unit->unit_code ?>" id="code-search">
                    
                </div>
            </div>
<input type="submit" class="btn btn-primary form-control" id="unit_edit" value="<?php echo lang("ctn_1624") ?>">
<?php echo form_close() ?>
</div>
</div>


</div>

<script type="text/javascript">
   
    $('#unit_edit').click(function(e)
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
            $( "#update_unit" ).submit();
        }
    });

</script>