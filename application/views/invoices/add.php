<script src="<?php echo base_url();?>scripts/custom/get_usernames.js"></script>
<div class="white-area-content">

<div class="db-header db-header-nomargin clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-credit-card"></span> <?php echo lang("ctn_586") ?></div>
    <div class="db-header-extra">
</div>
</div>

</div>

<?php echo form_open(site_url("invoices/add_pro"), array("id" => "invoice_form")) ?>
<div class="white-area-content content-separator clearfix" id="invoice-area">

<ul class="nav nav-tabs invoice-heading-tabs" role="tablist">
    <li role="presentation" class="active invoice-tab"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo lang("ctn_1237") ?></a></li>
    <li role="presentation" class=" invoice-tab"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab"><?php echo lang("ctn_515") ?></a></li>
    <li role="presentation" class=" invoice-tab"><a href="#themes" aria-controls="themes" role="tab" data-toggle="tab"><?php echo lang("ctn_1432") ?></a></li>
    <!--<li role="presentation" class=" invoice-tab"><a href="#tax" id="tax-tab" aria-controls="payments" role="tab" data-toggle="tab"><?php echo lang("ctn_658") ?></a>-->
    </li>
  </ul>


<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="home">

<div class="col-md-6">
	
	  <div class="form-group" id="client-area">
	    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_924") ?></label>
	    <select name="clientid" id="client" class="form-control input-sm">
                <option value="">Please Select</option>
                    <?php foreach($clients->result() as $r) : ?>
                        <option value="<?php echo $r->ID ?>"><?php echo $r->username ?></option>
                    <?php endforeach; ?>
        </select>
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_588") ?></label>
		    <input type="text" class="form-control input-sm" name="invoice_id" value="<?php echo $invoice_id ?>">
		  </div>
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_547") ?></label>
		    <input type="text" name="due_date" class="form-control datepicker input-sm">
		  </div>
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1677") ?></label>
		    <input type="text" class="form-control input-sm" name="vat_vendor" value="<?php echo $invoice_id ?>">
		  </div>
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1675") ?></label>
		    <input type="text" class="form-control input-sm" name="refno" value="<?php echo $invoice_id ?>">
		  </div>
		</div>
	
	</div>
	
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_293") ?></label>
		<input type="text" name="date" class="form-control datepicker input-sm">
	</div>
	
	<div class="form-group">
	    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1674") ?></label>
	    <select name="po" id="client" class="form-control input-sm">
                <option value="0"></option>
                
        </select>
	</div>

	<div class="row" id="client-guest" style="display: none">
		<div class="col-md-6">
			<div class="form-group">
				<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1205") ?></label>
				<input type="text" name="guest_name" class="form-control input-sm" placeholder="<?php echo lang("ctn_1436") ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1206") ?></label>
				<input type="text" name="guest_email" class="form-control input-sm" placeholder="<?php echo lang("ctn_1437") ?>">
			</div>
		</div>
	</div>
	<div class="form-group" id="username-area" style="display: none">
	    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_591") ?></label>
	    <input type="text" name="client_username" class="form-control input-sm" id="username-search" placeholder="<?php echo lang("ctn_592") ?>">
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1676") ?></label>
		   <input type="text" name="vat" class="form-control input-sm" id="vat-search" placeholder="">
		  </div>
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1660") ?></label>
		   <input type="text" name="vat" class="form-control input-sm" id="vat-search" placeholder="">
		  </div>
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1677") ?></label>
		   <input type="text" name="vat" class="form-control input-sm" id="vat-search" placeholder="">
		  </div>
		</div>
	
	</div>
</div>


</div>

<div role="tabpanel" class="tab-pane" id="notes">

<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_725") ?></label>
	<textarea name="notes" class="form-control" placeholder="<?php echo lang("ctn_1439") ?> ..." rows="4"></textarea>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1440") ?></label>
	<textarea name="term_notes" class="form-control" placeholder="<?php echo lang("ctn_1441") ?> ..." rows="4"></textarea>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1442") ?></label>
	<textarea name="hidden_notes" class="form-control" placeholder="<?php echo lang("ctn_1443") ?>" rows="4"></textarea>
	</div>
