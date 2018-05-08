<div class="white-area-content">
    <div class="db-header db-header-nomargin clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-credit-card"></span>
            <?php echo lang("ctn_1562") ?>
        </div>
        <div class="db-header-extra">
        </div>
    </div>
</div>

<?php echo form_open(site_url("purchases/add"), array("id" => "order_form")) ?>
    <div class="white-area-content content-separator clearfix">
        <div class="white-area-content content-separator clearfix">
            <h3 class="invoice-heading">
                <?php echo lang("ctn_1563") ?>
            </h3>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1525") ?></label>
                    <select name="supplier" class="form-control input-sm" id="supplier">
					<?php foreach($supplier->result() as $r) { ?>
						<option value="<?php echo $r->ID;?>"><?php echo $r->username;?></option>
					<?php } ?>
				</select>
				
				

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1564") ?></label>
                            <select name="mode_of_purchase" class="form-control input-sm" id="">
							<option value="cash">Cash</option>
							<option value="credit">Credit</option>
		        		</select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1565") ?></label>
                    <input type="text" name="purchase_date" class="form-control input-sm datepicker" value="<?=date('m/d/Y');?>">
                </div>

                <div class="form-group" id="client-area">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1566") ?></label>
                    <select name="payment_by" id="payment_by" class="form-control input-sm">
		               <option value="0"><?php echo lang("ctn_46") ?></option>
		               	   
		        </select>
                </div>

            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1567") ?></label>
                    <input type="text" name="overdue_date" class="form-control input-sm datepicker" value="<?=date('m/d/Y');?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1568") ?></label>
                    <input type="text" name="biller_name" class="form-control input-sm" placeholder="<?php echo lang(" ctn_1569 ") ?>">
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1570") ?></label>
                    <select name="ware_house" class="form-control input-sm" id="">
		                <option value="0"><?php echo lang("ctn_46") ?></option>
						<?php foreach($warehouses->result() AS $w) { ?> 
						   <option value="<?php echo $w->ID?>"><?php echo $w->name?></option>
					   <?php } ?>
		        </select>
                </div>
                <div class="form-group" id="client-area">
                    <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1571") ?></label>
                    <input type="text" name="invoice_no" class="form-control input-sm" placeholder="">
                </div>

            </div>
            <!--<div class="clearfix">
            <div class="form-group" style="width: 95%">
                <div class="input-group wide-tip">
                    <div class="input-group-addon">
                        <input type="text" id="input-search-product" class="form-control input-lg" placeholder="Please Add Product For Purchase" autocomplete="off">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addProduct" id="addmenually"><i class="glyphicon glyphicon-plus" id="addIcon" style="top: 6px;"></i></a>
                    </div>
                </div>
            </div>

        </div>-->
        </div>

    </div>

    <div class="white-area-content content-separator clearfix" id="invoice-items-area">
        <h3 class="invoice-heading">Purchase Items</h3>



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
					
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">Unit</label>
                            <select name="item_unit_1" id="item_unit_1" class="form-control itemchange input-sm">
								<?php foreach($units->result() AS $unit) { ?>
									<option><?=$unit->unit_name?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_617") ?></label>
                            <input type="text" name="item_quantity_1" id="item_quantity_1" class="form-control itemchange input-sm" placeholder="0.00">
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label">Quantity/Unit</label>
                            <input type="text" name="item_quantity_unit_1" id="item_quantity_unit_1" class="form-control itemchange input-sm" placeholder="0.00">
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1450") ?></label>
                            <input type="text" name="item_price_1" id="item_price_1" class="form-control itemchange input-sm" placeholder="0.00">
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
        <div class="white-area-content content-separator clearfix">
            <h3 class="invoice-heading">
                Summary
            </h3>
            <div class="table-responsive">
                <!--<table id="quotes-table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="table-header">
                        <td>
                            <?php echo lang("ctn_1573") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1574") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1575") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1576") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1577") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1578") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1579") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1580") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1581") ?>
                        </td>
                        <td>
                            <?php echo lang("ctn_1582") ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo lang("ctn_1583") ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <?php echo lang("ctn_1584") ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </thead>
                <tbody class="small-text">
                </tbody>
            </table>-->

                <div class="form-group">

                    <div class="col-md-6">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td><strong><?php echo lang("ctn_1585") ?></strong></td>
                                <td><input type="text" name="shipping_cost" class="form-control input-sm" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="transportation"><strong><?php echo lang("ctn_1586") ?></strong></div>
                                </td>
                                <td><input type="text" name="transportation" class="form-control input-sm" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="commission"><strong><?php echo lang("ctn_1587") ?></strong></div>
                                </td>
                                <td><input type="text" name="commision" class="form-control input-sm" placeholder=""></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo lang("ctn_1588") ?></strong></td>
                                <td><input type="text" name="other-expence" class="form-control input-sm" placeholder=""></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo lang("ctn_1578") ?></strong></td>
                                <td><input type="text" name="total" value="0" class="form-control input-sm" readonly placeholder=""></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td><strong><?php echo lang("ctn_1581") ?></strong></td>
                                <td>
                                    <div id="sub_total"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="tax_name_1_area"><strong><?php echo lang("ctn_1589") ?></strong></div>
                                </td>
                                <td>
                                    <div id="tax_amount_1">0</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="tax_name_2_area"><strong><?php echo lang("ctn_1590") ?></strong></div>
                                </td>
                                <td><input type="text" name="total_paid" class="form-control input-sm" placeholder=""></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo lang("ctn_1591") ?></strong></td>
                                <td><input type="text" name="discount" class="form-control input-sm" placeholder=""></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <input type="submit" class="btn btn-primary form-control" value="Add Purchase">
        </div>
    </div>
