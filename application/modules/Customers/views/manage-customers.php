<?php $this->load->view('header.php');
   $entries = ""; $filter = "";
   if($this->input->get('entries')!="")
   {
     $entries = $this->input->get('entries');
   }
   if($this->input->get('filter')!="")
   {
     $filter = $this->input->get('filter');
   }
   
   ?>
<div id="ajax_content">
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
                           <a href="<?=base_url('Customers/import_customer');?>" class="btn btn-danger btn-customer" style="display: none;">Import Customer</a>                            
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
</div>
<!-- /ajax_content -->
<!-- Modal Customer -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><span class="top_title">Add</span> Customer</h4>
            <div id="resultareacustomer" style="font-size: 15px;color: red; text-align:center;">
            </div>
         </div>
         <form  id="CustomerForm">
            <div class="modal-body">
               <div class="sb-container container-example1">
                  <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel-body">
                        <div class="row">
                           <input type="hidden" name="customer_id" id="customer_id">
                           <div class="form-group col-md-6">
                              <label class="label-modal">* Mobile No :</label>
                              <input type="text" name="mobile_no" id="mobile_no" class="form-control disable disable-input" readonly="">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">Customer Category : </label>
                              <select name="categories" id="categories" class="form-control">
                                 <option>--Select--</option>
                                 <option value="Alignment">Alignment</option>
                              </select>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">First Name : </label>
                              <input type="text" name="first_name" id="first_name"  class="form-control modal-input" >
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">Email : </label>
                              <input type="email" name="email_id" id="email_id"  class="form-control modal-input" onkeyup1="checkajaxmail(this.value);">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">Last Name : </label>
                              <input type='text' name="last_name" id="last_name" class="form-control modal-input" >
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">GST No :</label>
                              <input type="text" name="gst_no" id="gst_no" class="form-control modal-input">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">Gender : </label>
                              <select name="gender" id="gender" class="form-control">
                                 <option value="">--Select--</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                 <option value="Other">Other</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">PAN No : </label>
                              <input type="text" name="pan_no" id="pan_no"  class="form-control modal-input">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">DOB : </label>
                              <table id="dobBox">
                                 <tr style="line-height: 3;">
                                    <td style="width:100%;">
                                       <!-- <input type="date" name="dob[]" id="dob0" class="form-control"> -->
                                       <input type="date" name="dob" id="dob" class="form-control modal-input">
                                    </td>
                                    <td align="center" style="width: 150px;"></td>
                                 </tr>
                              </table>
                              <!-- <a style="cursor: pointer;" onclick="addRowDob();"><small>+ add one more</small></a> -->
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">Anniversary : </label>
                              <table id="anniversaryBox">
                                 <tr style="line-height:3;">
                                    <td style="width:100%;">
                                       <!-- <input type='date' name="anniversary[]" id="anniversary0" class="form-control"> -->
                                       <input type='date' name="anniversary" id="anniversary" class="form-control modal-input">
                                    </td>
                                    <td align="center" style="width: 150px;"></td>
                                 </tr>
                              </table>
                              <!-- <a  style="cursor: pointer;" onclick="addRowAnniversary();"><small>+ add one more</small></a> -->
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">Address : </label>
                              <textarea name="address" id="address" class="form-control modal-textarea"></textarea>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal"> Request Text : </label>
                              <textarea name="remarks" id="remarks" class="form-control modal-textarea"></textarea>
                           </div>
                        </div>
                     </div>
                     <!--panel close-->
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="col-md-12 text-center">
               <button type="button" class="btn modal-cancel" data-dismiss="modal">Cancel</button>
               <button type="submit" id="formsave" class="btn modal-save">Save</button>
               </div>
               <span id="saveload" style="display: none;">    
               <img src="<?=base_url('assets/loadgif.gif');?>" alt="HTML5 Icon" width="54.63" height="40">
               </span>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modal Customer close-->
<?php $this->load->view('footer.php'); ?>
<script type="text/javascript">
   function addRowDob(dob = "",prowid = "")
   {
     
      var  style = "";
   
       var dobData = '<tr style="line-height: 3;'+style+'" class="project_images"><td style="width: 90%;"><input type="date" name="dob[]" id="dob'+prowid+'" class="form-control" value="'+dob+'"></td><td align="center" style="width: 150px;"><i class="fa fa-trash" aria-hidden="true" style="font-size: 19px;" onclick="removeRows(this)"></i></td></tr>';
        $('#dobBox').append(dobData);
   
   }
   
   function addRowAnniversary(anniversary = "",prowid = "")
   {
     
      var  style = "";
   
       var anniversaryData = '<tr style="line-height: 3;'+style+'" class="project_images"><td style="width: 90%;"><input type="date" name="anniversary[]" id="anniversary'+prowid+'" class="form-control" value="'+anniversary+'"></td><td align="center" style="width: 150px;"><i class="fa fa-trash" aria-hidden="true" style="font-size: 19px;" onclick="removeRows(this)"></i></td></tr>';
        $('#anniversaryBox').append(anniversaryData);
   
   }
   
   
   function removeRows(ths)
   {
     $(ths).parent().parent().remove();
   }
   
   
   function ResetCustomer()
   {
     location.href="<?=base_url('/Customers/manage_customers');?>";
   }
   
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.en.min.js"></script>
<script >
   $(function () {
   $('.datetimepicker_report').datepicker({
   format: "dd/mm/yyyy",
   language: "en",
   autoclose: true,
   todayHighlight: true
   });
   });
</script>
<style>
   @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css");
   .input-group.date .input-group-addon {
   cursor: pointer;
   padding: 0 10px 0 10px;
   /* margin: 30px 20px 20px 30px; */
   line-height: initial;
   }
</style>
<script type="text/javascript">
   function checkajaxmail(v)
   {
     //alert(v);
     var ur="<?=base_url();?>Customers/Check_email";
   
     $.ajax({
   
       url  : ur,
       type : "POST",
       data : {'mail':v},
   
       success:function(data)
       {
         //alert(data);
         if(data == 1){
           $("#formsave").attr("disabled",true);
           $("#resultareacustomer").html("This email already exists !");
         }else{
           $("#formsave").attr("disabled",false);
           $("#resultareacustomer").html("");
         }
       }  
     });
   }
</script>