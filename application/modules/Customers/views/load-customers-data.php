
   <section id="content">
      <div class="page page-tables-bootstrap">
         <div class="row">
            <div class="col-md-12">
               <section class="tile" >
                  <input type="hidden" id="json_contact" value='<?=$json_contact;?>'>
                  <input type="hidden" id="json_orgnization" value='<?=$json_orgnization;?>'>
                  <div class="pageheader tile-bg">
                     <h3>Customers</h3>
                     <div class="page-bar">
                        <form method="get" class="mt-20">
                           <ul class="page-breadcrumb">
                              <div class="btn-toolbar ml-0 pull-left">
                                 <div class="btn-group">
                                    <input type="text" name="nameSearch" id="nameSearch" class="input-sm form-control inline input-customers" placeholder="Name" value="<?=$_GET['nameSearch'];?>">
                                 </div>
                              </div>
                           </ul>
                           <ul class="page-breadcrumb">
                              <div class="btn-toolbar ml-0 pull-left">
                                 <div class="btn-group">
                                    <input type="text" name="mobileSearch" id="mobileSearch" class="input-sm form-control inline input-customers" placeholder="Mobile" maxlength="10" minlength="10" value="<?=$_GET['mobileSearch'];?>">
                                 </div>
                              </div>
                           </ul>
                           <ul class="page-breadcrumb" style="display: none;">
                              <div class="btn-toolbar ml-0 pull-left">
                                 <div class="btn-group">
                                    <input type="email" name="emailSearch" id="emailSearch" class="input-sm form-control inline input-customers" placeholder="Email" value="<?=$_GET['emailSearch'];?>">
                                 </div>
                              </div>
                           </ul>
                           <ul class="page-breadcrumb">
                              <div class="btn-toolbar ml-0 pull-left">
                                 <div class="btn-group" style="width: 140px;">
                                    <div class='input-group date datetimepicker_report'>
                                       <input type='text' class="input-sm form-control" name="from_date" value="<?=$_GET['from_date'];?>" placeholder="Date From">
                                       <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                    </div>
                                 </div>
                              </div>
                           </ul>
                           <ul class="page-breadcrumb">
                              <div class="btn-toolbar ml-0 pull-left">
                                 <div class="btn-group" style="width: 140px;">
                                    <div class='input-group date datetimepicker_report'>
                                       <input type='text' class="input-sm form-control" name="to_date" value="<?=$_GET['to_date'];?>" placeholder="Date To">
                                       <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                    </div>
                                 </div>
                              </div>
                           </ul>
                           <button class="btn modal-nxt" type="submit" style="margin: -23px 0px 0px 5px;" value="search" name="search">Search</button>
                           <button class="btn modal-nxt" type="reset" onclick="ResetCustomer();" style="margin: -23px 0px 0px 5px;">Reset</button>
                           <a href="<?=base_url('Customers/import_customer');?>" class="btn btn-danger btn-customer">Import Customer</a>                            
                        </form>                        

                     </div>
                  </div>
                  <!--pageheader close-->
                  <div id="listingData">
                     <!-- listdataid -->
                     <div class="tile-widget-to tile-widget-top">
                        <div class="show-entries">
                           <div class="row">
                              <div class="col-sm-5">
                                 <div style="line-height:30px;">
                                    Show&nbsp;
                                    <select class="btn btn-default btn-sm" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('Customers/manage_customers').'?filter='.$_GET['filter'].'&nameSearch='.$_GET['nameSearch'].'&mobileSearch='.$_GET['mobileSearch'].'&emailSearch='.$_GET['emailSearch'].'&search='.$_GET['search'];?>">
                                       <option value="10">10</option>
                                       <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                                       <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                                       <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
                                       <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
                                       <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
                                    </select>
                                    &nbsp;entries
                                 </div>
                              </div>
                              <div class="col-sm-4"></div>
                              <div class="col-sm-3">
                                 <div class="input-group">
                                    <input type="text" class="input-sm form-control" id="searchTerm"  onkeyup="doSearch()" placeholder="Search...">
                                    <span class="input-group-btn">
                                    </span> 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- tile body -->
                     <div class="tile-body p-0">
                        <div class="table-responsive table-overflow__">
                           <table class="table mb-0 table-hover">
                              <thead>

                                 <tr class="row-color">
                                    <th>Mobile No</th>
                                    <th>Name</th>
                                    <th>Source</th>
                                    <th>Anniversary</th>
                                    <th>Birthday</th>
                                    <th>Visit</th>
                                    <th>Last Visit</th>
                                    <th style="text-align: right;">Action</th>
                                 </tr>
                              </thead>
                              <tbody id="dataTable">
                                 <?php 
                                    foreach ($result as $get_list) {
                                    ?>
                                 <tr class="record">
                                    <td>
                                       <a href="<?=base_url();?>Customers/view_customers?id=<?=$get_list->customer_id
                                          ?>" ><?php echo $get_list->mobile_no; ?></a>
                                    </td>
                                    <td><?php echo $get_list->first_name." ".$get_list->last_name; ?></td>
                                    <td><?php echo $get_list->source; ?></td>
                                    <td><?php echo $get_list->anniversary; ?></td>
                                    <td><?php echo $get_list->date_of_birth; ?></td>
                                    <td><?php echo $get_list->visit_count; ?></td>
                                    <td><?php echo $get_list->last_visit; ?></td>
                                    <td>
                                       <?php 
                                          $pri_col='customer_id';
                                          $table_name='tbl_customers';
                                          ?>
                                       <div class="btn-group pull-right">
                                          <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                          <ul class="dropdown-menu" role="menu">
                                             <li><a href="#" onclick="editCustomer(this);" property = "edit" type="button" data-toggle="modal" data-target="#customerModal" arrt= '<?=json_encode($get_list);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This Customer</a></li>
                                             <li><a href="#" class="delbutton_customers" id="<?php echo $get_list->customer_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This Customer</a></li>
                                          </ul>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- /tile body -->
                     <!-- tile footer -->
                     <div class="tile-footer dvd dvd-top" style="height: 55px">
                        <div class="row">
                           <div class="col-sm-5 hidden-xs">
                              <small class="text-muted">
                              Showing <?=$dataConfig['page']+1;?> to 
                              <?php
                                 $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                                 echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                                 ?> of <?php echo $dataConfig['total'];?> entries
                              </small>
                           </div>
                           <div class="col-sm-2 text-center"></div>
                           <div class="col-sm-5 text-right" style="margin: -22px 0px 0px 0px;">
                              <?=$pagination;?>
                           </div>
                        </div>
                     </div>
                     <!-- /tile footer -->
                  </div>
                  <!-- listdataid -->          
               </section>
            </div>
         </div>
      </div>
   </section>
