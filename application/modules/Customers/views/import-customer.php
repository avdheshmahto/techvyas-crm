<?php $this->load->view('header.php');  ?>
<section id="content">
   <div class="page page-tables-bootstrap">
      <div class="row">
         <div class="col-md-12">
            <section class="tile">
               <div class="pageheader tile-bg">
                  <h3>Import Customer</h3>
               </div>
               <!--pageheader close-->
               <div id="listingData">
                  <!-- listingData -->
                  <form  method="POST" action="<?=base_url();?>Customers/import_customer_list" method="post" enctype="multipart/form-data">
                     <div id="nextModal">
                        <div class="panel-body">
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <input type="hidden" name="oldcustomer_id" id="oldcustomer_id" class="hiddenField">
                                 <label class="label-modal">* Import CSV:</label>
                                 <div class="typeahead__container ">
                                    <div class="typeahead__field">
                                       <div class="typeahead__query">
                                          <div class="col-md-6 img-box">
                                             <label class="custom-file-upload form-border p-2">
                                                <input class="modal-input-size" id="select-file" type="file" name="attachment[file]">
                                                <i class="fas fa-cloud-upload-alt"></i>Select File
                                             </label>
                                             </div>
                                          <input type="file" name="customer_file" class="form-control underline-input" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group col-md-6" style="display: none;">
                                 <label class="label-modal">Sample : </label>
                                 <div class="typeahead__container ">
                                    <div class="typeahead__field">
                                       <div class="typeahead__query">
                                          <a href="<?php echo base_url();?>assets/images/product_format.csv">
                                             Download Sample CSV 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn modal-nxt" value="Save">
                        <a href="<?=base_url();?>Customers/manage_customers" class="btn cancel-modal">Cancel</a>
                        </div>
                     </div>
                  </form>
               </div>
            </section>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('footer.php'); ?>