<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-credit-card"></span> Purchase Management </div>
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
   
<?php if($this->common->has_permissions(array("admin", "project_admin", "invoice_manage"), $this->user)) : ?>
    <a href="<?php echo site_url("purchases/order_add") ?>" class="btn btn-primary btn-sm"> Add Purchases </a>
  <?php endif; ?>
</div>
</div>

<?php
	foreach($supplier->result() as $r) {
		$supr[$r->ID] = $r->username;
	}
	
?>

<div class="table-responsive">
<table id="invoices-table" class="table small-text table-bordered table-striped table-hover">
<thead>
<tr class="table-header">
	<td>Sl</td>
	<td>Date</td>
	<td>Bill No</td>
	<td>Supplier</td>
	<td>Bill Amount</td>
	<td>Options</td>
</tr>
</thead>
<tbody>
	<?php $sl = 1;foreach($purchases->result() AS $res) { ?>
		<tr>
			<td><?=$sl;?></td>
			<td><?=date('d/m/Y', $res->time);?></td>
			<td><?=$res->id;?></td>
			<td><?=$supr[$res->supplier];?></td>
			<td><?=$res->total_amount;?></td>
			<td>
				<a onclick="addS('<?=$res->id;?>');" href="javascript:void(0);" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View"> Add </a>
			</td>
		</tr>
	<?php $sl++;} ?>
</tbody>
</table>
</div>

</div>



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Purchase Management</h4>
        </div>
        <?php echo form_open(site_url("products/purchase_management"), array("id" => "order_form")) ?>
        <div class="modal-body" style="padding:0;">
          <table class="table table-hover">
			<thead>
				<tr>
					<th>Sl</th>
					<th width="5%;">Item</th>
					<th>Unit</th>
					<th>Qty</th>
					<th>P Price/Unit</th>
					<th>Item/Qty</th>
					<th>P Price/Item</th>
					<th>S Price/Unit</th>
				</tr>
			</thead>
			<tbody class="tbdy"> 
			
			</tbody>
          </table>
        </div>
        <div class="modal-footer">
			<button type="submit" class="btn btn-primary" name="add_product" value="1"><i class="icon-save"></i> Add Product</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form> 
      </div>
    </div>
  </div>
</div>


<script>
	function addS(id) {
		$.get( "get_purchase_items?id="+id, function( data ) {
			$('.tbdy').html(data);
			$("#myModal").modal();
		});
	}
</script>
