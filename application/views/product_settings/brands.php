<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1633") ?></div>
        <div class="db-header-extra form-inline"> 
            <div class="btn-group">
                <div class="dropdown">
                   
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="<?php echo site_url("team") ?>"><?php echo lang("ctn_845") ?></a></li>
                    </ul>

                </div>
            </div>
            <div class="form-group has-feedback no-margin">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_354") ?>" id="form-search-input" />
                    <div class="input-group-btn">
                        <input type="hidden" id="search_type" value="0">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
                          <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_355") ?></a></li>
                          <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> <?php echo lang("ctn_356") ?></a></li>
                          <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="user-exact"></span> <?php echo lang("ctn_357") ?></a></li>
                          <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="role-exact"></span> <?php echo lang("ctn_360") ?></a></li>
                        </ul>
                    </div><!-- /btn-group -->
                </div>
            </div>
             <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><?php echo lang("ctn_1637") ?></button>

        </div>
    </div>
    <div class="table-responsive">
        <table id="team-table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="table-header"><td><?php echo lang("ctn_1634") ?></td><td><?php echo lang("ctn_1635") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
                <?php foreach($brands->result() as $r) : ?>
                <tr><td><?php echo $r->brand_code ?></td><td><?php echo $r->brand_name ?></td><td><a href="<?php echo site_url("product_settings/edit_brand/" . $r->ID) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_55") ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> <a href="<?php echo site_url("product_settings/delete_brand/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" title="<?php echo lang("ctn_57") ?>"  data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
                <?php endforeach; ?>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1638") ?></h4>
        </div>

        <div class="modal-body ui-front">
            <?php echo form_open(site_url("product_settings/add_brand"), array("class" => "form-horizontal","id"=>"add_brand")) ?>
            
             <div class="form-group" id="namebox">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1635") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" value="" id="name-search">
                    <span  class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1634") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="code" value="" id="code-search">
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1636") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="url" value="" id="url-search">
                </div>
            </div>
            
             
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
            <input type="submit" class="btn btn-primary" id="brand_add" value="<?php echo lang("ctn_1638") ?>">
            <?php echo form_close() ?>
        </div>
  
    </div>
  </div>
</div>


<script type="text/javascript">
   
    $('#brand_add').click(function(e)
    {
        e.preventDefault(); 
        var base_url='http://erp.qzolve.com';
        var Name =   $("[name='name']").val().trim();
        var a=0;
        if(Name.length > 0){

            $.ajax({
                type: 'GET',
                url: base_url+"/product_settings/checkuniquebrand/"+Name, 
                dataType: 'json',
                success: function (data) {

                if(data.status==true) { 
                    a=0; 
                    $( "#namebox" ).addClass( "has-error" ); 
                    $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">The name already taken.</label>');
                }
                else if(data.status==false){ 
                    a=1; 
                    $( "#namebox" ).removeClass( "has-error" );
                    $("#namebox .help-block").html(' '); 

                }
               if(a==1){
                    $( "#add_brand" ).submit();
                }


                },


               
            });
            
        }
        else{
            a=0; 
            $( "#namebox" ).addClass( "has-error" ); 
            $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        if(a==1){
            $( "#add_category" ).submit();
        }
    });

</script>




 