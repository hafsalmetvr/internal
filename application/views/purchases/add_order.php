<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-credit-card"></span> Add Purchase Order </div>
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

</div>
</div>



</div>
<?php echo form_open(site_url("purchases/order_add"), array("id" => "order_form")) ?>
<div class="white-area-content content-separator clearfix" id="invoice-items-area">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleInputEmail1" class="light-label">Supplier</label>
				<select name="supplier" class="form-control input-sm" id="projects">
					<?php foreach($supplier->result() as $r) { ?>
						<option value="<?php echo $r->ID;?>"><?php echo $r->username;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleInputEmail1" class="light-label">Projects</label>
				<select name="project" class="form-control input-sm" id="projects">
					<?php foreach($projects->result() as $r) { ?>
						<option value="<?php echo $r->ID;?>"><?php echo $r->name;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleInputEmail1" class="light-label">Delivery Before</label>
				<input type="text" class="form-control input-sm datepicker" id="delivery_before" name="delivery_before" value="<?=date('m/d/Y');?>"/>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="exampleInputEmail1" class="light-label">Delivery At</label>
				<input type="text" class="form-control input-sm datepicker" id="delivery_at" name="delivery_at" value="<?=date('m/d/Y');?>"/>
			</div>
		</div>
		
		
		
	</div>
</div>


<div class="white-area-content content-separator clearfix" id="invoice-items-area">
	<h3 class="invoice-heading">Purchase Items</h3>
	
	
	
	<div id="invoice-items">
		<div class="invoice-item small-text" id="invoice-item-1">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1448") ?></label>
					<p><input type="text" name="item_name_1" id="item_name_1" class="form-control input-sm" placeholder="<?php echo lang("ctn_616") ?>"></p>
					<p><input type="text" name="item_desc_1" id="item_desc_1" class="form-control input-sm" placeholder="<?php echo lang("ctn_1449") ?>"></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1450") ?></label>
						<input type="text" name="item_price_1" id="item_price_1" class="form-control itemchange input-sm" placeholder="0.00">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_617") ?></label>
						<input type="text" name="item_quantity_1" id="item_quantity_1" class="form-control itemchange input-sm" placeholder="0.00">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_619") ?></label>
						<p id="item_total_1">0.00</p>
						<p><input type="checkbox" name="save_1" id="save_1" value="1"> <?php echo lang("ctn_1451") ?> </p>
						<p><button type="button" class="btn btn-danger btn-xs" onclick="remove_item(1)"><span class="glyphicon glyphicon-trash"></span></button></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="item_error_count"></div>

	<input type="hidden" name="items_count" id="items_count" value="1">

	<hr>

	<p><button class="btn btn-default btn-sm" id="add_item"><span class="glyphicon glyphicon-plus"></span></button> <button id="add_itemdb" class="btn btn-info btn-sm"><?php echo lang("ctn_1452") ?></button>
</div>

<div class="white-area-content content-separator clearfix">
	
<h3 class="invoice-heading"><?php echo lang("ctn_624") ?></h3>


<div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_624") ?></label>
                    <div class="col-md-8">
                        <table class="table table-bordered table-hover">
                        <tr><td><strong><?php echo lang("ctn_625") ?></strong></td><td><div id="sub_total">0.00</div></td></tr>
                        <!--<tr><td><div id="tax_name_1_area"><strong><?php echo lang("ctn_626") ?></strong></div></td><td><div id="tax_amount_1">0%</div><div id="tax_total_amount_1">0.00</div></td></tr>-->
                        <!--<tr><td><div id="tax_name_2_area"><strong><?php echo lang("ctn_627") ?></strong></div></td><td><div id="tax_amount_2">0%</div><div id="tax_total_amount_2">0.00</div></td></tr>-->
                        <tr><td><strong><?php echo lang("ctn_628") ?></strong></td><td><div id="total_payment">0.00</div></td></tr>
                        </table>
                    </div>
            </div>

<hr>

<input type="submit" class="btn btn-primary form-control" value="Add Purchase Order">
<?php echo form_close() ?>

</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="add_item_db_area">
      
    </div>
  </div>
</div>

<script>
	var projectid = 0;
	
	$('#add_itemdb').on("click", function(event) {
		event.preventDefault();
		$.ajax({
			url: global_base_url + "invoices/get_itemdb_items",
			data : {
				projectid : projectid
			},
			dataType: 'json',
			success: function(data) 
			{
				$('#add_item_db_area').html(data.html);
				$('#addModal').modal('show');
			}
		});
	});
	
	$('body').on("click", "#add_item_to_invoice_items", function() {
		var itemid = $('#item-itemdb').val();
		// Get item data
		$.ajax({
			url: global_base_url + "invoices/get_itemdb_item/" + itemid,
			type: "GET",
			dataType: 'json',
			success: function(data) 
			{
				if(data.error) {
					alert(data.error_msg);
					return;
				}
				add_item(data);
			}
		})
	});
	
	$('#add_item').on("click", function(event) {
		event.preventDefault();
		add_item();
	});
	
	$(".itemchange").change(function(){
		calculate_total();
	});
	
	function add_item(data=null) 
{
	var item_name = "";
	var item_desc = "";
	var item_price = 0.00;
	var item_quantity = 0.00;
	if(data instanceof Object) {
		item_name = data.item_name;
		item_desc = data.item_desc;
		item_price = data.item_price;
		item_quantity = data.item_quantity;
	}
	var items_count = $('#items_count').val();
		items_count++;
		$('#items_count').val(items_count);

		var html = '<div class="invoice-item" id="invoice-item-'+items_count+'">'+
			'<div class="row">'+
				'<div class="col-md-4">'+
					'<div class="form-group">'+
					'<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1448") ?></label>'+
					'<p><input type="text" name="item_name_'+items_count+'" id="item_name_'+items_count+'" class="form-control" placeholder="<?php echo lang("ctn_616") ?>" value="'+item_name+'"></p>'+
					'<p><input type="text" name="item_desc_'+items_count+'" id="item_desc_'+items_count+'" class="form-control" placeholder="<?php echo lang("ctn_1449") ?>" value="'+item_desc+'"></p>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-3">'+
					'<div class="form-group">'+
					'<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1450") ?></label>'+
					'<input type="text" name="item_price_'+items_count+'" id="item_price_'+items_count+'" class="form-control itemchange" placeholder="0.00" value="'+item_price+'">'+
					'</div>'+
				'</div>'+
				'<div class="col-md-3">'+
					'<div class="form-group">'+
					'<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_617") ?></label>'+
					'<input type="text" name="item_quantity_'+items_count+'" id="item_quantity_'+items_count+'" class="form-control itemchange" placeholder="0.00" value="'+item_quantity+'">'+
					'</div>'+
				'</div>'+
				'<div class="col-md-2">'+
					'<div class="form-group">'+
					'<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_619") ?></label>'+
					'<p id="item_total_'+items_count+'">0.00</p>'+
					'<p><input type="checkbox" name="save_'+items_count+'" id="save_'+items_count+'" value="1"> <?php echo lang("ctn_1451") ?> </p>'+
					'<p><button type="button" class="btn btn-danger btn-xs" onclick="remove_item('+items_count+')"><span class="glyphicon glyphicon-trash"></span></button></p>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>';
		$('#invoice-items').append(html);
		calculate_total();
}

function remove_item(id) 
{
	$('#invoice-item-' +id).remove();
	
	calculate_total();

}

function calculate_total() 
{
	var total = 0;
	var items_count = $('#items_count').val();
	console.log(items_count);
	for(var i=1;i<=items_count;i++) {
		console.log("Loop: " + i);
		// Get values
		var price = convert_number(parseFloat($('#item_price_'+i).val()));
		var quantity = convert_number(parseFloat($('#item_quantity_'+i).val()));

		console.log(price);
		console.log(quantity);

		// Total
		var item_total = parseFloat(price * quantity);
		total = parseFloat(total + item_total);

		// Display
		item_total = item_total.toFixed(2);
		$('#item_total_' + i).html(item_total);

	}

	var sub_total = total.toFixed(2);
	$('#sub_total').html(sub_total);
	// Tax

	var tax = update_tax($('#tax_rate_1').val(), $('#tax_name_1').val(),1, total);
	var tax2 = update_tax($('#tax_rate_2').val(), $('#tax_name_2').val(),2, total);

	total = parseFloat(tax) + parseFloat(tax2) + total;

	total = total.toFixed(2);
	$('#total_payment').html(total);


	return;
}

function update_tax(tax_rate,name,id, sub_total) {
	var t = sub_total;
	var tax_rate = parseFloat(tax_rate);
	$('#tax_amount').text(tax_rate + "%");
	$('#tax_name').text(name);

	if(t> 0 && tax_rate > 0) {
		var bit = parseFloat(t/100*tax_rate);
		bit = bit.toFixed(2);
		$('#tax_total_amount_'+id).text("" + bit);
		return bit;
	}
	return 0;
}

function convert_number(digit) {
	return Number(digit.toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2);
}



function clearerrors() 
  {
    console.log("Called");
    $('.form-error').remove();
    $('.form-error-no-margin').remove();
    $('.errorField').removeClass('errorField');
  }
	
</script>