</div>
</div>

</div>


<div role="tabpanel" class="tab-pane" id="themes">

<input type="hidden" name="themeid" id="themeid" value="1">
<?php $default_theme_id = 1; ?>
<?php foreach($themes->result() as $r) : ?>
<div class="invoice-theme <?php if($default_theme_id == $r->ID) : ?>invoice-theme-active<?php endif; ?>" id="theme-id-<?php echo $r->ID ?>">
<img src="<?php echo base_url() ?>images/invoices/<?php echo $r->image ?>" width="150" onclick="set_invoice_theme(<?php echo $r->ID ?>)">
<p><?php echo $r->name ?></p>
</div>
<?php endforeach; ?>

</div>

<div role="tabpanel" class="tab-pane" id="tax">
	
<div class="row">
<div class="col-md-12">

	<div class="row">
		<div class="col-md-8">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1444") ?></label>
		    <input type="text" name="tax_name_1" id="tax_name_1" class="form-control" value="">
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1445") ?></label>
		    <input type="text" name="tax_rate_1" id="tax_rate_1" class="form-control" placeholder="<?php echo lang("ctn_622") ?>" value="">
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
		<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1446") ?></label>
		    <input type="text" name="tax_name_2" id="tax_name_2" class="form-control" value="">
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
		    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1445") ?></label>
		    <input type="text" name="tax_rate_2" id="tax_rate_2" class="form-control" placeholder="<?php echo lang("ctn_622") ?>" value="">
		  </div>
		</div>
	</div>
</div>
</div>

</div>

</div>

</div>

<div class="white-area-content content-separator clearfix" id="invoice-items-area">
	<h3 class="invoice-heading"><?php echo lang("ctn_1447") ?></h3>

	<div id="invoice-items">
            <div class="invoice-item small-text" id="invoice-item-1">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1448") ?></label>
                            <p><input type="text" name="item_name_1" id="item_name_1" class="form-control input-sm" placeholder="<?php echo lang(" ctn_616 ") ?>"></p>
                            <!--<p><input type="text" name="item_desc_1" id="item_desc_1" class="form-control input-sm" placeholder="<?php echo lang(" ctn_1449 ") ?>"></p>-->
                        </div>
                    </div>
					
					<input type="hidden" name="item_id_1" value="0"/>
					
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">Description</label>
                            <p><input type="text" name="item_description_1" id="item_description_1" class="form-control input-sm" placeholder="Enter Description"></p>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">Quantity</label>
                            <input type="text" name="item_quantity_1" id="item_quantity_1" class="form-control itemchange input-sm" placeholder="0.00">
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">Amount</label>
                            <input type="text" name="item_amount_1" id="item_amount_1" class="form-control itemchange input-sm" placeholder="0.00">
                        </div>
                    </div>


                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">Rate</label>
                            <input readonly type="text" name="item_rate_1" id="item_rate_1" class="form-control itemchange input-sm" placeholder="0.00">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">VAT %</label>
                            <input type="text" name="item_vat_1" id="item_vat_1" class="form-control itemchange input-sm" placeholder="5" value="5">
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">
                            <div style="float:left;margin-right: 9px;">
                                <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_619") ?></label>
                                <p id="item_total_1">0.00</p>
                            </div>
                            <div style="float:left;margin-right: 15px;">
                                <label for="exampleInputEmail1" class="light-label">Total VAT</label>
                                <p id="item_vat_total_1">0.00</p>
                            </div>
                            <div style="float:left;">
                                <a class="btn btn-danger btn-xs" onclick="remove_item(1)"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
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
	<div class="white-area-content content-separator clearfix" >
	<h3 class="invoice-heading">Summary</h3>
	<div class="table-responsive">
