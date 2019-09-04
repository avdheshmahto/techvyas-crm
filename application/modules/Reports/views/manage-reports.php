<?php $this->load->view('header.php'); ?>
<section id="content">
  <div class="page page-tables-bootstrap">
    <div class="row">
      <div class="col-md-12">
        <section class="tile">
          <input type="hidden" id="json_contact" value='<?=$json_contact;?>'>
          <input type="hidden" id="json_orgnization" value='<?=$json_orgnization;?>'>
          <div class="pageheader tile-bg" style="margin-bottom:0px;">
            <h3>REPORTING</h3>
          </div>
          <!--pageheader close-->
          <div id="listingData">
            <!-- listdataid -->
            <div class="collapse navbar-collapse tab-wrapper tabs-main" id="navbar-collapse-1">
				<ul class="nav navbar-nav nav mt-10 tabs">
				  <li class="dropdown hoves">
				     <a href="#" class="tab-link">Campaign
				     </a>
				  </li>
				  <li class="dropdown hoves">
				     <a href="#" class="tab-link">Customers
				     </a>
				  </li>
				</ul>
				</div>
            <!-- tile body -->
            <div class="tile-body p-0">
              <div class="table-responsive" style="height:300px;">
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
<?php $this->load->view('footer.php'); ?>