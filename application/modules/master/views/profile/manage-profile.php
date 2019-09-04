<?php $this->load->view('header.php'); ?>
<section id="content">
  <div class="page page-tables-bootstrap">
    <div class="row">
      <div class="col-md-12">
        <section class="tile">
          <div class="pageheader tile-bg">
            <h3>Profile</h3>
          </div>
          <!--pageheader close-->
          <div id="listingData">
            <!-- listdataid -->
            <?php 
              $data=$this->db->query("select * from tbl_user_mst where user_id='".$this->session->userdata('user_id')."' ");
              $getData=$data->row();
              ?>
            <!-- Modal Profile -->
            <div class="tab-panel" id="tab-panel-1" tabindex="-1">
              <h4 class="sub-head">Personal and Business Details</h4>
              <form  id="AboutForm" method="POST" action="">
                <div class="">
                  <div class="sb-container container-example1">
                    <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel-body">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">First Name : </label>
                            <input type="text" readonly="" value="<?=$getData->first_name;?>" class="form-control disable-input">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Last Name : </label>
                            <input type="text" readonly="" value="<?=$getData->last_name;?>" class="form-control disable-input">
                          </div>
                        </div>
                        <div class="row">
                          <input type="hidden" name="user_id" id="user_id">
                          <div class="form-group col-md-6">
                            <label class="label-modal">*Mobile No :</label>
                            <input class="form-control disable-input" readonly="" value="<?=$getData->mobile_no;?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Email : </label>
                            <input class="form-control disable-input" readonly="" value="<?=$getData->email_id;?>" >
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">Date Of Birth : </label>
                            <input type="date" readonly="" value="<?=$getData->date_of_birth;?>" class="form-control disable-input">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Gender : </label>
                            <select name="gender" id="gender" class="form-control" disabled="" style="border-radius: 10px; font-size: 12px;">
                              <option value="">--Select--</option>
                              <option value="Male" <?php if($getData->gender == 'Male') { ?> selected <?php } ?> >Male</option>
                              <option value="Female" <?php if($getData->gender == 'Female') { ?> selected <?php } ?> >Female</option>
                              <option value="Other" <?php if($getData->gender == 'Other') { ?> selected <?php } ?> >Other</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">		
                            <label class="label-modal">Street Address :</label>
                            <textarea name="address" id="address" disabled="" class="form-control disable-textarea"><?=$getData->address;?></textarea>
                          </div>
                          <div class="form-group col-md-6">	
                            <label class="label-modal">City :</label>
                            <input type="text" readonly="" value="<?=$getData->city;?>" class="form-control disable-input">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal underline-input">State/Province :</label>
                            <select name="state" id="state" class="form-control" style="height: 30px !important; font-style: normal; color: #616f77;" disabled="">
                              <option value="">--Select--</option>
                              <?php $state=$this->db->query("select * from tbl_state_m where status='A'"); 
                                foreach ($state->result() as $value) {  ?>
                              <option value="<?=$value->stateid?>" <?php if($value->stateid == $getData->state) { ?> selected <?php } ?> ><?=$value->stateName?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6">		
                            <label class="label-modal underline-input">Pin Code :</label>
                            <input type="number" readonly="" value="<?=$getData->pin_code;?>" class="form-control disable-input">
                          </div>
                        </div>
                        <!--  <div class="fp-product-count-total" style="margin: 0px 0px 40px 0px;"></div> -->
                        <div class="row">
                          <div class="form-group col-md-6">	
                            <label class="label-modal underline-input">Business Name :</label>
                            <input type="text" readonly="" value="<?=$getData->buseiness_name;?>" class="form-control disable-input">
                          </div>
                          <div class="form-group col-md-6">		
                            <label class="label-modal underline-input">Business Code :</label>
                            <input type="text" readonly="" value="<?=$getData->business_code;?>" class="form-control disable-input">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal underline-input">Category : </label>
                            <select name="category" id="category" class="form-control" style="height: 30px !important;  font-style: normal; color: #616f77;" disabled="">
                              <option value="">--Select--</option>
                              <option value="18" <?php if($getData->category == '18') { ?> selected <?php } ?> >Automobiles</option>
                              <option value="17" <?php if($getData->category == '17') { ?> selected <?php } ?> >Electronics</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal underline-input">Sub Category : </label>
                            <div id="selectpeople">
                              <select name="sub_category[]" id="sub_category" class="chosen-select__" style="width: 454px; background-color: #eeeeee; font-style: normal; color: #616f77; cursor: not-allowed;" disabled="" multiple="">
                                <?php 
                                  $jsonData=json_decode($getData->sub_category,true);
                                  $subCatg=implode(",",$jsonData);
                                  
                                  if($subCatg != '')
                                  {
                                  	$subCatg=$subCatg;
                                  }
                                  else
                                  {
                                  	$subCatg='99999999';
                                  }
                                  
                                  $sql=$this->db->query("select * from tbl_master_data where serial_number in ($subCatg) ");
                                  foreach($sql->result() as $getSql) {
                                  ?>
                                <option value="<?=$getSql->serial_number?>"><?php echo $getSql->keyvalue; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">	
                            <label class="label-modal underline-input">Managers Email :</label>
                            <input type="email"  readonly="" value="<?=$getData->manager_email;?>" class="form-control disable-input">	
                          </div>
                          <div class="form-group col-md-6">		
                            <label class="label-modal underline-input">Managers Mobile No :</label>
                            <input type="number" readonly="" value="<?=$getData->manager_mobile;?>" class="form-control disable-input">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">	
                            <label class="label-modal underline-input">Time From :</label>
                            <input type="time" readonly="" value="<?=$getData->time_from;?>" class="form-control disable-input">
                          </div>
                          <div class="form-group col-md-6">		
                            <label class="label-modal underline-input">Time To :</label>
                            <input type="time" readonly="" value="<?=$getData->time_to;?>" class="form-control disable-input">
                          </div>
                        </div>
                      </div>
                      <!--panel close-->
                    </div>
                  </div>
                </div>
                <div class="modal-footer" style="display: none;">
                  <button type="button" class="btn btn-default" onclick="backPage();">Cancel</button>
                </div>
              </form>
            </div>
            <!-- Modal Profile close-->
          </div>
          <!-- listing data -->
        </section>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('footer.php'); ?>
<script type="text/javascript">
  function backPage()
  {
  	window.location.reload('master/Userdetails/manage_users');
  }
</script>