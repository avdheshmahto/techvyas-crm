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
                           <button class="btn btn-danger btn-campaign" data-toggle="modal" data-target="#welcomeModal" formid="#welcomeForm" id="formreset" style="margin: 17px 0px 0px 0px;">CREATE CAMPAIGN</button>
                        </div>
                        <div class="btn-group"></div>
                     </div>
                  </div>
               </div>
               <!--pageheader close-->
               <?php $this->load->view('tab-menu.php'); ?>
               <h4 style="margin: 15px;">Welcome Campaign</h4>
               <div id="listingData">
                  <!-- listdataid -->
                  <div class="tab-content">
                     <article class="page-content">
                        <section class="block bottom20">
                           <div class="entity-detail">
                              <div class="table-responsive">
                                 <table class="table mb-0" id="usersList">
                                    <thead>
                                       <tr class="row-color">
                                          <th>Name</th>
                                          <th>Crated On</th>
                                          <th>Description</th>
                                          <th>Valid Till</th>
                                          <th>Total Sent</th>
                                          <th style="text-align: right;">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          $i=1;
                                          $welcome=$this->db->query("select * from tbl_campaign where type='Welcome' AND maker_id='".$this->session->userdata('user_id')."' ");
                                          foreach ($welcome->result() as $getWelcome) {
                                          ?>
                                       <tr class="record">
                                          <td><?php echo $getWelcome->title." Coupon"; ?></td>
                                          <td><?php echo $getWelcome->maker_date; ?></td>
                                          <td style="width: 50%">
                                             <?php echo $getWelcome->wishes_text; ?>
                                          </td>
                                          <td><?php echo $getWelcome->vaild_till; ?></td>
                                          <td><?php $msgLog=$this->db->query("select * from tbl_message_log where type='$getWelcome->type' AND sub_type='$getWelcome->sub_type' "); 
                                          $count=$msgLog->num_rows(); ?>
                                          <a href="<?=base_url('Campaign/welcome_sms_log');?>" target="_blank"><center><?=$count?></center></a>
                                          </td>
                                          <td>
                                             <?php 
                                                $pri_col='campaign_id';
                                                $table_name='tbl_campaign';
                                                ?>
                                             <div class="btn-group pull-right">
                                                <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                   <li><a href="#" onclick="edit_welcome(this);" property = "edit" type="button" data-toggle="modal" data-target="#welcomeModal" arrt= '<?=json_encode($getWelcome);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This Campaign</a></li>
                                                   <li><a href="#" class="delbutton" id="<?php echo $getWelcome->campaign_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This Campaign</a></li>
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
               </div>
               <!-- /listdataid -->
            </section>
         </div>
      </div>
   </div>
</section>
<!-- welcome campaign -->
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><span class="top_title">Create</span> Welcome Campaign</h4>
            <div id="resultwelcome" style="font-size: 15px;color: red; text-align:center;"></div>
         </div>
         <form id="welcomeForm">
            <div class="modal-body">
               <div class="sb-container container-example1">
                  <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel-body">
                        <input type="hidden" name="cmpgn_id" id="cmpgn_id">
                        <input type="hidden" name="type" id="type" value="Welcome">
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">Title : </label>
                              <input type="text" name="title" id="title" class="form-control modal-input">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">Language : </label>
                              <select name="language" id="language" class="form-control">
                                 <option>----Select----</option>
                                 <option value="English">English</option>
                              </select>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label class="label-modal">Text : </label>
                              <textarea name="wishes_text" id="wishes_text" class="form-control modal-textarea"></textarea>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">   
                              <label class="label-modal">Valid Till Days:</label>
                              <input type="number" name="valid_till_days" id="valid_till_days" class="form-control modal-input">
                           </div>
                           <div class="form-group col-md-6">   
                              <label class="label-modal">Valid Till :</label>
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
</script>