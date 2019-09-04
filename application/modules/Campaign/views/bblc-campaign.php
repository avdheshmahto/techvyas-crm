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
                           <button class="btn btn-danger btn-campaign" data-toggle="modal" data-target="#bblcModal" formid="#bblcForm" id="formreset" style="margin: 17px 0px 0px 0px;">CREATE CAMPAIGN</button>
                        </div>
                        <div class="btn-group"></div>
                     </div>
                  </div>
               </div>
               <!--pageheader close-->
               <?php $this->load->view('tab-menu.php'); ?>
               <h4 style="margin: 15px;">Bring Back Lost Customer Campaign</h4>
               <div id="listingData">
                  <!-- listdataid -->
                  <article class="page-content">
                     <section class="block bottom20">
                        <div class="entity-detail">
                           <div class="table-responsive">
                              <table class="table mb-0" id="usersList">
                                 <thead>
                                    <tr class="row-color">
                                       <th>Name</th>
                                       <th>Description</th>
                                       <th>Start Date</th>
                                       <th>Valid Till</th>
                                       <th style="text-align: center;">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=1;
                                       $bblc=$this->db->query("select * from tbl_campaign where type='Lost Customers' AND maker_id='".$this->session->userdata('user_id')."' ");
                                       foreach ($bblc->result() as $getBblc) {
                                       ?>
                                    <tr class="record">
                                       <td><?php echo $getBblc->title; ?></td>
                                       <td style="width: 50%">
                                          <?php echo $getBblc->wishes_text; ?>    
                                       </td>
                                       <td><?php echo $getBblc->start_date; ?></td>
                                       <td><?php echo $getBblc->vaild_till; ?></td>
                                       <td>
                                          <?php 
                                             $pri_col='campaign_id';
                                             $table_name='tbl_campaign';
                                             ?>
                                          <div class="btn-group pull-right">
                                             <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                             <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" onclick="edit_bblc(this);" property = "edit" type="button" data-toggle="modal" data-target="#bblcModal" arrt= '<?=json_encode($getBblc);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This Campaign</a></li>
                                                <li><a href="#" class="delbutton" id="<?php echo $getBblc->campaign_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This Campaign</a></li>
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
            </section>
         </div>
      </div>
   </div>
</section>
<!-- bblc campaign -->
<div class="modal fade" id="bblcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="margin: 50px auto;">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><span class="top_title">Create</span> Bring Back Lost Customer Campaign</h4>
            <div id="resultbblc" style="font-size: 15px;color: red; text-align:center;">
            </div>
         </div>
         <form id="bblcForm">
            <div class="modal-body">
               <div class="sb-container container-example1">
                  <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel-body">
                     <input type="hidden" name="type" id="type" value="Lost Customers">
                        <input type="hidden" name="cmpgn_id" id="cmpgn_id">

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
                           <div class="form-group col-md-6"> 
                              <label class="label-modal">Last Visited Since :</label>
                              <input type="last_visited" name="last_visited" id="last_visited" class="form-control modal-input">
                           </div>
                           <div class="form-group col-md-6">   
                              <label class="label-modal">Valid For Days:</label>
                              <input type="number" name="till_day" id="till_day" class="form-control modal-input">
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
                              <label class="label-modal">Start Date :</label>
                              <input type="date" name="start_date" id="start_date" class="form-control modal-input">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">Valid Till :</label>
                              <input type="date" name="vaild_till" id="vaild_till" class="form-control modal-input">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">Gender :</label>
                              <select name="gender" id="gender" class="form-control">
                                 <option value="">--Select--</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                 <option value="Other">Other</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="label-modal">Customer Source :</label>
                              <select name="customer_source" id="customer_source" class="form-control">
                                 <option value="">--Select--</option>
                                 <option value="STORE">STORE</option>
                                 <option value="UPLOAD">UPLOAD</option>
                                 <option value="JustDial">JustDial</option>
                              </select>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="label-modal">Customer Category :</label>
                              <select name="customer_category" id="customer_category" class="form-control">
                                 <option value="">--Select--</option>
                                 <option value="Alignment">Alignment</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6" style="display: none;">
                              <label class="label-modal">Select Category :</label>
                              <select name="category" id="category" class="form-control height-modal">
                                 <option value="">--Select--</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!--panel close-->    
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="col-lg-12 text-center">
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