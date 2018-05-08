<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1755") ?></div>
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
             <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><?php echo lang("ctn_1760") ?></button>

        </div>
    </div>
    <div class="table-responsive">
        <table id="team-table" class="table table-bordered table-striped table-hover">
            <thead>
		<tr class="table-header"><td><?php echo lang("ctn_1758") ?></td><td><?php echo lang("ctn_1755") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
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
            <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1756") ?></h4>
        </div>
        <div class="modal-body ui-front">
            <?php echo form_open(site_url("clients/add_client"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1758") ?></label>
                    <div class="col-md-8 ui-front">
                         <select name="typeid" class="form-control">
                            <option value="">Please Select</option>
                            <?php foreach($expense_cats as $r) : ?>
                              
                            <?php endforeach; ?>
                        </select>
                    </div>
	    </div>
            <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1755") ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="clientname" value="" id="clientname-search">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
            <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_1759") ?>">
            <?php echo form_close() ?>
        </div>
  
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var st = $('#search_type').val();
        var table = $('#team-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [
          [1, "asc" ]
        ],
        "columns": [
        null,
        null,
        { "orderable": false },
    ],
        "ajax": {
            url : "<?php echo site_url("projects/expense_head_page/" . $page ) ?>",
            type : 'GET',
            data : function ( d ) {
                d.search_type = $('#search_type').val();
            }
        },
        "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
});
    });
</script>

 
