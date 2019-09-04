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
               <div class="pageheader tile-bg" style="margin-bottom:0px;">
                  <h3>CAMPAIGN</h3>
                  <div class="page-bar">
                     <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                           <button class="btn btn-danger btn-campaign mb-10" data-toggle="modal" data-target="#templateModal" formid="#templateForm" id="formreset" style="margin: 17px 0px 0px 0px; display: none;">CREATE TEMPLATE</button>
                        </div>
                        <div class="btn-group"></div>
                     </div>
                  </div>
               </div>
               <!--pageheader close-->
               <div id="listingData" class="mt-10">
                  <!-- listdataid -->
                  <?php $this->load->view('tab-menu.php'); ?>
                  <!-- tile body -->
                  <div class="tile-body p-0">
                     <div class="table-responsive" style="height:400px;">
                     </div>
                  </div>
                  <!-- /tile body -->
               </div>
               <!-- /listdataid -->
            </section>
         </div>
      </div>
   </div>
</section>
<!-- template create -->
<div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><span class="top_title">Create</span> Template</h4>
            <div id="result_template" style="font-size: 15px;color: red; text-align:center;">
            </div>
         </div>
         <form id="templateForm">
            <div class="modal-body">
               <div class="sb-container container-example1">
                  <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel-body">
                        <input type="hidden" name="temp_id" id="temp_id">
                        <div class="row">
                           <div class="form-group col-md-4">
                              <label class="label-modal">Type : </label>
                              <select name="type" id="type" class="form-control height-modal">
                                 <option>--Select--</option>
                                 <option value="Birthday">Birthday</option>
                                 <option value="Anniversary">Anniversary</option>
                                 <option value="Welcome">Welcome</option>
                                 <option value="Lost Customers">Lost Customers</option>
                                 <option value="Walkins Customers">Walkins Customers</option>
                                 <option value="Festival">Festival</option>
                                 <option value="Loyalty">Loyalty</option>
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              <label class="label-modal">Sub Type :</label>
                              <select name="sub_type" id="sub_type" class="form-control height-modal">
                                 <option value="">--Select--</option>
                                 <option value="Birthday Wishes">Birthday Wishes</option>
                                 <option value="Anniversary Wishes">Anniversary Wishes</option>
                                 <option value="Festival Announcement">Festival Announcement</option>
                                 <option value="General Announcement">General Announcement</option>
                                 <option value="Percentage & Discount">Percentage & Discount</option>
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              <label class="label-modal">Text Type :</label>
                              <input type="text" name="template_type" id="template_type" class="form-control modal-input">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label class="label-modal">Text : </label>
                              <textarea name="template_text" id="template_text" class="form-control modal-textarea"></textarea>
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
<!-- close -->
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
<script type="text/javascript">
   function backPage()
   {
     window.location.reload('/Campaign/manage_campaign');
   }
</script>