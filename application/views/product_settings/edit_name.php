<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1643") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("product_settings/edit_pro_name/" . $name->ID), array("class" => "form-horizontal","id"=>"update_name")) ?>
           
             <div class="form-group" id="namebox">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1644") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name_en" value="<?php echo $name->name_english ?>" id="name-search">
                    <span  class="help-block"></span>
                </div>
            </div>
             <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1645") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name_ar" value="<?php echo $name->name_arabic ?>" id="code-search">
                    
                </div>
            </div>
<input type="submit" class="btn btn-primary form-control" id="name_edit" value="<?php echo lang("ctn_1648") ?>">
<?php echo form_close() ?>
</div>
</div>


</div>

<script type="text/javascript">
   
    $('#name_edit').click(function(e)
    {
        e.preventDefault(); 
        var Name =   $("[name='name_en']").val().trim();
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
            $( "#update_name" ).submit();
        }
    });

</script>