<!--<table id="quotes-table" class="table table-bordered table-striped table-hover">
	<thead>
		<tr class="table-header"><td><?php echo lang("ctn_1664") ?></td><td><?php echo lang("ctn_271") ?></td><td><?php echo lang("ctn_1665") ?></td><td><?php echo lang("ctn_1666") ?></td><td><?php echo lang("ctn_1667") ?></td><td><?php echo lang("ctn_1668") ?></td><td><?php echo lang("ctn_1669") ?></td><td><?php echo lang("ctn_1670") ?></td></tr>
		<tr ><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

	</thead>
	<tbody class="small-text">
	</tbody>
</table>-->

<div class="form-group">
                   
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover">
                        <tr><td><strong><?php echo lang("ctn_1671") ?></strong></td><td><div id="sub_total"></div></td></tr>
                        <tr><td><div id="tax_name_1_area"><strong><?php echo lang("ctn_1591") ?></strong></div></td><td><div id="tax_amount_1">0</div></td></tr>
                        <tr><td><div id="tax_name_2_area"><strong><?php echo lang("ctn_1669") ?></strong></div></td><td><input type="text" name="total"  class="form-control input-sm"  placeholder=""></td></tr>
                        <tr><td><strong><?php echo lang("ctn_1672") ?></strong></td><td><input type="text" name="total"  class="form-control input-sm"  placeholder=""></td></tr>
                        </table>
                    </div>
            </div>
</div>
<hr>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_1679") ?>">
</div>
	</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="add_item_db_area">
      
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

	var projectid = 0;

	$('body').on("change", ".itemchange", function() {
		calculate_total();
	});

	$('body').on("focus", "#invoice-items input", function() {
		clearerrors();
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

	$('#add_item').on("click", function(event) {
		event.preventDefault();
		add_item();
	});

	$('#projects').on("change", function() {
		projectid = $(this).val();

		// Populate client with team members
		$.ajax({
			url: global_base_url + "invoices/get_project_clients/" + projectid,
			type: "GET",
			dataType: "json",
			success: function(data) 
			{
				if(data.error) {
					alert(data.error_msg);
					return;
				}
				if(data.success) {
					$('#client-area').html(data.html);
				}
			}
		});
	});

	$('#client-area').on("change","#client", function() {
		var client = $('#client').val();
		if(client == -1) {
			$('#client-guest').fadeIn(100);
			$('#username-area').fadeOut(100);
		} else if(client == -2) {
			$('#username-area').fadeIn(100);
			$('#client-guest').fadeOut(100);
		} else {
			$('#username-area').fadeOut(100);
			$('#client-guest').fadeOut(100);
		}
	});

	$('#tax_name_1').change(function() {
		$('#tax_name_1_area').text($('#tax_name_1').val());
	});
	$('#tax_name_2').change(function() {
		$('#tax_name_2_area').text($('#tax_name_2').val());
	});

	$('#tax_rate_1').change(function() {
		$('#tax_amount_1').text($('#tax_rate_1').val() + "%");
		$('#tax_name_1_area').text($('#tax_name_1').val());
		calculate_total();
	});

	$('#tax_rate_2').change(function() {
		$('#tax_amount_2').text($('#tax_rate_2').val() + "%");
		$('#tax_name_2_area').text($('#tax_name_2').val());
		calculate_total();
	});

	var form = "invoice_form";
	$('#'+form + ' input').on("focus", function(e) {
      clearerrors();
    });

	$('#'+form).on("submit", function(e) {

      e.preventDefault();
      // Ajax check
      var data = $(this).serialize();
      $.ajax({
        url : global_base_url + "invoices/add_check",
        type : 'POST',
        data : {
          formData : data,
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash() ?>'
        },
        dataType: 'JSON',
        success: function(data) {
          if(data.error) {
            $('#'+form).prepend('<div class="form-error">'+data.error_msg+'</div>');
          }
          if(data.success) {
            // allow form submit
            $('#'+form).unbind('submit').submit();
          }
          if(data.field_errors) {
            var errors = data.fieldErrors;
            for (var property in errors) {
                if (errors.hasOwnProperty(property)) {
                	// Custom handlers for this page
                	if(property == "items_count") {
                		$('#item_error_count').html('<div class="form-error-no-margin">'+errors[property]+'</div>');
                		$('#invoice-items').addClass("errorField");
                	} else {
	                    // Find form name
	                    console.log("Looking for input ... " + property);
	                    var field_name = ' input[name="'+property+'"]';
	                    if(!$(field_name).length) {
	                    	// Check for select
	                    	console.log("looking for select ..." + property);
	                    	var field_name = '#' + form + ' select[name="'+property+'"]';
	                    	if(!$(field_name.length)) {
	                    		// Check for something else?
	                    	}
	                    }
	                    $(field_name).addClass("errorField");
	                    if(errors[property]) {
		                    // Get input group of field
		                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');
		                }
		            }
                    

                }
            }
          }
        }
      });

      return false;


    });
});