</form>
</div>




<!-- Supplier modal

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-folder-open"></span>
                    <?php echo lang("ctn_1549") ?>
                </h4>
            </div>

            <div class="modal-body ui-front">
                <?php echo form_open(site_url("suppliers/add_supplier"), array("class" => "form-horizontal")) ?>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1540") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="companyname" value="" id="companyname-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1527") ?></label>
                    <div class="col-md-8 ui-front">
                        <select name="typeid" class="form-control">
                            <option value="">Please Select</option>
                            <?php foreach($supplier_types->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1541") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="phone" value="" id="phone-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1542") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="email" value="" id="email-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1532") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cperson" value="" id="cperson-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1543") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cpersonphone" value="" id="cpersonphone-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1544") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cemail" value="" id="cemail-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1546") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="vat" value="" id="vat-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1116") ?></label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="address" id="address-search"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1547") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="web_url" value="" id="web_url-search">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
                <input type="submit" class="btn btn-primary" value="<?php echo lang(" ctn_1549 ") ?>">
                <?php echo form_close() ?>
            </div>

        </div>
    </div>
</div>

<!-- Add Product modal-->

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="add_item_db_area">

        </div>
    </div>
</div>

<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-folder-open"></span>
                    <?php echo lang("ctn_1592") ?>
                </h4>
            </div>

            <div class="modal-body ui-front">
                <?php echo form_open(site_url("purchase/"), array("class" => "form-horizontal")) ?>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1593") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="productname" value="" id="productname-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1594") ?></label>
                    <div class="col-md-8 ">
                        <input type="text" class="form-control" name="code" value="" id="code-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_516") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="category" value="" id="category-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1595") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="brand" value="" id="brand-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1527") ?></label>
                    <div class="col-md-8 ui-front">
                        <select name="typeid" class="form-control">
                            <option value="">Please Select</option>
                            <?php foreach($supplier_types->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1596") ?></label>
                    <div class="col-md-8">
                        <select name="p_unit" class="form-control">
                            <option value="">Please Select</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1597") ?></label>
                    <div class="col-md-8">
                        <select name="s_unit" class="form-control">
                            <option value="">Please Select</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1598") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="p_tax" value="" id="p_tax-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_1599") ?></label>
                    <div class="col-md-8">

                        <input type="text" class="form-control" name="discount" value="" id="discount-search">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_271") ?></label>
                    <div class="col-md-8">

                        <textarea class="form-control" name="desc" id="desc-search"></textarea>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
                <input type="submit" class="btn btn-primary" value="<?php echo lang(" ctn_1592 ") ?>">
                <?php echo form_close() ?>
            </div>

        </div>
    </div>
</div>


<style type="text/css">
    #addmenually {
        position: absolute;
        padding: 17px;
        background: #E2E7EB;
        height: 60px;
        top: 0px;
    }

</style>

