<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12" id="small-table">
            <div class="panel_s">
               <div class="panel-body">
                <?php echo form_hidden('item_id',$item_id); ?>
                  <div class="row">
                     <div class="col-md-12">
                      <h4 class="no-margin font-bold"><i class="fa fa-clone menu-icon menu-icon" aria-hidden="true"></i> <?php echo _l($title); ?></h4>
                      <br>

                    </div>
                  </div>
                  <div class="row row-margin-bottom">
                    <div class="col-md-5  ">
                        <?php if (has_permission('purchase', '', 'create') || is_admin()) { ?>

                          <!-- dung cho add 1 -->
                        <a href="#" onclick="new_commodity_item(); return false;" class="btn btn-info pull-left display-block mr-4 button-margin-r-b" data-toggle="sidebar-right" data-target=".commodity_list-add-edit-modal">
                            <?php echo _l('add'); ?>
                        </a>
                        <?php } ?>
                    </div>
                    
                     <div class="col-md-1 pull-right">
                        <a href="#" class="btn btn-default pull-right btn-with-tooltip toggle-small-view hidden-xs" onclick="toggle_small_view_proposal('.proposal_sm','#proposal_sm_view'); return false;" data-toggle="tooltip" title="<?php echo _l('invoices_toggle_table_tooltip'); ?>"><i class="fa fa-angle-double-left"></i></a>
                    </div>
                    </div>

                    <div class="modal bulk_actions" id="table_commodity_list_bulk_actions" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h4 class="modal-title"><?php echo _l('bulk_actions'); ?></h4>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                 <?php if(has_permission('rec_proposal','','delete') || is_admin()){ ?>
                                 <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="mass_delete" id="mass_delete">
                                    <label for="mass_delete"><?php echo _l('mass_delete'); ?></label>
                                 </div>
                                
                                 <?php } ?>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>

                                 <?php if(has_permission('purchase','','delete') || is_admin()){ ?>
                                 <a href="#" class="btn btn-info" onclick="purchase_delete_bulk_action(this); return false;"><?php echo _l('confirm'); ?></a>
                                  <?php } ?>
                              </div>
                           </div>
                          
                        </div>
                        
                     </div>

                    <a href="#"  onclick="staff_bulk_actions(); return false;" data-toggle="modal" data-table=".table-table_item_list" data-target="#leads_bulk_actions" class=" hide bulk-actions-btn table-btn"><?php echo _l('bulk_actions'); ?></a>
                      <?php render_datatable(array(
                        '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="table_item_list"><label></label></div>',
                        _l('_images'),
                        _l('Vehicle_Make'),
                        _l('Vehicle_Model'),
                        _l('Vehicle_Type'),
                        _l('Number_Of_Passengers'),
                        _l('Extra_Time_Enable'),
                        _l('Base_Location'),
                        _l('Vehicle_Availability_Enable'),
                        _l('Price_Type_Variable'),
                        ),'table_item_list',['proposal_sm' => 'proposal_sm'],
                          array(
                            'proposal_sm' => 'proposal_sm',
                             'id'=>'table-table_item_list',
                             'data-last-order-identifier'=>'table_item_list',
                             'data-default-order'=>get_table_last_order('table_item_list'),
                           )); ?>
               </div>
            </div>
         </div>
         <div class="col-md-7 small-table-right-col">
            <div id="proposal_sm_view" class="hide">
            </div>
         </div>
      </div>
   </div>
   
