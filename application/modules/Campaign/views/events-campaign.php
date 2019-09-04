<?php $this->load->view('header.php'); ?>
<style type="text/css">
  .tab-panel.active {
  display: block;   
  }
  .tab-panel {
  display: none;
  }
  .textarea{
  height: 100px !important;
  }
</style>
<section id="content">
  <div class="page page-tables-bootstrap">
    <div class="row">
      <div class="col-md-12">
        <section class="tile">
          <div class="pageheader tile-bg">
            <h3>CAMPAIGN</h3>
            <div class="page-bar">
              <div class="btn-toolbar pull-right">
                <div class="btn-group">
                  <button class="btn btn-danger btn-campaign" data-toggle="modal" data-target="" formid="#eventsForm" id="formresetId" style="margin: 17px 0px 0px 0px;">CREATE CAMPAIGN</button>
                </div>
                <div class="btn-group"></div>
              </div>
            </div>
          </div>
          <!--pageheader close-->
          <?php $this->load->view('tab-menu.php'); ?>

          <h4 style="margin: 15px;">Events and Festivals Campaign</h4>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane__ active" id="details">
              <div class="row">
                <div class="col-md-12">
                  <section class="time-simple">
                    <div class="tile-body">
                      <div class="tile-body p-0">
                        <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default panel-transparent">
                            <div class="panel-heading" role="tab" id="nameandoccupation33">
                              <h4 class="panel-title"> <a data-toggle="collapse" href="#nameandoccupation1" aria-expanded="true"> <span><i class="fa fa-minus text-sm mr-5"></i>Festival Announcement</span> </a> </h4>
                            </div>
                            <div id="nameandoccupation1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="nameandoccupation33">
                              <div class="panel-body">
                                <div>
                                  <article class="page-content">
                                    <section class="block bottom20">
                                      <div class="entity-detail">
                                        <div class="table-responsive">
                                          <table class="table mb-0" id="usersList">
                                            <tbody>
                                              <?php 
                                                $i=1;
                                                $wishes=$this->db->query("select * from tbl_template where type='Festival' AND sub_type='Festival Announcement'  ");
                                                foreach ($wishes->result() as $getWIshes) {
                                                ?>
                                              <input type="radio" name="radion_button" id="radion_button" arrt="<?=$getWIshes->template_id?>" onclick="check(this);">
                                              <div style="margin: -13px 0px 0px 20px;">
                                                <?php 
                                                  $sql=$this->db->query("select * from tbl_user_mst WHERE user_id='".$this->session->userdata('user_id')."' ");
                                                  $getSql=$sql->row();
                                                  $bname=$getSql->buseiness_name;
                                                  $msg1=$getWIshes->template_text;
                                                  $repMsg1=str_replace('#bname', $bname, $msg1);  
                                                  echo "<b>".$getWIshes->template_type."</b>"."---".$repMsg1?>
                                              </div>
                                              <?php } ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </section>
                                  </article>
                                </div>
                                <!--close-->
                              </div>
                            </div>
                          </div>
                          <!-- name and occupation close-->
                          <div class="panel panel-default panel-transparent">
                            <div class="panel-heading" role="tab" id="ContactDetails44">
                              <h4 class="panel-title"> <a data-toggle="collapse" href="#ContactDetails2" aria-expanded="true"> <span><i class="fa fa-minus text-sm mr-5"></i>General Announcement</span> </a> </h4>
                            </div>
                            <div id="ContactDetails2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="ContactDetails44">
                              <div class="panel-body">
                                <div>
                                  <article class="page-content">
                                    <section class="block bottom20">
                                      <div class="entity-detail">
                                        <div class="table-responsive">
                                          <table class="table mb-0" id="usersList">
                                            <tbody>
                                              <?php 
                                                $i=1;
                                                $wishes=$this->db->query("select * from tbl_template where type='Festival' AND sub_type='General Announcement'  ");
                                                foreach ($wishes->result() as $getWIshes) {
                                                ?>
                                              <input type="radio" name="radion_button" id="radion_button" arrt="<?=$getWIshes->template_id?>" onclick="check(this);">
                                              <div style="margin: -13px 0px 0px 20px;">
                                                <?php 
                                                  $sql=$this->db->query("select * from tbl_user_mst WHERE user_id='".$this->session->userdata('user_id')."' ");
                                                  $getSql=$sql->row();
                                                  $bname=$getSql->buseiness_name;
                                                  $msg1=$getWIshes->template_text;
                                                  $repMsg1=str_replace('#bname', $bname, $msg1);  
                                                  echo "<b>".$getWIshes->template_type."</b>"."---".$repMsg1?>
                                              </div>
                                              <?php } ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </section>
                                  </article>
                                </div>
                                <!--close-->
                              </div>
                            </div>
                          </div>
                          <!--Contact Details close-->
                          <div id="listingData">
                            <!-- listdataid -->
                            <article class="page-content">
                              <section class="block bottom20">
                                <div class="entity-detail">
                                  <div class="table-responsive">
                                    <table class="table mb-0" id="usersList">
                                      <thead>
                                        <tr class="row-color">
                                          <th>Name & Offer</th>
                                          <th>Sent Date</th>
                                          <th>Valid Till</th>
                                          <th>Total Sent</th>
                                          <th style="text-align: right;">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                          $i=1;
                                          $events=$this->db->query("select * from tbl_campaign where type='Festival' AND maker_id='".$this->session->userdata('user_id')."' ");
                                          foreach ($events->result() as $getEvents) {
                                          ?>
                                        <tr class="record">
                                          <td style="width: 50%">
                                            <?php echo "<b>".$getEvents->title."</b>"."---".$getEvents->wishes_text; ?>                                                                                 
                                          </td>
                                          <td><?php echo $getEvents->sent_date; ?></td>
                                          <td><?php echo $getEvents->vaild_till; ?></td>
                                          <td></td>
                                          <td>
                                            <?php 
                                              $pri_col='campaign_id';
                                              $table_name='tbl_campaign';
                                              ?>
                                            <div class="btn-group pull-right">
                                              <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                              <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" onclick="edit_events_wishes(this);" property = "edit" type="button" data-toggle="modal" data-target="#eventsModal" arrt= '<?=json_encode($getEvents);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This Campaign</a></li>
                                                <li><a href="#" class="delbutton" id="<?php echo $getEvents->campaign_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This Campaign</a></li>
                                              </ul>
                                            </div>
                                          </td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </section>
                            </article>
                          </div>
                          <!-- /listdataid -->
                        </div>
                      </div>
                      <!--tile-body p-0 close-->
                    </div>
                  </section>
                </div>
              </div>
            </div>
            <!-- related close -->
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<!-- Events and Festivals campaign -->
<div class="modal fade" id="eventsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><span class="top_title">Create</span> Events and Festivals Campaign</h4>
        <div id="resultfestival" style="font-size: 15px;color: red; text-align:center;"></div>
      </div>
      <form id="eventsForm">
        <div class="modal-body">
          <div class="sb-container container-example1">
            <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel-body">
                <input type="hidden" name="cmpgn_id" id="cmpgn_id">
                <input type="hidden" name="type" id="type" value="">
                <input type="hidden" name="sub_type" id="sub_type" value="">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>Title : </label>
                    <input type="text" name="title" id="title" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Language : </label>
                    <select name="language" id="language" class="form-control modal-input">
                      <option>----Select----</option>
                      <option value="English">English</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Text : </label>
                    <textarea name="wishes_text" id="wishes_text" row="4" class="form-control modal-textarea"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>Sent Date : </label>
                    <input type="date" name="sent_date" id="sent_date" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">   
                    <label>Valid Till :</label>
                    <input type="date" name="vaild_till" id="vaild_till" class="form-control modal-input">
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
            <span id="saveload" style="display: none;">
            <img src="<?=base_url('assets/loadgif.gif');?>" alt="HTML5 Icon" width="54.63" height="40">
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  $sql=$this->db->query("select * from tbl_user_mst WHERE user_id='".$this->session->userdata('user_id')."'");
  $getSql=$sql->row();
  $bname=$getSql->buseiness_name;
  $phone=$getSql->mobile_no;
  ?>
<input type="hidden" name="bname" id="bname" value="<?=$bname?>">
<input type="hidden" name="phone" id="phone" value="<?=$phone?>">
<?php $this->load->view('footer.php'); ?>
<script>
  $(function() {
    $('.tab-wrapper .tabs a').click(function() {
      //$(".tile-body").css('display','none');
      $(this).parent().siblings().removeClass('active');
      $(this).parent().addClass('active');
      var currPanel = $(this).data('target');
      $('.tab-panel').removeClass('active');
      $("#"+currPanel).addClass('active');
    });
  })
  
  
  function check(ths)
  {
  
  var rowValue = $(ths).attr('arrt'); 
  //alert(rowValue);
  var ur="<?=base_url()?>Campaign/set_template_value";
  $.ajax({
    type : "POST",
    url  : ur,
    data : {'tid': rowValue},
    success:function(data)
    {
      if(data != false)
      {
        data=JSON.parse(data);
        //alert(data);
        $('#type').val(data.type);
        $('#sub_type').val(data.sub_type);
        $('#title').val(data.template_type);
        
        var bname=$("#bname").val();
        var phone=$("#phone").val();
        var str = data.template_text;
  
        var res = str.replace("#bname", bname);
        var res1 = res.replace("#phone", phone);
  
        $('#wishes_text').val(res1);
      }
  
    }
  
  
  });
  
  }
  
  $('#formresetId').click(function(){
    
    //var isChecked = $('#radion_button').prop('checked');
    //alert(isChecked);
    var text=$("#wishes_text").val();
  
    if(text == '')
    {
      alert("Please Select Template To Create Campaign..");
    }
    else
    {
      $("#formresetId").attr('data-target','#eventsModal'); 
    }
  
  });
  
</script>