<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-credit-card"></span> Purchase Orders </div>
    <div class="db-header-extra form-inline"> 

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
          <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="invoiceid-exact"></span> <?php echo lang("ctn_588") ?></a></li>
          <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="title-exact"></span> <?php echo lang("ctn_589") ?></a></li>
          <li><a href="#" onclick="change_search(4)"><span class="glyphicon glyphicon-ok no-display" id="client-exact"></span> <?php echo lang("ctn_591") ?></a></li>
          <li><a href="#" onclick="change_search(5)"><span class="glyphicon glyphicon-ok no-display" id="project-exact"></span> <?php echo lang("ctn_593") ?></a></li>
        </ul>
      </div><!-- /btn-group -->
</div>
</div>

<?php
	foreach($projects->result() as $r) {
		$prjts[$r->ID] = $r->name;
	}
	
	foreach($supplier->result() as $r) {
		$supr[$r->ID] = $r->username;
	}
	
?>
   
<?php if($this->common->has_permissions(array("admin", "project_admin", "invoice_manage"), $this->user)) : ?>
    <a href="<?php echo site_url("purchases/order_add") ?>" class="btn btn-primary btn-sm">Add Purchase Order</a>
  <?php endif; ?>
</div>
</div>

<div class="table-responsive">
<table id="invoices-table" class="table small-text table-bordered table-striped table-hover">
<thead>
<tr class="table-header">
	<td>Sl</td>
	<td>Date</td>
	<td>Project</td>
	<td>Supplier</td>
	<td>Delivery Date</td>
	<td>Options</td>
</tr>
</thead>
<tbody>
	<?php $sl = 1;foreach($orders->result() as $r) { ?>
		<tr>
			<td><?=$sl;?></td>
			<td><?=date('m/d/Y',$r->time);?></td>
			<td><?=$prjts[$r->project]?></td>
			<td><?=$supr[$r->supplier]?></td>
			<td>
				<?php 
					$d = date('m/d/Y',$r->delivery_date);
					if ($d != '01/01/1970') {
						echo $d;
					}
				?>
			</td>
			<td>
				<a href="" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">View</a>
				<a href="" class="btn btn-warning btn-xs" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit"><span class="glyphicon glyphicon-cog"></span></a>
				<a href="" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this PO?')" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
			</td>
		</tr>
	<?php $sl++;} ?>
</tbody>
</table>
</div>

</div>
