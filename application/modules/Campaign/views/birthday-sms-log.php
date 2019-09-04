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
              <h3>BIRTHDAY SMS LOG</h3>
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
                        <select class="btn btn-default btn-sm" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('Campaign/welcome_sms_log?') ?>">
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
                    <div class="col-sm-3 pull-right">
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
                        <th>S. No.</th>
                        <th>Mobile</th>
                        <th>Customer</th>
                        <th>Send Date</th>
                      </tr>
                    </thead>
                    <tbody id="dataTable">
                      <?php 
                        $i=1;
                        foreach ($result as $get_list) {
                        ?>
                      <tr class="record">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $get_list->mobile; ?></td>
                        <td><?php echo $get_list->customer; ?></td>
                        <td><?php echo $get_list->sent_date; ?></td>
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
<?php $this->load->view('footer.php'); ?>