<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1643") ?></div>
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
             <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><?php echo lang("ctn_1647") ?></button>

        </div>
    </div>
    <div class="table-responsive">
        <table id="team-table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="table-header"><td><?php echo lang("ctn_1644") ?></td><td><?php echo lang("ctn_1645") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
                <?php foreach($names->result() as $r) : ?>
                <tr><td><?php echo $r->name_english ?></td><td><?php echo $r->name_arabic ?></td><td><a href="<?php echo site_url("product_settings/edit_name/" . $r->ID) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_55") ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> <a href="<?php echo site_url("product_settings/delete_name/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" title="<?php echo lang("ctn_57") ?>"  data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
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
            <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1646") ?></h4>
        </div>

        <div class="modal-body ui-front">
            <?php echo form_open(site_url("product_settings/add_name"), array("class" => "form-horizontal","id"=>"add_name")) ?>
            
             <div class="form-group" id="namebox">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1644") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name_en" value="" id="name-search">
                    <span  class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1645") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name_ar" value="" id="name-search">
                </div>
            </div>
            
             
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
            <input type="submit" class="btn btn-primary" id="name_add" value="<?php echo lang("ctn_1646") ?>">
            <?php echo form_close() ?>
        </div>
  
    </div>
  </div>
</div>


<script type="text/javascript">
   
    $('#name_add').click(function(e)
    {
        e.preventDefault(); 
        var base_url='http://erp.qzolve.com';
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
            $( "#add_name" ).submit();
        }
    });

</script>




 