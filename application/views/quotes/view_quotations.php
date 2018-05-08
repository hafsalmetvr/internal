<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-folder-open"></span> <?php echo lang("ctn_1653") ?></div>
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
             <a href="<?php echo site_url("quotes/quotations") ?>"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><?php echo lang("ctn_1657") ?></button></a>
			
        </div>
    </div>
    
    <?php
		$CL = array('0' => 'None');
		foreach($clients->result() AS $r) {
			$CL[$r->ID] = $r->username;
		}
		
		$status = array(
			0 => 'Pending',
			1 => 'Accepted',
			2 => 'Rejected'
		);
		
		$css_status = array(
			0 => '#530c0c',
			1 => 'blue',
			2 => 'red'
		);
		
    ?>
    
    <div class="table-responsive">
        <table id="team-table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="table-header">
					<td>Sl</td>
                    <td><?php echo lang("ctn_1654") ?></td>
                    <td><?php echo lang("ctn_1655") ?></td>
                    <td><?php echo lang("ctn_1656") ?></td>
                    <td>Status</td>
                    <td><?php echo lang("ctn_52") ?></td>
                </tr>
            </thead>
            <tbody>
				<?php $sl = 1;foreach($quotes->result() as $r) { ?>
					<tr>
						<td><?=$sl?></td>
						<td><?=$r->date;?></td>
						<td><?=$r->id;?></td>
						<td><?=$CL[$r->client];?></td>
						<td style="color:<?=$css_status[$r->status];?>"><?=$status[$r->status];?></td>
						<td>
							<a href="<?php echo site_url("quotes") ?>/edit/<?=$r->id?>" class="btn btn-warning btn-xs" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit"><span class="glyphicon glyphicon-cog"></span></a>
							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-xs">Change Status</button>
								<button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="javascript:void();" onclick="changeStatus('<?=$r->id?>', 1);">Accepeted</a></li>
									<li><a href="javascript:void();" onclick="changeStatus('<?=$r->id?>', 2);">Rejected</a></li>
									<li><a href="javascript:void();" onclick="changeStatus('<?=$r->id?>', 0);">Pending</a></li>
								</ul>
							</div>	
						</td>
					</tr>
				<?php $sl++;} ?>
            </tbody>
        </table>
    </div>
</div>

<script>
	function changeStatus(id, status) {
	$.get("change_status/" + id + '/' + status, function(data, status){
		location.reload(); 
	});
}
</script>
