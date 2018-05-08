<ul class="newnav nav nav-sidebar">
           
            <li class="<?php if(isset($activeLink['home']['general'])) echo "active" ?>"><a href="<?php echo site_url() ?>"><span class="glyphicon glyphicon-home sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_688") ?> <span class="sr-only">(current)</span></a></li>
            <?php if($this->common->has_permissions(array("admin", "project_admin", "project_worker", "project_client"), $this->user)) : ?>
            <li id="projects_links">
                <a data-toggle="collapse" data-parent="#projects_links" href="#projects_links_c" class="collapsed <?php if(isset($activeLink['projects'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-folder-open sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_689") ?>
                  <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['projects'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                </a>
                <div id="projects_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['projects'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <li class="<?php if(isset($activeLink['projects']['general'])) echo "active" ?>"><a href="<?php echo site_url("projects") ?>"> <?php echo lang("ctn_690") ?></a></li>
                    <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['projects']['all'])) echo "active" ?>"><a href="<?php echo site_url("projects/all") ?>"> <?php echo lang("ctn_691") ?></a></li>
		      <li class="<?php if(isset($activeLink['projects']['cats'])) echo "active" ?>"><a href="<?php echo site_url("projects/cats") ?>"> <?php echo lang("ctn_692") ?></a></li>
                                 
                     <li id="project_expense_links">
                        <a data-toggle="collapse" data-parent="#project_expense_links" href="#project_expense_links_c" class="collapsed <?php if(isset($activeLink['projects']['expenses']) || isset($activeLink['projects']['expense_head']) || isset($activeLink['projects']['expense_category'])) echo "active" ?>" >
                        <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1753") ?>
                        <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['projects']['expense'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                        </a>
                        <div id="project_expense_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['projects']['expenses']) || isset($activeLink['projects']['expense_head']) || isset($activeLink['projects']['expense_category']) )  echo "in" ?>">
                          <ul class="inner-sidebar-links">
                            <li class="<?php if(isset($activeLink['projects']['expense_category'])) echo "active" ?>"><a  style="padding-left: 88px;" href="<?php echo site_url("projects/expense_category") ?>"> <?php echo lang("ctn_1754") ?></a></li>
			    <li class="<?php if(isset($activeLink['projects']['expense_head'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("projects/expense_head") ?>"> <?php echo lang("ctn_1755") ?></a></li>
                            <li class="<?php if(isset($activeLink['projects']['expenses'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("projects/expenses") ?>"> <?php echo lang("ctn_1753") ?></a></li>
                          </ul>
                        </div>
                      </li>

                    <?php endif; ?>
                  </ul>
                </div>
            </li>
          <?php endif; ?>

           <?php if($this->settings->info->enable_tasks && $this->common->has_permissions(array("admin", "project_admin", "task_worker", "task_manage", "task_client"), $this->user)) : ?>
              <li id="task_links">
                  <a data-toggle="collapse" data-parent="#task_links" href="#task_links_c" class="collapsed <?php if(isset($activeLink['task'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-tasks sidebar-icon sidebar-icon-pink"></span> <?php echo lang("ctn_696") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['task'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="task_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['task'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                    <?php if($this->common->has_permissions(array("admin", "project_admin", "task_manage", "task_worker"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['task']['general'])) echo "active" ?>"><a href="<?php echo site_url("tasks") ?>"> <?php echo lang("ctn_697") ?></a></li>
                      <li class="<?php if(isset($activeLink['task']['your'])) echo "active" ?>"><a href="<?php echo site_url("tasks/assigned") ?>"> <?php echo lang("ctn_698") ?></a></li>
                      <li class="<?php if(isset($activeLink['task']['templates'])) echo "active" ?>"><a href="<?php echo site_url("tasks/templates") ?>"><?php echo lang("ctn_723") ?></a></li>
                    <?php endif; ?>
                      <?php if($this->common->has_permissions(array("admin", "project_admin", "task_manage"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['task']['all'])) echo "active" ?>"><a href="<?php echo site_url("tasks/all") ?>"> <?php echo lang("ctn_699") ?></a></li>
                        <li class="<?php if(isset($activeLink['task']['archived'])) echo "active" ?>"><a href="<?php echo site_url("tasks/archived") ?>"><?php echo lang("ctn_1339") ?></a></li>
                      <?php endif; ?>
                      <?php if($this->common->has_permissions(array("task_client"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['task']['client'])) echo "active" ?>"><a href="<?php echo site_url("tasks/client") ?>"> <?php echo lang("ctn_1340") ?></a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>

            <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
            <li id="clients_links">
                <a data-toggle="collapse" data-parent="#clients_links" href="#clients_links_c" class="collapsed <?php if(isset($activeLink['clients']) || isset($activeLink['suppliers']) || isset($activeLink['vendors'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-user sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_1523") ?>
                  <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['clients']) || isset($activeLink['suppliers']) || isset($activeLink['vendors'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                </a>
                <div id="clients_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['clients'])|| isset($activeLink['suppliers'])|| isset($activeLink['vendors'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <li class="<?php if(isset($activeLink['clients']['general'])) echo "active" ?>"><a href="<?php echo site_url("clients") ?>"> <?php echo lang("ctn_1524") ?></a></li>
                    <li class="<?php if(isset($activeLink['suppliers']['general'])) echo "active" ?>"><a href="<?php echo site_url("suppliers") ?>"> <?php echo lang("ctn_1525") ?></a></li>
                    <li class="<?php if(isset($activeLink['vendors']['general'])) echo "active" ?>"><a href="<?php echo site_url("vendors") ?>"> <?php echo lang("ctn_1550") ?></a></li>
                    <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['clients']['types'])) echo "active" ?>"><a href="<?php echo site_url("clients/client_type") ?>"> <?php echo lang("ctn_1526") ?></a></li>
                      <li class="<?php if(isset($activeLink['suppliers']['types'])) echo "active" ?>"><a href="<?php echo site_url("suppliers/supplier_type") ?>"> <?php echo lang("ctn_1527") ?></a></li>
                      <li class="<?php if(isset($activeLink['vendors']['types'])) echo "active" ?>"><a href="<?php echo site_url("vendors/vendor_type") ?>"> <?php echo lang("ctn_1551") ?></a></li>
                    <?php endif; ?>
                  </ul>
                </div>
            </li>
          <?php endif; ?>

           <li id="quotes_links">
            <a data-toggle="collapse" data-parent="#quotes_links_links" href="#quotes_links_links_c" class="collapsed <?php if(isset($activeLink['quotes'])) echo "active" ?>" >
            <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_1652") ?>
            <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['quotes'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="quotes_links_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['quotes'])) echo "in" ?>">
            <ul class="inner-sidebar-links">
            <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
              <li class="<?php if(isset($activeLink['quotes']['quotations'])) echo "active" ?>"><a href="<?php echo site_url("quotes/view_quotations") ?>"> <?php echo lang("ctn_1653") ?></a></li>
              
            <?php endif; ?>
            </ul>
            </div>
          </li>

          <li id="sales_links">
                  <a data-toggle="collapse" data-parent="#sales_links" href="#sales_links_c" class="collapsed <?php if(isset($activeLink['sales'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-pink"></span> <?php echo lang("ctn_263") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['sales'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="sales_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['sales'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                    <?php if($this->common->has_permissions(array("admin", "project_admin", "task_manage", "task_worker"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['sales']['invoice'])) echo "active" ?>"><a href="<?php echo site_url("sales/sales_invoice") ?>"> <?php echo lang("ctn_542") ?></a></li>
                      <li class="<?php if(isset($activeLink['sales']['due'])) echo "active" ?>"><a href="<?php echo site_url("sales/sales_due") ?>"> <?php echo lang("ctn_1680") ?></a></li>
                      <li class="<?php if(isset($activeLink['sales']['overdue'])) echo "active" ?>"><a href="<?php echo site_url("sales/sales_over_due") ?>"><?php echo lang("ctn_1681") ?></a></li>
                      <li class="<?php if(isset($activeLink['sales']['paid'])) echo "active" ?>"><a href="<?php echo site_url("sales/sales_paid_invoice") ?>"><?php echo lang("ctn_1682") ?></a></li>
                      <li class="<?php if(isset($activeLink['sales']['partially'])) echo "active" ?>"><a href="<?php echo site_url("sales/sales_partiallypaid_invoice") ?>"><?php echo lang("ctn_1683") ?></a></li>
                    <?php endif; ?>
                    </ul>
                  </div>
            </li>

            <li id="sales_order_links">
                  <a data-toggle="collapse" data-parent="#sales_order_links" href="#sales_order_links_c" class="collapsed <?php if(isset($activeLink['sales_order'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1684") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['sales_order'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="sales_order_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['sales_order'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                    <?php if($this->common->has_permissions(array("admin", "project_admin", "task_manage", "task_worker"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['sales_order']['order'])) echo "active" ?>"><a href="<?php echo site_url("sales/order") ?>"> <?php echo lang("ctn_1685") ?></a></li>
                      <li class="<?php if(isset($activeLink['sales_order']['return'])) echo "active" ?>"><a href="<?php echo site_url("sales/return") ?>"> <?php echo lang("ctn_1686") ?></a></li>
                    <?php endif; ?>
                    </ul>
                  </div>
            </li>

            <li id="purchase_links">
              <a data-toggle="collapse" data-parent="#purchase_links" href="#purchase_links_c" class="collapsed <?php if(isset($activeLink['purchases'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-credit-card sidebar-icon sidebar-icon-pink"></span> Purchases
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['purchases'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="purchase_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['purchases'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin", "invoice_manage"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['purchases']['general'])) echo "active" ?>"><a href="<?php echo site_url("purchases/order") ?>"> <?php echo "Purchase Order" ?></a></li>
                <li class="<?php if(isset($activeLink['purchases']['add'])) echo "active" ?>"><a href="<?php echo site_url("purchases") ?>"> <?php echo lang("ctn_1561") ?></a></li>
                <li class="<?php if(isset($activeLink['purchases']['reoccuring'])) echo "active" ?>"><a href="<?php echo site_url("invoices/reoccuring") ?>"> <?php echo lang("ctn_722") ?></a></li>
                <li class="<?php if(isset($activeLink['purchases']['templates'])) echo "active" ?>"><a href="<?php echo site_url("invoices/templates") ?>"> <?php echo lang("ctn_723") ?></a></li>
                <li class="<?php if(isset($activeLink['purchases']['pay'])) echo "active" ?>"><a href="<?php echo site_url("invoices/paying_accounts") ?>"> <?php echo lang("ctn_1341") ?></a></li>
                <li class="<?php if(isset($activeLink['purchases']['items'])) echo "active" ?>"><a href="<?php echo site_url("invoices/items") ?>"> <?php echo lang("ctn_1470") ?></a></li>
              <?php endif; ?>
                <li class="<?php if(isset($activeLink['purchases']['client'])) echo "active" ?>"><a href="<?php echo site_url("invoices/client") ?>"> <?php echo lang("ctn_724") ?></a></li>
              </ul>
              </div>
            </li>

            <li id="product_settings_links">
              <a data-toggle="collapse" data-parent="#product_settings_links" href="#product_settings_links_c" class="collapsed <?php if(isset($activeLink['product_settings'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-tasks sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_1615") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['product_settings'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="product_settings_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['product_settings'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
          
                  <?php if($this->common->has_permissions(array("admin", "project_admin", "invoice_manage"), $this->user)) : ?>
                   <li class="<?php if(isset($activeLink['purchases']['items'])) echo "active" ?>"><a href="<?php echo site_url("invoices/items") ?>"> <?php echo lang("ctn_1687") ?></a></li>
                  <?php endif; ?>
                
                  <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                    <li class="<?php if(isset($activeLink['product_settings']['name'])) echo "active" ?>"><a href="<?php echo site_url("product_settings/product_name") ?>"> <?php echo lang("ctn_192") ?></a></li>
                    <li class="<?php if(isset($activeLink['product_settings']['unit'])) echo "active" ?>"><a href="<?php echo site_url("product_settings/units") ?>"> <?php echo lang("ctn_1616") ?></a></li>
                    <li class="<?php if(isset($activeLink['product_settings']['brand'])) echo "active" ?>"><a href="<?php echo site_url("product_settings/brands") ?>"> <?php echo lang("ctn_1633") ?></a></li>
                    <li class="<?php if(isset($activeLink['product_settings']['category'])) echo "active" ?>"><a href="<?php echo site_url("product_settings/categories") ?>"> <?php echo lang("ctn_516") ?></a></li>
                  <?php endif; ?>

                </ul>
                
              </div>
            </li>

            <li id="product_management_links">
              <a data-toggle="collapse" data-parent="#product_management_links" href="#product_management_links_c" class="collapsed <?php if(isset($activeLink['product_management'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-brown"></span> <?php echo lang("ctn_1688") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['product_management'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="product_management_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['product_management'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
               <?php if($this->common->has_permissions(array("admin", "project_admin", "invoice_manage"), $this->user)) : ?>
                    <li class="<?php if(isset($activeLink['purchases']['general'])) echo "active" ?>"><a href="<?php echo site_url("products") ?>/purchase_management"> <?php echo "Purchase Management" ?></a></li>
                    <li class="<?php if(isset($activeLink['product_management']['sales'])) echo "active" ?>"><a href="<?php echo site_url("inventory/sales_mngmnt") ?>"><?php echo lang("ctn_1695") ?></a></li>
                  <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="warehouse_links">
              <a data-toggle="collapse" data-parent="#warehouse_links" href="#warehouse_links_c" class="collapsed <?php if(isset($activeLink['warehouses'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_1600") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['warehouses'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="warehouse_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['warehouses'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['warehouses']['general'])) echo "active" ?>"><a href="<?php echo site_url("warehouses") ?>"> <?php echo lang("ctn_1601") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="inventory_links">
              <a data-toggle="collapse" data-parent="#inventory_links" href="#inventory_links_c" class="collapsed <?php if(isset($activeLink['inventory'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1689") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['inventory'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="inventory_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['inventory'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['inventory']['stock'])) echo "active" ?>"><a href="<?php echo site_url("inventory/showstock") ?>"> <?php echo lang("ctn_1690") ?></a></li>
                <li class="<?php if(isset($activeLink['inventory']['outofstock'])) echo "active" ?>"><a href="<?php echo site_url("inventory/out_of_stock") ?>"> <?php echo lang("ctn_1691") ?></a></li>
                <li class="<?php if(isset($activeLink['inventory']['fast'])) echo "active" ?>"><a href="<?php echo site_url("inventory/fast_moving") ?>"> <?php echo lang("ctn_1692") ?></a></li>
                <li class="<?php if(isset($activeLink['inventory']['slow'])) echo "active" ?>"><a href="<?php echo site_url("inventory/slow_moving") ?>"> <?php echo lang("ctn_1693") ?></a></li>
                <li class="<?php if(isset($activeLink['inventory']['current'])) echo "active" ?>"><a href="<?php echo site_url("inventory/current_stock") ?>"> <?php echo lang("ctn_1694") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="transactions_links">
              <a data-toggle="collapse" data-parent="#transactions_links" href="#transactions_links_c" class="collapsed <?php if(isset($activeLink['transactions'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_1699") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['transactions'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="transactions_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['transactions'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['transactions']['receipt'])) echo "active" ?>"><a href="<?php echo site_url("transactions/receipt_voucher") ?>"> <?php echo lang("ctn_1700") ?></a></li>
                <li class="<?php if(isset($activeLink['transactions']['payment'])) echo "active" ?>"><a href="<?php echo site_url("transactions/payment_voucher") ?>"> <?php echo lang("ctn_1701") ?></a></li>
                <li class="<?php if(isset($activeLink['transactions']['pdc'])) echo "active" ?>"><a href="<?php echo site_url("transactions/pdc_rec") ?>"> <?php echo lang("ctn_1702") ?></a></li>
                <li class="<?php if(isset($activeLink['transactions']['pdcpayable'])) echo "active" ?>"><a href="<?php echo site_url("transactions/pdc_payable") ?>"> <?php echo lang("ctn_1703") ?></a></li>
                <li class="<?php if(isset($activeLink['transactions']['pdc_clearence'])) echo "active" ?>"><a href="<?php echo site_url("transactions/pdc_clearence") ?>"> <?php echo lang("ctn_1704") ?></a></li>
                <li class="<?php if(isset($activeLink['invoice']['general'])) echo "active" ?>"><a href="<?php echo site_url("invoices") ?>"> <?php echo lang("ctn_1705") ?></a></li>
                <li class="<?php if(isset($activeLink['purchases']['client'])) echo "active" ?>"><a href="<?php echo site_url("invoices/client") ?>"> <?php echo lang("ctn_1706") ?></a></li>
                <li class="<?php if(isset($activeLink['transactions']['payroll_slip'])) echo "active" ?>"><a href="<?php echo site_url("transactions/payroll_slip") ?>"> <?php echo lang("ctn_1707") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="fleet_links">
              <a data-toggle="collapse" data-parent="#fleet_links" href="#fleet_links_c" class="collapsed <?php if(isset($activeLink['fleets'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-plane sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_1708") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['fleets'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="fleet_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['fleets'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['fleets']['driver'])) echo "active" ?>"><a href="<?php echo site_url("fleets/driver") ?>"> <?php echo lang("ctn_1709") ?></a></li>
                <li class="<?php if(isset($activeLink['fleets']['vehicle'])) echo "active" ?>"><a href="<?php echo site_url("fleets/vehicle") ?>"> <?php echo lang("ctn_1710") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="opening_balance_links">
              <a data-toggle="collapse" data-parent="#opening_balance_links" href="#opening_balance_links_c" class="collapsed <?php if(isset($activeLink['opening_balance'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_1711") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['opening_balance'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="opening_balance_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['opening_balance'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['opening_balance']['customer'])) echo "active" ?>"><a href="<?php echo site_url("opening_balance/customer_opening_balance") ?>"> <?php echo lang("ctn_1712") ?></a></li>
                <li class="<?php if(isset($activeLink['opening_balance']['supplier'])) echo "active" ?>"><a href="<?php echo site_url("opening_balance/supplier_opening_balance") ?>"> <?php echo lang("ctn_1713") ?></a></li>
                <li class="<?php if(isset($activeLink['opening_balance']['receive'])) echo "active" ?>"><a href="<?php echo site_url("opening_balance/receive_old_balance") ?>"> <?php echo lang("ctn_1714") ?></a></li>
                <li class="<?php if(isset($activeLink['opening_balance']['receive_supplier'])) echo "active" ?>"><a href="<?php echo site_url("opening_balance/receive_old_balance_supplier") ?>"> <?php echo lang("ctn_1715") ?></a></li>
                <li class="<?php if(isset($activeLink['opening_balance']['old_balance'])) echo "active" ?>"><a href="<?php echo site_url("opening_balance/old_balance_details") ?>"> <?php echo lang("ctn_1716") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="opb_links">
              <a data-toggle="collapse" data-parent="#opb_links" href="#opb_links_c" class="collapsed <?php if(isset($activeLink['opb_detail'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_1717") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['opb_detail'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="opb_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['opb_detail'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['opb_detail']['customer'])) echo "active" ?>"><a href="<?php echo site_url("opb_details/customer") ?>"> <?php echo lang("ctn_1656") ?></a></li>
                <li class="<?php if(isset($activeLink['opb_detail']['supplier'])) echo "active" ?>"><a href="<?php echo site_url("opb_details/supplier") ?>"> <?php echo lang("ctn_1525") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="stm_links">
              <a data-toggle="collapse" data-parent="#stm_links" href="#stm_links_c" class="collapsed <?php if(isset($activeLink['stm_account'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-briefcase sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_1718") ?>
              <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['stm_account'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
              </a>
              <div id="stm_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['stm_account'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
              <?php if($this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                <li class="<?php if(isset($activeLink['stm_account']['customer'])) echo "active" ?>"><a href="<?php echo site_url("stm_account/customer_statement") ?>"> <?php echo lang("ctn_1656") ?></a></li>
                <li class="<?php if(isset($activeLink['stm_account']['supplier'])) echo "active" ?>"><a href="<?php echo site_url("stm_account/supplier_statement") ?>"> <?php echo lang("ctn_1525") ?></a></li>
              <?php endif; ?>
              </ul>
              </div>
            </li>

            <li id="accounting_links">
                  <a data-toggle="collapse" data-parent="#accounting_links" href="#accounting_links_c" class="collapsed <?php if(isset($activeLink['accounting'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1721") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['accounting'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="accounting_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['accounting'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">

                      <li id="income_links">
                        <a data-toggle="collapse" data-parent="#income_links" href="#income_links_c" class="collapsed <?php if(isset($activeLink['accounting']['direct_income']) || isset($activeLink['accounting']['indirect_income'])) echo "active" ?>" >
                        <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_580") ?>
                        <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['accounting']['direct_income']) || isset($activeLink['accounting']['indirect_income'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                        </a>
                        <div id="income_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['accounting']['direct_income']) || isset($activeLink['accounting']['indirect_income']))  echo "in" ?>">
                          <ul class="inner-sidebar-links">
                            <li class="<?php if(isset($activeLink['accounting']['direct_income'])) echo "active" ?>"><a  style="padding-left: 88px;" href="<?php echo site_url("accountings/direct_income") ?>"> <?php echo lang("ctn_1722") ?></a></li>
                            <li class="<?php if(isset($activeLink['accounting']['indirect_income'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/indirect_income") ?>"> <?php echo lang("ctn_1723") ?></a></li>
                          </ul>
                        </div>
                      </li>
                      
                      <li id="expense_links" >
                        <a data-toggle="collapse" data-parent="#expense_links" href="#expense_links_c" class="collapsed <?php if(isset($activeLink['accounting']['direct_expense']) || isset($activeLink['accounting']['indirect_expense'])) echo "active" ?>" >
                        <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1724") ?>
                        <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['accounting']['direct_expense']) || isset($activeLink['accounting']['indirect_expense'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                        </a>
                        <div id="expense_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['accounting']['direct_expense']) || isset($activeLink['accounting']['indirect_expense'])) echo "in" ?>">
                          <ul class="inner-sidebar-links">
                            <li class="<?php if(isset($activeLink['accounting']['direct_expense'])) echo "active" ?>"><a  style="padding-left: 88px;" href="<?php echo site_url("accountings/direct_expense") ?>"> <?php echo lang("ctn_1725") ?></a></li>
                            <li class="<?php if(isset($activeLink['accounting']['indirect_expense'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/indirect_expense") ?>"> <?php echo lang("ctn_1726") ?></a></li>
                          </ul>
                        </div>
                      </li>

                      <li class="<?php if(isset($activeLink['accounting']['expense_category'])) echo "active" ?>"><a href="<?php echo site_url("accountings/expense_category") ?>"> <?php echo lang("ctn_1727") ?></a></li>
                      <li class="<?php if(isset($activeLink['accounting']['expense_head'])) echo "active" ?>"><a href="<?php echo site_url("accountings/expense_head") ?>"> <?php echo lang("ctn_1728") ?></a></li>
                      <li class="<?php if(isset($activeLink['accounting']['receive_payment'])) echo "active" ?>"><a href="<?php echo site_url("accountings/receive_payment") ?>"> <?php echo lang("ctn_1729") ?></a></li>

                      <li id="purchase_bill_links" >
                        <a data-toggle="collapse" data-parent="#purchase_bill_links" href="#purchase_bill_links_c" class="collapsed <?php if(isset($activeLink['accounting']['pay_purchase_bill']) || isset($activeLink['accounting']['purchase_bill']) || isset($activeLink['accounting']['due_purchase_bill'])|| isset($activeLink['accounting']['over_due_purchase_bill'])) echo "active" ?>" >
                        <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1730") ?>
                        <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['accounting']['pay_purchase_bill']) || isset($activeLink['accounting']['purchase_bill'])|| isset($activeLink['accounting']['due_purchase_bill'])|| isset($activeLink['accounting']['over_due_purchase_bill'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                        </a>
                        <div id="purchase_bill_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['accounting']['pay_purchase_bill']) || isset($activeLink['accounting']['purchase_bill'])|| isset($activeLink['accounting']['due_purchase_bill'])|| isset($activeLink['accounting']['over_due_purchase_bill'])) echo "in" ?>">
                          <ul class="inner-sidebar-links">
                            <li class="<?php if(isset($activeLink['accounting']['pay_purchase_bill'])) echo "active" ?>"><a  style="padding-left: 88px;" href="<?php echo site_url("accountings/pay_purchase_bill") ?>"> <?php echo lang("ctn_1731") ?></a></li>
                            <li class="<?php if(isset($activeLink['accounting']['purchase_bill'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/purchase_bill") ?>"> <?php echo lang("ctn_1730") ?></a></li>
                            <li class="<?php if(isset($activeLink['accounting']['due_purchase_bill'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/due_purchase_bill") ?>"> <?php echo lang("ctn_1732") ?></a></li>
                             <li class="<?php if(isset($activeLink['accounting']['over_due_purchase_bill'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/over_due_purchase_bill") ?>"> <?php echo lang("ctn_1733") ?></a></li>
                             <li class="<?php if(isset($activeLink['accounting']['paid_purchase_bill'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/paid_purchase_bill") ?>"> <?php echo lang("ctn_1734") ?></a></li>
                             <li class="<?php if(isset($activeLink['accounting']['partialy_paid'])) echo "active" ?>"><a style="padding-left: 88px;" href="<?php echo site_url("accountings/partialy_paid") ?>"> <?php echo lang("ctn_1735") ?></a></li>
                          </ul>
                        </div>
                      </li>



                    </ul>
                  </div>
            </li>

            <?php if($this->settings->info->enable_reports && $this->common->has_permissions(array("admin", "project_admin", "reports_manage", "reports_worker"), $this->user)) : ?>
              <li id="quote_links">
                  <a data-toggle="collapse" data-parent="#reports_links" href="#reports_links_c" class="collapsed <?php if(isset($activeLink['reports'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_1141") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['reports'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="reports_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['reports'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li id="invoice_reports_links" >
                        <a data-toggle="collapse" data-parent="#invoice_reports_links" href="#invoice_reports_links_c" class="collapsed " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1149") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="invoice_reports_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="active" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_721") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1736") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1430") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1737") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1738") ?></a></li>
                          </ul>
                        </div>
                      </li>

                       <li id="sales_reports_links" >
                        <a data-toggle="collapse" data-parent="#sales_reports_links" href="#sales_reports_links_c" class="collapsed " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1739") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="sales_reports_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1740") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1741") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1742") ?></a></li>
                          </ul>
                        </div>
                      </li>

                      <li id="purchase_reports_links" >
                        <a data-toggle="collapse" data-parent="#purchase_reports_links" href="#purchase_reports_links_c" class=" " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1743") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="purchase_reports_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1747") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1748") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1742") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_721") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1736") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1430") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1737") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1738") ?></a></li>
                          </ul>
                        </div>
                      </li>

                      <li id="income_reports_links" >
                        <a data-toggle="collapse" data-parent="#income_reports_links" href="#income_reports_links_c" class=" " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1744") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="income_reports_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1722") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1723") ?></a></li>
                          </ul>
                        </div>
                      </li>

                      <li id="expense_reports_links" >
                        <a data-toggle="collapse" data-parent="#expense_reports_links" href="#expense_reports_links_c" class=" " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1724") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="expense_reports_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1745") ?></a></li>
        
                          </ul>
                        </div>
                      </li>

                      <li id="profit_links" >
                        <a data-toggle="collapse" data-parent="#profit_links" href="#profit_links_c" class=" " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1746") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="profit_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1747") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1748") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1742") ?></a></li>
        
                          </ul>
                        </div>
                      </li>

                      <li id="vat_reports_links" >
                        <a data-toggle="collapse" data-parent="#vat_reports_links" href="#vat_reports_links_c" class=" " >
                        <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1749") ?>
                        <span class="plus-sidebar"><span class="glyphicon glyphicon-menu-down"></span></span>
                        </a>
                        <div id="vat_reports_links_c" class="panel-collapse collapse sidebar-links-inner in">
                          <ul class="inner-sidebar-links">
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1750") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1751") ?></a></li>
                            <li class="" ><a  style="padding-left: 88px;" href="#"> <?php echo lang("ctn_1752") ?></a></li>
        
                          </ul>
                        </div>
                      </li>



                      
                    </ul>
                  </div>
              </li>
            <?php endif; ?>

          

            <?php if($this->settings->info->enable_calendar && $this->common->has_permissions(array("admin", "project_admin", "calendar_worker", "calendar_manage"), $this->user)) : ?>
              <li id="calendar_links">
                  <a data-toggle="collapse" data-parent="#calendar_links" href="#calendar_links_c" class="collapsed <?php if(isset($activeLink['calendar'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-calendar sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_693") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['calendar'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="calendar_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['calendar'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['calendar']['general'])) echo "active" ?>"><a href="<?php echo site_url("calendar") ?>"> <?php echo lang("ctn_694") ?></a></li>
                       <?php if($this->common->has_permissions(array("admin", "project_admin", "calendar_manage"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['calendar']['all'])) echo "active" ?>"><a href="<?php echo site_url("calendar/all") ?>"> <?php echo lang("ctn_695") ?></a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
           
            <?php if($this->settings->info->enable_files && $this->common->has_permissions(array("admin", "project_admin", "file_worker", "file_manage"), $this->user)) : ?>
              <li id="file_links">
                  <a data-toggle="collapse" data-parent="#file_links" href="#file_links_c" class="collapsed <?php if(isset($activeLink['file'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-file sidebar-icon sidebar-icon-brown"></span> <?php echo lang("ctn_700") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['file'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="file_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['file'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['file']['general'])) echo "active" ?>"><a href="<?php echo site_url("files") ?>"> <?php echo lang("ctn_701") ?></a></li>
                      <?php if($this->common->has_permissions(array("admin", "project_admin", "file_manage"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['file']['all'])) echo "active" ?>"><a href="<?php echo site_url("files/all") ?>"> <?php echo lang("ctn_702") ?></a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_team && $this->common->has_permissions(array("admin", "project_admin", "team_worker", "team_manage"), $this->user)) : ?>
              <li id="team_links">
                  <a data-toggle="collapse" data-parent="#team_links" href="#team_links_c" class="collapsed <?php if(isset($activeLink['team'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-user sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_1468") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['team'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="team_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['team'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['team']['general'])) echo "active" ?>"><a href="<?php echo site_url("team") ?>"> <?php echo lang("ctn_704") ?></a></li>
                      <?php if($this->common->has_permissions(array("admin", "project_admin", "team_manage"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['team']['all'])) echo "active" ?>"><a href="<?php echo site_url("team/all") ?>"> <?php echo lang("ctn_705") ?></a></li>
                        <li class="<?php if(isset($activeLink['team']['roles'])) echo "active" ?>"><a href="<?php echo site_url("team/roles") ?>"> <?php echo lang("ctn_706") ?></a></li>
                        <li class="<?php if(isset($activeLink['team']['all_users'])) echo "active" ?>"><a href="<?php echo site_url("team/users") ?>"> <?php echo lang("ctn_47") ?></a></li>
                      <?php endif; ?>
                      <li class="<?php if(isset($activeLink['team']['clients'])) echo "active" ?>"><a href="<?php echo site_url("team/clients") ?>"> <?php echo lang("ctn_1469") ?></a></li>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_time && $this->common->has_permissions(array("admin", "project_admin", "time_worker", "time_manage"), $this->user)) : ?>
              <li id="time_links">
                  <a data-toggle="collapse" data-parent="#time_links" href="#time_links_c" class="collapsed <?php if(isset($activeLink['time'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-time sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_707") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['time'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="time_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['time'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['time']['general'])) echo "active" ?>"><a href="<?php echo site_url("time") ?>"> <?php echo lang("ctn_708") ?></a></li>
                      <?php if($this->common->has_permissions(array("admin", "project_admin", "time_manage"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['time']['all'])) echo "active" ?>"><a href="<?php echo site_url("time/all") ?>"> <?php echo lang("ctn_709") ?></a></li>
                      <?php endif; ?>
                      <li class="<?php if(isset($activeLink['time']['stats'])) echo "active" ?>"><a href="<?php echo site_url("time/stats") ?>"> <?php echo lang("ctn_710") ?></a></li>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_tickets && $this->common->has_permissions(array("admin", "project_admin", "ticket_worker", "ticket_manage", "ticket_client"), $this->user)) : ?>
              <li id="tickets_links">
                  <a data-toggle="collapse" data-parent="#tickets_links" href="#tickets_links_c" class="collapsed <?php if(isset($activeLink['tickets'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-send sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_711") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['tickets'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="tickets_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['tickets'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                    <?php if($this->common->has_permissions(array("admin", "project_admin", "ticket_manage", "ticket_worker"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['tickets']['general'])) echo "active" ?>"><a href="<?php echo site_url("tickets") ?>"> <?php echo lang("ctn_711") ?></a></li>
                      <li class="<?php if(isset($activeLink['tickets']['your'])) echo "active" ?>"><a href="<?php echo site_url("tickets/your") ?>"> <?php echo lang("ctn_712") ?></a></li>
                    <?php endif; ?>
                       <?php if($this->common->has_permissions(array("admin", "project_admin", "ticket_manage"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['tickets']['departments'])) echo "active" ?>"><a href="<?php echo site_url("tickets/departments") ?>"> <?php echo lang("ctn_713") ?></a></li>
                        <li class="<?php if(isset($activeLink['tickets']['custom'])) echo "active" ?>"><a href="<?php echo site_url("tickets/custom") ?>"> <?php echo lang("ctn_714") ?></a></li>
                      <?php endif; ?>
                      <?php if($this->common->has_permissions(array("admin", "project_admin", "ticket_manage", "ticket_client"), $this->user)) : ?>
                        <li class="<?php if(isset($activeLink['tickets']['client'])) echo "active" ?>"><a href="<?php echo site_url("tickets/client") ?>"> <?php echo lang("ctn_715") ?></a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_finance && $this->common->has_permissions(array("admin", "project_admin", "finance_worker", "finance_manage"), $this->user)) : ?>
              <li id="finance_links">
                  <a data-toggle="collapse" data-parent="#finance_links" href="#finance_links_c" class="collapsed <?php if(isset($activeLink['finance'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-piggy-bank sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_716") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['finance'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="finance_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['finance'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['finance']['general'])) echo "active" ?>"><a href="<?php echo site_url("finance") ?>"> <?php echo lang("ctn_717") ?></a></li>
                       <?php if($this->common->has_permissions(array("admin", "project_admin", "finance_manage"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['finance']['all'])) echo "active" ?>"><a href="<?php echo site_url("finance/all") ?>"> <?php echo lang("ctn_718") ?></a></li>
                        <li class="<?php if(isset($activeLink['finance']['cats'])) echo "active" ?>"><a href="<?php echo site_url("finance/categories") ?>"> <?php echo lang("ctn_719") ?></a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_invoices && $this->common->has_permissions(array("admin", "project_admin", "invoice_manage", "invoice_client"), $this->user)) : ?>
              <li id="invoice_links">
                  <a data-toggle="collapse" data-parent="#invoice_links" href="#invoice_links_c" class="collapsed <?php if(isset($activeLink['invoice'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-credit-card sidebar-icon sidebar-icon-pink"></span> <?php echo lang("ctn_720") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['invoice'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="invoice_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['invoice'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                    <?php if($this->common->has_permissions(array("admin", "project_admin", "invoice_manage"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['invoice']['general'])) echo "active" ?>"><a href="<?php echo site_url("invoices") ?>"> <?php echo lang("ctn_721") ?></a></li>
                      <li class="<?php if(isset($activeLink['invoice']['reoccuring'])) echo "active" ?>"><a href="<?php echo site_url("invoices/reoccuring") ?>"> <?php echo lang("ctn_722") ?></a></li>
                      <li class="<?php if(isset($activeLink['invoice']['templates'])) echo "active" ?>"><a href="<?php echo site_url("invoices/templates") ?>"> <?php echo lang("ctn_723") ?></a></li>
                      <li class="<?php if(isset($activeLink['invoice']['pay'])) echo "active" ?>"><a href="<?php echo site_url("invoices/paying_accounts") ?>"> <?php echo lang("ctn_1341") ?></a></li>
                      <li class="<?php if(isset($activeLink['invoice']['items'])) echo "active" ?>"><a href="<?php echo site_url("invoices/items") ?>"> <?php echo lang("ctn_1470") ?></a></li>
                    <?php endif; ?>
                      <li class="<?php if(isset($activeLink['invoice']['client'])) echo "active" ?>"><a href="<?php echo site_url("invoices/client") ?>"> <?php echo lang("ctn_724") ?></a></li>
                    </ul>
                  </div>
              </li>
	    <?php endif; ?>
            
            <?php if($this->settings->info->enable_notes && $this->common->has_permissions(array("admin", "project_admin", "notes_manage", "notes_worker"), $this->user)) : ?>
              <li id="notes_links">
                  <a data-toggle="collapse" data-parent="#notes_links" href="#notes_links_c" class="collapsed <?php if(isset($activeLink['notes'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-pencil sidebar-icon sidebar-icon-brown"></span> <?php echo lang("ctn_725") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['notes'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="notes_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['notes'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                    <?php if($this->common->has_permissions(array("admin", "project_admin", "notes_manage"), $this->user)) : ?>
                      <li class="<?php if(isset($activeLink['notes']['general'])) echo "active" ?>"><a href="<?php echo site_url("notes") ?>"> <?php echo lang("ctn_726") ?></a></li>
                    <?php endif; ?>
                      <li class="<?php if(isset($activeLink['notes']['your'])) echo "active" ?>"><a href="<?php echo site_url("notes/your") ?>"> <?php echo lang("ctn_727") ?></a></li>
                      <li class="<?php if(isset($activeLink['notes']['personal'])) echo "active" ?>"><a href="<?php echo site_url("notes/personal") ?>"> <?php echo lang("ctn_1471") ?></a></li>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_leads && $this->common->has_permissions(array("admin", "project_admin", "lead_manage"), $this->user)) : ?>
              <li id="quote_links">
                  <a data-toggle="collapse" data-parent="#lead_links" href="#lead_links_c" class="collapsed <?php if(isset($activeLink['lead'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-blackboard sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_728") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['lead'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="lead_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['lead'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['lead']['general'])) echo "active" ?>"><a href="<?php echo site_url("leads") ?>"> <?php echo lang("ctn_728") ?></a></li>
                      <li class="<?php if(isset($activeLink['lead']['your'])) echo "active" ?>"><a href="<?php echo site_url("leads/your") ?>"> <?php echo lang("ctn_1342") ?></a></li>
                      <li class="<?php if(isset($activeLink['lead']['forms'])) echo "active" ?>"><a href="<?php echo site_url("leads/forms") ?>"> <?php echo lang("ctn_729") ?></a></li>
                      <li class="<?php if(isset($activeLink['lead']['manage'])) echo "active" ?>"><a href="<?php echo site_url("leads/manage") ?>"> <?php echo lang("ctn_1343") ?></a></li>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_services && $this->common->has_permissions(array("admin", "project_admin", "services_manage"), $this->user)) : ?>
              <li id="services_links">
                  <a data-toggle="collapse" data-parent="#services_links" href="#services_links_c" class="collapsed <?php if(isset($activeLink['services'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-th-list sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_1215") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['services'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="services_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['services'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['services']['general'])) echo "active" ?>"><a href="<?php echo site_url("services") ?>"> <?php echo lang("ctn_1215") ?></a></li>
                      <li class="<?php if(isset($activeLink['services']['orders'])) echo "active" ?>"><a href="<?php echo site_url("services/orders") ?>"> <?php echo lang("ctn_1216") ?></a></li>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>
            <?php if($this->settings->info->enable_reports && $this->common->has_permissions(array("admin", "project_admin", "reports_manage", "reports_worker"), $this->user)) : ?>
              <li id="quote_links">
                  <a data-toggle="collapse" data-parent="#reports_links" href="#reports_links_c" class="collapsed <?php if(isset($activeLink['reports'])) echo "active" ?>" >
                    <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_1141") ?>
                    <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['reports'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                  </a>
                  <div id="reports_links_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['reports'])) echo "in" ?>">
                    <ul class="inner-sidebar-links">
                      <li class="<?php if(isset($activeLink['reports']['general'])) echo "active" ?>"><a href="<?php echo site_url("reports") ?>"> <?php echo lang("ctn_1146") ?></a></li>
                      <?php if($this->settings->info->enable_time) : ?>
                        <li class="<?php if(isset($activeLink['reports']['time'])) echo "active" ?>"><a href="<?php echo site_url("reports/time") ?>"> <?php echo lang("ctn_1147") ?></a></li>
                      <?php endif; ?>
                      <li class="<?php if(isset($activeLink['reports']['finance'])) echo "active" ?>"><a href="<?php echo site_url("reports/finance") ?>"> <?php echo lang("ctn_1148") ?></a></li>
                      <li class="<?php if(isset($activeLink['reports']['invoices'])) echo "active" ?>"><a href="<?php echo site_url("reports/invoices") ?>"> <?php echo lang("ctn_1149") ?></a></li>
                    </ul>
                  </div>
              </li>
            <?php endif; ?>

            <li class="<?php if(isset($activeLink['settings']['general'])) echo "active" ?>"><a href="<?php echo site_url("user_settings") ?>"><span class="glyphicon glyphicon-cog sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_156") ?></a></li>


            <?php if($this->user->loggedin && isset($this->user->info->user_role_id) && 
              ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)

              ) : ?>
              <li id="admin_sb">
                <a data-toggle="collapse" data-parent="#admin_sb" href="#admin_sb_c" class="collapsed <?php if(isset($activeLink['admin'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-wrench sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_157") ?>
                  <span class="plus-sidebar"><span class="glyphicon <?php if(isset($activeLink['admin'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
                </a>
                <div id="admin_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['admin'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                   <li class="<?php if(isset($activeLink['admin']['general'])) echo "active" ?>"><a href="<?php echo site_url("admin") ?>"> <?php echo lang("ctn_682") ?></a></li>
                    <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
                      <li class="<?php if(isset($activeLink['admin']['settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/settings") ?>"> <?php echo lang("ctn_158") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['social_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/social_settings") ?>"> <?php echo lang("ctn_159") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['calendar_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/calendar_settings") ?>"> <?php echo lang("ctn_683") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['section'])) echo "active" ?>"><a href="<?php echo site_url("admin/section_settings") ?>"> <?php echo lang("ctn_684") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['date'])) echo "active" ?>"><a href="<?php echo site_url("admin/date_settings") ?>"> <?php echo lang("ctn_1134") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['chat'])) echo "active" ?>"><a href="<?php echo site_url("admin/chat_settings") ?>"> <?php echo lang("ctn_1338") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                    <li class="<?php if(isset($activeLink['admin']['members'])) echo "active" ?>"><a href="<?php echo site_url("admin/members") ?>"> <?php echo lang("ctn_160") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['custom_fields'])) echo "active" ?>"><a href="<?php echo site_url("admin/custom_fields") ?>"> <?php echo lang("ctn_714") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                    <li class="<?php if(isset($activeLink['admin']['user_roles'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_roles") ?>"> <?php echo lang("ctn_316") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                    <li class="<?php if(isset($activeLink['admin']['user_groups'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_groups") ?>"> <?php echo lang("ctn_161") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['ipblock'])) echo "active" ?>"><a href="<?php echo site_url("admin/ipblock") ?>"> <?php echo lang("ctn_162") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                      <li class="<?php if(isset($activeLink['admin']['tickets'])) echo "active" ?>"><a href="<?php echo site_url("admin/tickets") ?>"> <?php echo lang("ctn_685") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['email_templates'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_templates") ?>"> <?php echo lang("ctn_163") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                      <li class="<?php if(isset($activeLink['admin']['email_members'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_members") ?>"> <?php echo lang("ctn_164") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_payment) : ?>
                    <li class="<?php if(isset($activeLink['admin']['payment_currency'])) echo "active" ?>"><a href="<?php echo site_url("admin/currencies") ?>"> <?php echo lang("ctn_686") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['payment_logs'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_logs") ?>"><?php echo lang("ctn_288") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['payment_invoice'])) echo "active" ?>"><a href="<?php echo site_url("admin/invoice") ?>"> <?php echo lang("ctn_687") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                      <li class="<?php if(isset($activeLink['admin']['tools'])) echo "active" ?>"><a href="<?php echo site_url("admin/tools") ?>"> <?php echo lang("ctn_1192") ?></a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          
          
          </ul>