</div>


    <div class="modal" id="purchase_type" tabindex="-1" role="dialog">
    <div class="modal-dialog ht-dialog-width">

          <?php echo form_open_multipart(admin_url('purchase/add_commodity_list'), array('id'=>'add_purchase_type')); ?>
          <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    <h4 class="modal-title">
                        <span class="add-title"><?php echo _l('add'); ?></span>
                    </h4>
                   
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                         <div id="purchase_type_id">
                         </div>   
                     <div class="form"> 
                        <div class="col-md-12" id="add_handsontable">
                        </div>
                          <?php echo form_hidden('hot_purchase_type'); ?>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button id="latch_assessor" type="button" class="btn btn-info intext-btn" onclick="add_purchase_type(this); return false;" ><?php echo _l('submit'); ?></button>
                </div>
                <?php echo form_close(); ?>
              </div>
              </div>
          </div>


  <!-- add one commodity list sibar start-->       

    <div class="modal" id="commodity_list-add-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog ht-dialog-width">

      <?php echo form_open_multipart(admin_url('purchase/commodity_list_add_edit'),array('class'=>'commodity_list-add-edit','autocomplete'=>'off')); ?>

          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    <span class="edit-commodity-title"><?php echo _l('edit_item'); ?></span>
                    <span class="add-commodity-title"><?php echo _l('add_item'); ?></span>
                </h4>
            </div>

            <div class="modal-body" style="padding:27px;">
                <div id="commodity_item_id"></div>
                <!-- interview process start -->
                  <div role="tabpanel" class="tab-pane active" id="interview_infor">
                    <div class="col-md-12" >
                      <div class="horizontal-scrollable-tabs">      
                        <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
                        <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
                        <div class="horizontal-tabs">
                          <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
                            <li role="presentation" class="<?php  if(!$this->input->get('tab')){echo 'active';}; ?>">
                                <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                                <?php echo _l( 'general'); ?>
                                </a>
                            </li>
                            <li role="presentation" >
                                <a href="#prices" aria-controls="prices" role="tab" data-toggle="tab">
                                <?php echo _l( 'prices'); ?>
                                </a>
                            </li>
                            <li role="presentation" >
                                <a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">
                                <?php echo _l( 'attributes'); ?>
                                </a>
                            </li>
                            <li role="availability" >
                                <a href="#availability" aria-controls="availability" role="tab" data-toggle="tab">
                                <?php echo _l( 'availability'); ?>
                                </a>
                            </li>
                            <li role="driving_zone" >
                                <a href="#driving_zone" aria-controls="driving_zone" role="tab" data-toggle="tab">
                                <?php echo _l( 'driving_zone'); ?>
                                </a>
                            </li>
                            <li role="google_calendar" >
                                <a href="#google_calendar" aria-controls="google_calendar" role="tab" data-toggle="tab">
                                <?php echo _l( 'google_calendar'); ?>
                                </a>
                            </li>
                          </ul>

                        </div>
                      </div>
                      <div class="tab-content mtop15">       
                        <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="general">     
                          <!--
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo render_input('commodity_code', 'commodity_code'); ?>
                                </div>
                                <div class="col-md-6">
                                  <?php echo render_input('description', 'commodity_name'); ?>
                                </div>
                                
                            </div>
                              
                            <div class="row">
                               <div class="col-md-4">
                                     <?php echo render_input('commodity_barcode', 'commodity_barcode','','text'); ?>
                                </div>
                              <div class="col-md-4">
                                <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle skucode-tooltip"  data-toggle="tooltip" title="" data-original-title="<?php echo _l('commodity_sku_code_tooltip'); ?>"></i></a>
                                <?php echo render_input('sku_code', 'sku_code','',''); ?>
                              </div>
                              <div class="col-md-4">
                                <?php echo render_input('sku_name', 'sku_name'); ?>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                    <?php echo render_textarea('long_description', 'description'); ?>
                              </div>
                            </div>

                            <div class="row">
                              
                                <div class="col-md-6">
                                     <?php echo render_select('group_id',$commodity_groups,array('id','name'),'commodity_group'); ?>
                                </div>
                                 <div class="col-md-6">
                                     <?php echo render_select('sub_group',$sub_groups,array('id','sub_group_name'),'sub_group'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                     <?php $premium_rates = isset($premium_rates) ? $premium_rates : '' ?>
                                    <?php
                                    $attr = array();
                                    $attr = ['data-type' => 'currency'];
                                     echo render_input('rate', 'rate','', 'text', $attr); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php 
                                    $attr = array();
                                    $attr = ['data-type' => 'currency'];
                                     echo render_input('purchase_price', 'purchase_price','', 'text', $attr); ?>
                                  
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                     <?php echo render_select('unit_id',$units,array('unit_type_id','unit_name'),'units'); ?>
                                </div>
                                
                              <div class="col-md-6">
                                     <?php echo render_select('tax',$taxes,array('id','label'),'taxes'); ?>
                                </div>

                            </div>
                            <small class="req text-danger">*</small> 
                           -->     
                            <div class="row">
                              <div class="col-md-6">
                                <label class=" vehicle-detail-subtitle"> DEFAULT CATEGORY VEHICLE </label> <br>
                                <div class="btn-group btn-toggle" name="default_category_enable"> 
                                  <button class="btn btn-default">ENABLE</button>
                                  <button class="btn btn-primary active">DISABLE</button>
                                  <input type="hidden" name="default_category_enable"> 
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label for="group_id" class="control-label  vehicle-detail-subtitle">
                                  VEHICLE TYPE
                                </label><br>
                                <span class="vehicle-detail-explanation"> vehicle type </span>
                                <select id="group_id" name="group_id" class="form-control">  
                                  <?php 
                                  foreach($commodity_groups as $group)
                                  {?>
                                  <option value=<?php echo $group['id']; ?>> <?php echo $group['name']; ?> </option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                                  
                            <div class="row">
                              <div class="col-md-6">
                                <label for="vehicle_make" class="control-label  vehicle-detail-subtitle">
                                  VEHICLE MAKE
                                </label><br>
                                <span class="vehicle-detail-explanation"> vehicle make </span>
                                <input type="text" id="vehicle_make" name="vehicle_make" class="form-control">  
                              </div>
                              <div class="col-md-6" >
                                <label for="vehicle_model" class="control-label  vehicle-detail-subtitle">
                                  VEHICLE MODEL
                                </label><br>
                                <span class="vehicle-detail-explanation"> vehicle model </span>
                                <input type="text" id="vehicle_model" name="vehicle_model" class="form-control"> 
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <label for="number_of_passengers" class="control-label  vehicle-detail-subtitle">
                                  NUMBER OF PASSENGERS
                                </label><br>
                                <span class="vehicle-detail-explanation">
                                  Maximum number of passengers (or seats). Integer value from 1 to 99
                                </span>
                                <input type="number" min="1" max="99" id="number_of_passengers" name="number_of_passengers" class="form-control"> 
                              </div>
                              <div class="col-md-6" >
                                <label for="number_of_suitcases" class="control-label  vehicle-detail-subtitle">
                                  NUMBER OF SUITCASES
                                </label><br>
                                <span class="vehicle-detail-explanation">
                                  Maximum number of suitcases. Integer value from 1 to 99
                                </span>
                                <input type="number" min="1" max="99" id="number_of_suitcases" name="number_of_suitcases" class="form-control">  
                              </div>
                            </div>
                           
                            <div class="row" style="margin-top:10px;">
                              <div class ="col-md-6"> 
                                <span class=" vehicle-detail-subtitle"> EXTRA TIME</span> <br>
                                <span class="vehicle-detail-explanation">
                                  Choose whether you want to offer the option of extra time (in hours).
                                  <br> This option is available for <b>Distance</b> and <b>Flat rate</b> services only. <br>
                                </span>

                                <div class="btn-group btn-toggle" name="extra_time_enable"> 
                                  <button class="btn btn-default">ENABLE</button>
                                  <button class="btn btn-primary active">DISABLE</button>
                                  <input type="hidden" name="extra_time_enable"> 

                                </div> <br>
                                <span class="vehicle-detail-explanation">
                                  Specify the minimum (integer value from 0 to 9999) and maximum (integer value from 1 to 9999) extra time in hours.
                                  <br>
                                </span>
                                <input type="number" min="0" max="9999" placeholder="Min" id="extra_time_min" 
                                  name="extra_time_min" class="form-control">
                                <input style="margin-top:10px;" type="number" min="1" max="9999" placeholder="Max" id="extra_time_max"
                                   name="extra_time_max" class="form-control">
                                <span class="vehicle-detail-explanation">
                                  Step (integer value from 1 to 9999):
                                  <br>
                                </span>
                                <input style="margin-top:10px;" type="number" min="1" max="9999" placeholder="Step" id="extra_time_step" 
                                  name="extra_time_step" class="form-control">
                              </div>
                              <div class ="col-md-6">
                                <label for="base_location" class="control-label  vehicle-detail-subtitle">
                                  BASE LOCATION
                                </label><br>
                                <span class="vehicle-detail-explanation"> 
                                  Company base location.
                                  If it is set up, then the cost of ride from base location to pick up location will be added to sum of 
                                  the order. This option is not available for <b>Flat rate </b> service type.
                                </span>
                                <input type="text" id="base_location" name="base_location" class="form-control"> 
                              </div>

                            </div>
                           
                            <div class="row" style="margin-top:10px;">
                              <div class ="col-md-6"> 
                                <span class=" vehicle-detail-subtitle"> VEHICLES AVAILABILITY</span> <br>
                                <span class="vehicle-detail-explanation">
                                  Enables the option if you would like to prevent against sending orders which contain
                                  vehicles added to other orders with the same date/time of the ride.<br>
                                </span>

                                <div class="btn-group btn-toggle" name="vehicle_availability_enable"> 
                                  <button class="btn btn-default">ENABLE</button>
                                  <button class="btn btn-primary active">DISABLE</button>
                                  <input type="hidden" name="vehicle_availability_enable"> 

                                </div> <br>
                              </div>
                              <div class ="col-md-6">
                                <label for="base_location" class="control-label  vehicle-detail-subtitle">
                                  BOOKINGS INTERVAl
                                </label><br>
                                <span class="vehicle-detail-explanation"> 
                                  Set interval (in minutes)  between bookings which contain the same vehicle.
                                </span>
                                <input type="number" min="1" max="999" placeholder="Max" id="bookings_interval"
                                   name="bookings_interval" class="form-control" value="1"> 
                              </div>

                            </div>
                            
                            <div class="row" style="margin-top:10px;">
                              <div class="col-md-12">
                                <span class=" vehicle-detail-subtitle"> FIXED LOCATIONS </span> <br>
                                <span class="vehicle-detail-explanation">
                                  Enter fixed pickup/drop off location for selected service.<br>
                                </span>

                                <table class="table table-bordered table-striped">
                                  <thead class="table-header">
                                    <tr>
                                      <th> Service </th>
                                      <th> Pickup location </th>
                                      <th> Drop off location </th>
                                    <tr>  
                                  </thead> 
                                  <tbody>
                                    <tr>
                                      <td> Distance </td>
                                      <td> Italy </td>
                                      <td> Belgium </td>
                                    <tr>
                                    <tr>
                                      <td> Hourly </td>
                                      <td> France </td>
                                      <td> Belgium </td>
                                    <tr>   
                                  </tbody>  
                                </table>
                              </div>
                            </div>
                            <?php if(!isset($expense) || (isset($expense) && $expense->attachment == '')){ ?>
                            <div id="dropzoneDragArea" class="dz-default dz-message">
                               <span><?php echo _l('item_add_edit_attach_image'); ?></span>
                            </div>
                            <div class="dropzone-previews"></div>
                            <?php } ?>

                            <div id="images_old_preview">
                            </div>
                           
                        </div>   
                        <div role="tabpanel" class="tab-pane" id="prices">
                          <div class="row">
                            <div class ="col-md-12"> 
                                <span class=" vehicle-detail-subtitle"> PRICE TYPE</span> <br>
                                <span class="vehicle-detail-explanation">
                                  Select a price type.<br>
                                  For a <b>Variable pricing</b> final price of the ride depends on distance or time.
                                  For a <b>Fixed pricing</b> final price of the ride is independent on distance or time.<br>
                                </span>

                                <div class="btn-group btn-toggle" name="price_type_variable"> 
                                  <button class="btn btn-default">Variable pricing</button>
                                  <button class="btn btn-primary active">Fixed pricing</button>
                                  <input type="hidden" name="price_type_variable"> 
                                </div> <br>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                <span class=" vehicle-detail-subtitle"> PRICES</span> <br>
                                <span class="vehicle-detail-explanation">
                                Net prices.<br> </span>
                                <table class="table table-bordered table-striped">
                                  <thead class="table-header">
                                    <tr>
                                      <th> Name </th>
                                      <th> Type </th>
                                      <th> Description </th>
                                      <th> Value </th>
                                      <th> Tax </th>
                                    <tr>  
                                  </thead> 
                                  <tbody>
                                    <tr>
                                      <td> Fixed </td>
                                      <td> Fixed </td>
                                      <td> Fixed price of a ride. </td>
                                      <td> 0.234 </td>
                                      <td> No Tax </td>
                                    <tr>
                                    <tr>
                                      <td> Initial </td>
                                      <td> Variable </td>
                                      <td> sdfdsf </td>
                                      <td> sdfsdf </td>
                                      <td> sdfdsf </td>
                                    <tr>   
                                  </tbody>  
                                </table>
                                </span>
                              </div>  
                          </div>      
                          <div class="row">
                              <div class="col-md-12">
                                <span class=" vehicle-detail-subtitle"> BUS RENTAl PRICES</span> <br>
                                <table class="table table-bordered table-striped">
                                  <thead class="table-header">
                                    <tr>
                                      <th> Name </th>
                                      <th> Type </th>
                                      <th> Description </th>
                                      <th> Value </th>
                                      <th> Tax </th>
                                    <tr>  
                                  </thead> 
                                  <tbody>
                                    <tr>
                                      <td> Fixed </td>
                                      <td> Fixed </td>
                                      <td> Fixed price of a ride. </td>
                                      <td> 0.234 </td>
                                      <td> No Tax </td>
                                    <tr>
                                    <tr>
                                      <td> Initial </td>
                                      <td> Variable </td>
                                      <td> sdfdsf </td>
                                      <td> sdfsdf </td>
                                      <td> sdfdsf </td>
                                    <tr>   
                                  </tbody>  
                                </table>
                                </span>
                              </div>  
                          </div>  
                        </div> 
                        <div role="tabpanel" class="tab-pane" id="attributes">
                          <div class="row">
                              <div class="col-md-12">
                                <label for="attribute_table" class="control-label  vehicle-detail-subtitle">
                                  ATTRIBUTES
                                </label><br>
                                <span class="vehicle-detail-explanation"> 
                                  Specify attributes of the vehicle. <br>
                                </span>
                                <table class="table table-bordered table-striped" id="attribute_table">
                                  <thead class="table-header">
                                    <tr>
                                      <th style="min-width:10vw;"> Attribute name </th>
                                      <th> Attribute value </th>
                                    </tr>  
                                  </thead> 
                                  <tbody>
                                    <tr>
                                      <td> Drivers Language </td>
                                      <td> 
                                        <div class="row">
                                          <div class="form-group">
                                            <div class="lang-select">
                                            <?php foreach($langs as $lang)
                                              {
                                              ?>
                                              <div class="items col-md-2 " lang="<?php echo $lang['name'] ?>">
                                                  <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                      <label class="btn btn-default">
                                                          <div class="bizcontent">
                                                              <input type="checkbox" data-lang="<?php echo $lang['value']; ?>" autocomplete="off" >
                                                              <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                              <h6><?php echo $lang['name'] ?></h6>
                                                          </div>
                                                      </label>
                                                  </div>
                                              </div>
                                              <?php } ?>  
                                            </div>
                                          </div>  
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td> Meet & Greet included </td>
                                      <td> 
                                        <div class="btn-group btn-toggle" name="meet_included_enable"> 
                                          <button class="btn btn-default">No</button>
                                          <button class="btn btn-primary active">Yes</button>
                                          <input type="hidden" name="meet_included_enable"> 

                                        </div>
                                      </td>
                                    </tr>   
                                  </tbody>
                                </table>     
                              </div>  
                          </div>  
                        </div> 
                        <div role="tabpanel" class="tab-pane" id="availability">
                          <div class="row">
                            <div class="col-md-12">
                              <span class=" vehicle-detail-subtitle"> EXCLUDE DATES</span> <br>
                              <span class="vehicle-detail-explanation">
                              Specify dates in which vehicle is not available. Past (or invalid date ranges) will be removed during saving.<br>
                              </span>
                              <table class="table table-bordered table-striped">
                                <thead class="table-header">
                                  <tr>
                                    <th colspan="2"> Start Date </th>
                                    <th colspan="2"> End Date </th>
                                    <th> Remove </th>
                                  <tr>  
                                </thead> 
                                <tbody>
                                  <tr>
                                    <td> start date </td>
                                    <td> start time </td>
                                    <td> end date </td>
                                    <td> end time </td>
                                    <td> Remove </td>
                                  <tr>
                                 
                                </tbody>  
                              </table>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <span class=" vehicle-detail-subtitle"> BUSINESS HOURS </span> <br>
                              <span class="vehicle-detail-explanation">
                                Specify working days/hours.<br>
                                Leave all fields empty if booking is not available for selected day.<br>
                              </span>
                              <table class="table table-bordered table-striped">
                                <thead class="table-header">
                                  <tr>
                                    <th > Weekday </th>
                                    <th > Start Time </th>
                                    <th> End Time </th>
                                  <tr>  
                                </thead> 
                                <tbody>
                                  <tr>
                                    <td> Monday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>
                                  <tr>
                                    <td> Tuesday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>
                                  <tr>
                                    <td> Wednesday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>
                                  <tr>
                                    <td> Thursday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>
                                  <tr>
                                    <td> Friday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>
                                  <tr>
                                    <td> Saturday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>
                                  <tr>
                                    <td> Sunday </td>
                                    <td> 00:00 </td>
                                    <td> 12:00 </td>
                                  </tr>            
                                </tbody>  
                              </table>
                            </div>
                          </div>     
                        </div>
                        <div role="tabpanel" class="tab-pane" id="driving_zone">
                          <div class="row">
                            <div class="col-md-12">
                              <label for="attribute_countries" class="control-label  vehicle-detail-subtitle">
                                  COUNTRIES
                              </label><br>
                              <span class="vehicle-detail-explanation"> 
                              Select countries in which customer can put ride locations (waypoints).
                              Due the Google API restrictions, you can set up to 5 such countries. <br>
                              </span>
                              <select style="max-width: 500px; z-index:-1" class="form-control" id="attribute_countries" name="attribute_countries" multiple="multiple">
                                </option><option value="AF">Afghanistan</option>
                                <option value="AX">Aland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua And Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE" selected="">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                              </select>
                            </div>                       
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <label for="attribute_countries" class="control-label  vehicle-detail-subtitle">
                                  CUSTOM DRIVING ZONE
                              </label><br>
                              <span class="vehicle-detail-explanation"> 
                              To create your own, restricted ride zone, draw a shape using tool located in top part of the map.
                              To start modify or create a new area, you have to remove previously defined shape. <br>
                              </span>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-6" >
                              <h4 class="text-center"> Pickup location </h4>
                              <div id="map_src" class="map" > </div>
                            </div>
                            <div class="col-md-6" >
                              <h4 class="text-center"> Drop off location </h4>
                              <div id="map_dest" class="map" > </div>
                            </div>                     
                          </div>     
                        </div> 
                        <div role="tabpanel" class="tab-pane" id="google_calendar">
                          <div class="row">
                            <div class ="col-md-12"> 
                                <span class=" vehicle-detail-subtitle"> GOOGLE CALENDAR </span> <br>
                                <span class="vehicle-detail-explanation">
                                  Enable or disable integration with Google Calendar.<br>
                                </span>

                                <div class="btn-group btn-toggle" name="google_calendar_enable"> 
                                  <button class="btn btn-default">Enable</button>
                                  <button class="btn btn-primary active">Disable</button>
                                  <input type="hidden" name="google_calendar_enable"> 
                                </div> <br>
                              </div>
                          </div>
                          <div class="row">
                            <div class ="col-md-6">
                              <label for="google_calendar_id" class="control-label  vehicle-detail-subtitle">
                                ID
                              </label><br>
                              <span class="vehicle-detail-explanation"> 
                              Google Calendar ID.
                              </span>
                              <input type="text"  placeholder="ID" id="google_calendar_id"
                                  name="google_calendar_id" class="form-control"> 
                            </div>
                            <div class ="col-md-6">
                              <label for="google_calendar_settings" class="control-label  vehicle-detail-subtitle">
                                SETTINGS
                              </label><br>
                              <span class="vehicle-detail-explanation"> 
                                Copy/paste the contents of downloaded *.json file.
                              </span>
                              <textarea placeholder="JSON CONTENT" id="google_calendar_settings" style="height:100px;"
                                  name="google_calendar_settings" class="form-control">  </textarea>
                            </div>
                          </div>
                        </div>
                      </div>      
                    </div>

                        
                  </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit"  class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
          </div>

          </div>
        </div><!-- /.modal-content -->
      <?php echo form_close(); ?>

<!-- add one commodity list sibar end -->   

<?php init_tail(); ?>
</body>

</html>
<script>
  var user_type = 'admin';
</script>
<?php require 'modules/purchase/assets/js/item_list_js.php';?>