<script>
	
	function changePR(k) {
		/*var pr_amt = parseFloat($("#TM"+k).html());
		var sl_amt = parseFloat($("#se"+k).val());
		var prof = parseFloat(sl_amt) - parseFloat(pr_amt);
		$("#prf"+k).html(prof.toFixed(2));
	
		var q = parseFloat($("#Q"+k).attr('rel'));
		var perUnitPrice = sl_amt / q;
		var OperPrice = pr_amt / q;
		
		var perProfit = perUnitPrice - OperPrice;
		$("#prfU"+k).html(perProfit.toFixed(2));*/
		
		alert(k);
		
	}
	
    var projectid = 0;

    $('#add_itemdb').on("click", function(event) {
        event.preventDefault();
        $.ajax({
            url: global_base_url + "invoices/get_itemdb_items",
            data: {
                projectid: projectid
            },
            dataType: 'json',
            success: function(data) {
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
            success: function(data) {
                if (data.error) {
                    //alert(data.error_msg);
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

    $('body').on("change", ".itemchange", function() {
        calculate_total();
    });

    /*$(".itemchange").change(function() {
        calculate_total();
    });*/

    function add_item(data = null) {
        var item_name = "";
        var item_desc = "";
        var item_price = 0.00;
        var item_quantity = 0.00;
        var item_id = 0;
        if (data instanceof Object) {
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

            '<div class="col-md-1">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">Unit</label>' +
            '<select name="item_unit_' + items_count + '" id="item_unit_' + items_count + '" class="form-control itemchange input-sm">' +
            <?php foreach($units->result() AS $unit) { ?>
			'<option><?=$unit->unit_name?></option>' +
			<?php } ?>
            '</select>' +
            '</div>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_617") ?></label>' +
            '<input type="text" name="item_quantity_' + items_count + '" id="item_quantity_' + items_count + '" class="form-control itemchange" placeholder="0.00" value="' + item_quantity + '">' +
            '</div>' +
            '</div>' +


            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label">Quantity/Unit</label>' +
            '<input type="text" name="item_quantity_unit_' + items_count + '" id="item_quantity_unit_' + items_count + '" class="form-control itemchange input-sm" placeholder="0.00">' +
            '</div>' +
            '</div>' +


            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1" class="light-label"><?php echo lang("ctn_1450") ?></label>' +
            '<input type="text" name="item_price_' + items_count + '" id="item_price_' + items_count + '" class="form-control itemchange" placeholder="0.00" value="' + item_price + '">' +
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

    function remove_item(id) {
        $('#invoice-item-' + id).remove();

        calculate_total();

    }

    function calculate_total() {
        var total = 0;
        var items_count = $('#items_count').val();
        console.log(items_count);
        

        for (var i = 1; i <= items_count; i++) {
            console.log("Loop: " + i);
            // Get values
            var price = convert_number(parseFloat($('#item_price_' + i).val()));
            var quantity = convert_number(parseFloat($('#item_quantity_' + i).val()));
            var vat = parseFloat($('#item_vat_' + i).val());
            

            console.log(price);
            console.log(quantity);

            // Total
            var item_total = parseFloat(price * quantity);


            // Display
            item_total = item_total.toFixed(2);

            if (item_total != 0) {
                var vat_amt = item_total * vat / 100;
                item_total = parseFloat(vat_amt) + parseFloat(item_total);
                $('#item_vat_total_' + i).html(vat_amt.toFixed(2));
            }

            total = parseFloat(total + item_total);
            $('#item_total_' + i).html(item_total);

        }

        var sub_total = total.toFixed(2);
        $('#sub_total').html(sub_total);
        // Tax

        var tax = update_tax(5, $('#tax_name_1').val(), 1, total);
        //var tax2 = update_tax($('#tax_rate_2').val(), $('#tax_name_2').val(), 2, total);

        total = parseFloat(tax) + total;
        total = total.toFixed(2);
        $('#total_payment').html(total);


        return;
    }

    function update_tax(tax_rate, name, id, sub_total) {
        var t = sub_total;
        var tax_rate = parseFloat(tax_rate);
        $('#tax_amount').text(tax_rate + "%");
        $('#tax_name').text(name);

        if (t > 0 && tax_rate > 0) {
            var bit = parseFloat(t / 100 * tax_rate);
            bit = bit.toFixed(2);
            $('#tax_total_amount_' + id).text("" + bit);
            return bit;
        }
        return 0;
    }

    function convert_number(digit) {
        return Number(digit.toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2);
    }



    function clearerrors() {
        console.log("Called");
        $('.form-error').remove();
        $('.form-error-no-margin').remove();
        $('.errorField').removeClass('errorField');
    }

</script>