function add_item(data=null) 
{
	var item_name = "";
	var item_desc = "";
	var item_price = 0.00;
	var item_quantity = 0.00;
    var item_id = 0;
	if(data instanceof Object) {
		item_name = data.item_name;
		item_desc = data.item_desc;
		item_price = data.item_price;
		item_quantity = data.item_quantity;
        item_id = data.item_id;
	}
	var items_count = $('#items_count').val();
		items_count++;
		$('#items_count').val(items_count);

		var html = '<div class="invoice-item" id="invoice-item-' + items_count + '">' +
            '<div class="row">' +
            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1448") ?></label>' +
            '<p><input type="text" name="item_name_' + items_count + '" id="item_name_' + items_count + '" class="form-control" placeholder="<?php echo lang("ctn_616") ?>" value="' + item_name + '"></p>' +
            '<!--<p><input type="text" name="item_desc_' + items_count + '" id="item_desc_' + items_count + '" class="form-control" placeholder="<?php echo lang("ctn_1449") ?>" value="' + item_desc + '"></p>-->' +
            '</div>' +
            '</div>' +
            
            '<input type="hidden" name="item_id_' + items_count + '" value="'+item_id+'"/>'+

            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">Description</label>' +
            '<p><input type="text" value="'+item_desc+'" name="item_description_' + items_count + '" id="item_description_' + items_count + '" class="form-control input-sm" placeholder="Enter Description"></p>' +
            '</div>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">Quantity</label>' +
            '<input value="'+item_quantity+'" type="text" name="item_quantity_' + items_count + '" id="item_quantity_' + items_count + '" class="form-control itemchange input-sm" placeholder="0.00">' +
            '</div>' +
            '</div>' +


            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">Amount</label>' +
            '<input value="'+item_price+'" type="text" name="item_amount_' + items_count + '" id="item_amount_' + items_count + '" class="form-control itemchange input-sm" placeholder="0.00">' +
            '</div>' +
            '</div>' +


            '<div class="col-md-1">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">Rate</label>' +
            '<input type="text" readonly name="item_rate_' + items_count + '" id="item_rate_' + items_count + '" class="form-control itemchange input-sm" placeholder="0.00">' +
            '</div>' +
            '</div>' +

            '<div class="col-md-1">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">VAT %</label>' +
            '<input type="text" name="item_vat_' + items_count + '" id="item_vat_' + items_count + '" class="form-control itemchange input-sm" placeholder="5" value="5">' +
            '</div>' +
            '</div>' +


            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<div style="float:left;margin-right: 9px;">' +
            '<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_619") ?></label>' +
            '<p id="item_total_' + items_count + '">0.00</p>' +
            '</div>' +
            '<div style="float:left;margin-right: 15px;">' +
            '<label for="exampleInputEmail1" class="light-label">Total VAT</label>' +
            '<p id="item_vat_total_' + items_count + '">0.00</p>' +
            '</div>' +
            '<div style="float:left;">' +
            '<a class="btn btn-danger btn-xs" onclick="remove_item(' + items_count + ')"><span class="glyphicon glyphicon-trash"></span></a>' +
            '</div>' +
            '</div>' +
            '</div>' +

            '</div>' +
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


function set_invoice_theme(themeid) 
{
	$('#themeid').val(themeid);
	$('.invoice-theme-active').removeClass("invoice-theme-active");
	$('#theme-id-'+themeid).addClass("invoice-theme-active");
}
</script>