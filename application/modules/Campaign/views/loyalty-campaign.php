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
                  <button class="btn btn-danger btn-campaign" data-toggle="modal" data-target="#loyaltyModal" formid="#loyaltyForm" id="formreset" style="margin: 17px 0px 0px 0px;">CREATE CAMPAIGN</button>
                </div>
                <div class="btn-group">
                </div>
              </div>
            </div>
          </div>
          <!--pageheader close-->
          <?php $this->load->view('tab-menu.php'); ?>
          <h4 style="margin: 15px;">Loyalty Campaign</h4>
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
                            <th>Visits</th>
                            <th>Discount Value</th>
                            <th>Description</th>
                            <th>Benefit</th>
                            <th style="text-align: right;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $i=1;
                            $loyalty=$this->db->query("select * from tbl_campaign where type='Loyalty' AND maker_id='".$this->session->userdata('user_id')."' ");
                            foreach ($loyalty->result() as $getLoyalty) {
                            ?>
                          <tr class="record">
                            <td><?php echo $getLoyalty->visits; ?></td>
                            <td><?php echo $getLoyalty->discount_value; ?></td>
                            <td style="width: 50%">
                              <?php echo $getLoyalty->wishes_text?>
                            </td>
                            <td>
                              <?php echo $getLoyalty->free_items; ?>  
                            </td>
                            <td>
                              <?php 
                                $pri_col='campaign_id';
                                $table_name='tbl_campaign';
                                ?>
                              <div class="btn-group pull-right">
                                <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#" onclick="edit_loyalty(this);" property = "edit" type="button" data-toggle="modal" data-target="#loyaltyModal" arrt= '<?=json_encode($getLoyalty);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This Campaign</a></li>
                                  <li><a href="#" class="delbutton" id="<?php echo $getLoyalty->campaign_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This Campaign</a></li>
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
<!-- Loyalty campaign -->
<div class="modal fade" id="loyaltyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title"><span class="top_title">Create</span> Loyalty Campaign</h4>
        <div id="resultloyalty" style="font-size: 15px;color: red; text-align:center;"></div>
      </div>
      <form id="LoyaltyForm">
        <div class="modal-body">
          <div class="sb-container container-example1">
            <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel-body">
                <input type="hidden" name="cmpgn_id" id="cmpgn_id">
                <input type="hidden" name="type" id="type" value="Loyalty">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">Visits : </label>
                    <input type="number" name="visits" id="visits" class="form-control modal-input">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Benefit : </label>
                    <input type="text" name="free_items" id="free_items" class="form-control modal-input" placeholder="Benefit e.g. 10% Discount">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">Discount : </label>
                    <select name="discount" id="discount" class="form-control  modal-input">
                      <option value="%">%</option>
                      <option value="Rs.">Rs.</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Discount Value : </label>
                    <input type="number" name="discount_value" id="discount_value" class="form-control modal-input" placeholder="Add Value">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">   
                    <label class="label-modal">Maximum Discount :</label>
                    <input type="number" name="maximum_discount" id="maximum_discount" class="form-control modal-input" placeholder="Add Value">
                  </div>
                  <div class="form-group col-md-6"> 
                    <label class="label-modal">On Minimum Billing :</label>
                    <input type="number" name="minimum_billing" id="minimum_billing" class="form-control modal-input" placeholder="Add Value">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label class="label-modal">Registration SMS Preview</label>
                    <textarea name="wishes_text" id="wishes_text" row="4" class="form-control modal-textarea"></textarea>
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
            <button type="submit" id="formsave" class="btn modal-save" >Save</button>
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