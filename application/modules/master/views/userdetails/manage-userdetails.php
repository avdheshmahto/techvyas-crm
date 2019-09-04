<?php $this->load->view('header.php'); 
  $entries = ""; $filter = "";
  if($this->input->get('entries')!="")
  {
    $entries = $this->input->get('entries');
  }
  if($this->input->get ('filter')!="")
  {
    $filter = $this->input->get('filter');
  }
  
  ?>
<div id="ajax_content">
  <section id="content">
    <div class="page page-tables-bootstrap">
      <div class="row">
        <div class="col-md-12">
          <section class="tile">
            <div class="pageheader tile-bg">
              <h3>Users</h3>
              <div class="page-bar">
                <ul class="page-breadcrumb mt-20">
                  <div class="btn-toolbar pull-left">
                    <div class="btn-group">
                      <select class="input-sm form-control inline">
                        <option value="0">All Users</option>
                      </select>
                    </div>
                  </div>
                </ul>
                <!-- <div class="btn-toolbar pull-right">
                  <div class="btn-group">
                  <button class="btn btn-danger mb-10" data-toggle="modal" data-target="#userModal" formid="#UserForm" id="formreset">Add User</button>
                  </div>
                  <div class="btn-group">
                  </div>
                  </div> -->
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
                        <select class="btn btn-default btn-sm" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('master/Userdetails/manage_users?');?>">
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
              <!-- /tile body -->
              <div class="tile-body p-0">
                <div class="table-responsive table-overflow___">
                  <table class="table mb-0 table-hover" id="tblData">
                    <thead>
                      <tr class="row-color">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Email Id</th>
                        <th>Business Name</th>
                        <th>Business Code</th>
                        <th>Category</th>
                        <th style="text-align: right;">Action</th>
                      </tr>
                    </thead>
                    <tbody id="dataTable">
                      <?php 
                        foreach ($result as $fetch_list) {
                        ?>
                      <tr class="record" data-row-id="<?php echo $fetch_list->user_id; ?>">
                        <td><?php echo $fetch_list->first_name; ?></td>
                        <td><?php echo $fetch_list->last_name; ?></td>
                        <td><?php echo $fetch_list->mobile_no; ?></td>
                        <td><?php echo $fetch_list->email_id; ?></td>
                        <td><?php echo $fetch_list->buseiness_name; ?></td>
                        <td><?php echo $fetch_list->business_code; ?></td>
                        <td><?php
                          $data=$this->db->query("select * from tbl_master_data_mst where param_id='$fetch_list->category'");
                          $getData=$data->row();
                          echo $getData->keyname;
                          ?></td>
                        <td>
                          <?php 
                            $pri_col='user_id';
                            $table_name='tbl_user_mst';
                            ?>
                          <div class="btn-group pull-right">
                            <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" onclick="editUser(this);" property = "edit" type="button" data-toggle="modal" data-target="#userModal" arrt= '<?=json_encode($fetch_list);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This User</a></li>
                              <li style="display: none;"><a href="#" class="delbutton_user" id="<?php echo $fetch_list->user_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This User</a></li>
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
                  <div class="col-sm-3 text-center"></div>
                  <div class="col-sm-4 text-right" style="margin: -22px 0px 0px 0px;">
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
<!-- Modal Users -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><span class="top_title">Add</span> User</h4>
        <div id="resultareauser" style="font-size: 15px;color: red; text-align:center;"></div>
      </div>
      <form  id="UserForm">
        <div class="modal-body">
          <div class="sb-container container-example1">
            <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel-body">
                <input type="hidden" name="userid" id="userid" class="form-control">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">First Name * </label>
                    <input type="text" name="first_name" id="first_name" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Last Name * </label>
                    <input type="text" name="last_name" id="last_name" class="form-control modal-input">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">*Mobile No * </label>
                    <input type="text" name="mobile_no" id="mobile_no" maxlength="10" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Email * </label>
                    <input type="email" name="email_id" id="email_id"  class="form-control modal-input">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">Date Of Birth : </label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Gender : </label>
                    <select name="gender" id="gender" class="form-control">
                      <option value="">--Select--</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">		
                    <label class="label-modal">Street Address :</label>
                    <textarea name="address" id="address" class="form-control modal-textarea input-height"></textarea>
                  </div>
                  <div class="form-group col-md-6">	
                    <label class="label-modal">City :</label>
                    <input type="text" name="city" id="city" class="form-control modal-input modal-input">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">State/Province :</label>
                    <select name="state" id="state" class="form-control input-height">
                      <option value="">--Select--</option>
                      <?php $state=$this->db->query("select * from tbl_state_m where status='A'"); 
                        foreach ($state->result() as $value) {  ?>
                      <option value="<?=$value->stateid?>"><?=$value->stateName?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">		
                    <label class="label-modal">Pin Code :</label>
                    <input type="text" name="pin_code" id="pin_code" maxlength="6" class="form-control modal-input ">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">	
                    <label class="label-modal">Business Name :</label>
                    <input type="text" name="buseiness_name" id="buseiness_name" class="form-control modal-input ">
                  </div>
                  <div class="form-group col-md-6">		
                    <label class="label-modal">Business Code :</label>
                    <input type="text" name="business_code" id="business_code" class="form-control modal-input">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">Category : </label>
                    <select name="category" id="category" class="form-control input-height" onchange="subcatg(this.value);">
                      <option value="">--Select--</option>
                      <option value="18">Automobiles</option>
                      <option value="17">Electronics</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Sub Category : </label>
                    <div id="selectpeople">
                      <select name="sub_category[]" id="sub_category" class="chosen-select__ input-height" multiple="multiple" style="width: 405px;">
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">	
                    <label class="label-modal">Managers Email :</label>
                    <input type="email" name="manager_email" id="manager_email" class="form-control modal-input">	
                  </div>
                  <div class="form-group col-md-6">		
                    <label class="label-modal">Managers Mobile No :</label>
                    <input type="number" name="manager_mobile" id="manager_mobile" class="form-control modal-input">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">	
                    <label class="label-modal">Time From :</label>
                    <input type="time" name="time_from" id="time_from" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">		
                    <label class="label-modal">Time To :</label>
                    <input type="time" name="time_to" id="time_to" class="form-control modal-input">
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
            <button type="button" id="formsave" class="btn modal-save" onclick="checkPassword(this);">Save</button>
            <span id="saveload" style="display: none;">
            <img src="<?=base_url('assets/loadgif.gif');?>" alt="HTML5 Icon" width="54.63" height="40">
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Users close-->
<?php $this->load->view('footer.php'); ?>
<script type="text/javascript">
  function checkPassword(v)
  {
  
  	var newP=$("#new_password").val();
  	var cnfP=$("#confirm_password").val();
  	//alert(cnfP);
  
  	if(newP == cnfP)
  	{
  		//$("#formsave").prop('type','submit');
  		v.type="submit";
  	}
  	else
  	{
  		alert('Password and Confirm Password Must Be Same !')
  	}
  }
  
  
  function subcatg(v)
  {
  
   //alert(v);
  ur="<?=base_url();?>master/get_sub_catg";
  
   $.ajax({
  
       url   : ur,
       type  : "POST",
       data  : {'ctg':v},
       success:function(data)
       {
         //alert(data);
         if(data != '')
         {
           $("#sub_category").empty().append(data);
         }
       }
   })
  
  }
  
  
  function show_sub_catg(v)
  {
  
  //alert(v);
  ur="<?=base_url();?>master/edit_sub_catg";
  
   $.ajax({
  
       url   : ur,
       type  : "POST",
       data  : {'ctg':v},
       success:function(data)
       {
         //alert(data);
         if(data != '')
         {
           $("#sub_category").empty().append(data);
         }
       }
   })
  
  }
</script>