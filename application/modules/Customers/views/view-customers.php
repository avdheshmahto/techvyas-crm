<?php $this->load->view('header.php'); ?>
<?php 
   $customer=$this->db->query("select * from tbl_customers where customer_id='".$_GET['id']."'");
   $result=$customer->row();
   
   $cntct=$this->db->query("select * from tbl_customers_log where customer_id='$result->customer_id' ");
   $cntrows = $cntct->num_rows();
   
   $sales=$this->db->query("select SUM(sales_amount) as total_sales from tbl_customers_log where customer_id='$result->customer_id'");
   $getSales=$sales->row();   
   ?>
<div id="ajax_content">
<!-- ajax_content -->
<div id="main-content">
   <div id="guts">
      <section id="content">
         <div class="page page-tables-bootstrap" >
            <div class="row">
               <div class="col-md-12">
                  <section class="tile">
                     <div class="pageheader tile-bg">
                        <div class="media">
                           <div class="btn-toolbar pull-right">
                              <div class="btn-group">
                                 <a href="<?php echo base_url('Customers/manage_customers');?>"><button class="btn btn-default btn-sm br-2"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> </button></a>
                              </div>
                           </div>
                           <div class="media-body">
                              <h3>Customer</h3>
                           </div>
                        </div>
                     </div>
                     <!--pageheader close-->
                     <div class="pageheader">
                        <div class="table-responsive">
                           <table class="table mb-0">
                              <tbody>
                                 <tr>
                                    <td style="border:none;" class="text-center">
                                       <small class="label-font">Name :</small>
                                       <h5 class="media-font mb-0 mt-10"><?=$result->first_name." ".$result->last_name?></h5>
                                    </td>
                                    <td style="border:none;" class="text-center">
                                       <small class="label-font">Mobile No :</small>
                                       <h5 class="media-font mb-0 mt-10"><?=$result->mobile_no?></h5>
                                    </td>
                                    <td style="border:none;" class="text-center">
                                       <small class="label-font">Visits :</small>
                                       <h5 class="media-font mb-0 mt-10"><?=$result->visit_count?></h5>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!--pageheader close-->
                     <div class="add-nav">
                        <div role="tabpanel">
                           <!-- Nav tabs -->
                           <ul class="nav nav-tabs pt-15-" role="tablist">
                              <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                              <li role="presentation"><a href="#related" aria-controls="related" role="tab" data-toggle="tab">Visits</a></li>
                           </ul>
                           <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="details">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <section class="time-simple">
                                          <div class="tile-body">
                                             <div class="tile-body p-0">
                                                <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                   <div class="panel panel-default panel-transparent">
                                                      <div class="panel-heading" role="tab" id="nameandoccupation33">
                                                         <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" href="#nameandoccupation1" aria-expanded="true"> 
                                                               <span class="accordion-head">
                                                                  <i class="fa fa-minus text-sm mr-5"></i>Customer Details
                                                               </span> 
                                                            </a> 
                                                         </h4>
                                                      </div>
                                                      <div id="nameandoccupation1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="nameandoccupation33">
                                                         <div class="panel-body">
                                                            <article class="page-content">
                                                               <section class="block bottom20">
                                                                  <div class="row entity-detail">
                                                                     <div class="col-lg-2 ralign"
                                                                        ><span class="title">Customer ID : </span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">
                                                                        <?=$result->customer_id;?> 
                                                                     </div>
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">Email :</span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">
                                                                        <?=$result->email_id;?> 
                                                                     </div>
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">Gender :</span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">
                                                                        <?=$result->gender;?>
                                                                     </div>
                                                                           <?php
                                                                              /*if($result->date_of_birth != '')
                                                                              {
                                                                                  $jsondata = $result->date_of_birth;
                                                                                  $arr = json_decode($jsondata, true);
                                                                                  foreach ($arr as $k=>$v) {*/ ?>
                                                                  </div>
                                                                  <div class="row entity-detail">   
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">Date of Birth :</span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">
                                                                        <?=$result->date_of_birth;?>
                                                                     </div>
                                                                     <?php //} } ?>  
                                                                     <?php
                                                                              /*if($result->anniversary != '')
                                                                              {
                                                                                  $jsondata = $result->anniversary;
                                                                                  $arr = json_decode($jsondata, true);
                                                                                  foreach ($arr as $k=>$v) {*/ ?>
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">Anniversary :</span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">  
                                                                        <?=$result->anniversary?> 
                                                                     </div>
                                                                     <?php //} } ?>
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">Type :</span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">
                                                                        <?=$result->type;?>
                                                                     </div>
                                                                  </div>
                                                                  <div class="row entity-detail">
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">GST No :</span>
                                                                     </div>
                                                                     <div class="col-lg-2 info-ralign">
                                                                        <?=$result->gst_no;?>
                                                                     </div>
                                                                     <div class="col-lg-2 ralign">
                                                                        <span class="title">PAN No :</span>
                                                                     </div>
                                                                     <div class="info-ralign">
                                                                        <?=$result->pan_no;?>
                                                                     </div>
                                                                  </div>
                                                               </section>
                                                            </article>
                                                               <!--close-->
                                                         </div>
                                                      </div>
                                                   </div>
                                                      <!-- name and occupation close-->
                                                      <div class="panel panel-default panel-transparent">
                                                         <div class="panel-heading" role="tab" id="ContactDetails44">
                                                            <h4 class="panel-title"> 
                                                               <a data-toggle="collapse" href="#ContactDetails2" aria-expanded="true"> 
                                                                  <span class="accordion-head">
                                                                     <i class="fa fa-minus text-sm mr-5"></i>Additional Information
                                                                  </span> 
                                                               </a> 
                                                            </h4>
                                                         </div>
                                                         <div id="ContactDetails2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="ContactDetails44">
                                                            <div class="panel-body">
                                                               <article class="page-content">
                                                                  <section class="block bottom20">
                                                                     <div class="row entity-detail">
                                                                        <div class="col-lg-2 ralign">
                                                                           <span class="title">Customer Category :</span>
                                                                        </div>
                                                                        <div class="col-lg-2 info-ralign">
                                                                           <?=$result->categories;?>
                                                                        </div>
                                                                        <div class="col-lg-2 ralign">
                                                                           <span class="title">Customer Source :</span>
                                                                        </div>
                                                                        <div class="col-lg-2 info-ralign">
                                                                           <?=$result->source?>
                                                                        </div>
                                                                        <div class="col-lg-2 ralign">
                                                                           <span class="title">Last Visit :</span>
                                                                        </div>
                                                                        <div class="col-lg-2 info-ralign">
                                                                           <?=$result->last_visit?> 
                                                                        </div>
                                                                     </div>
                                                                     <div class="row entity-detail">
                                                                        <div class="col-lg-2 ralign">
                                                                           <span class="title">Address :</span>
                                                                        </div>
                                                                        <div class="col-lg-2 info-ralign">
                                                                           <?=$result->address;?>      
                                                                        </div>
                                                                     </div>
                                                                  </section>
                                                               </article>
                                                               
                                                               <!--close-->
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <!--Contact Details close-->
                                                   </div>
                                                </div>
                                                <!--tile-body p-0 close-->
                                             </div>
                                       </section>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- details close -->
                                 <div role="tabpanel" class="tab-pane" id="related">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="tile-body">
                                             <div class="activity-stats main-stats" data-total-count="0">
                                                <div class="block-items">
                                                   <div id="note-stats" class="block-item large-block card-block" title="Contacts" data-target="#notes-grid-container">
                                                      <div class="card-icon">
                                                      <i class="fa fa-user-plus"></i>
                                                      </div>
                                                      <div class="block-item-count card-count">
                                                         <p class="content-count"><?=$cntrows?></p>
                                                         <p class="top-label content-text">Number of Visits</p>
                                                      </div>
                                                   </div>
                                                   <!--note-stats close-->
                                                   <div id="note-stats" class="block-item large-block card-block" title="Contacts" data-target="#notes-grid-container">
                                                      <div class="card-icon">
                                                      <i class="fa fa-money card-icon"></i>   
                                                      </div>
                                                      <div class="block-item-count card-count">
                                                         <p class="content-count"> <?=$getSales->total_sales?> </p>
                                                         <p class="top-label content-text">Sales Amount</p>
                                                      </div>
                                                   </div>
                                                   <!--note-stats close-->
                                                   <div id="note-stats" class="block-item large-block card-block" title="Contacts" data-target="#notes-grid-container">
                                                      <div class="card-icon">
                                                         <i class="fa fa-user-secret"></i>
                                                      </div>
                                                      <div class="block-item-count card-count">
                                                         <p class="content-count"><?=$result->visit_count?></p>
                                                         <p class="top-label content-text">Loyalty Visits</p>
                                                      </div>
                                                   </div>
                                                   <!--note-stats close-->
                                                </div>
                                             </div>
                                             <!--activity-stats close-->
                                             <div class="tile-body p-0">
                                                <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                   <div class="panel panel-default panel-transparent">
                                                      <div id="nameandoccupation8" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="nameandoccupation">
                                                         <div class="panel-body__">
                                                            <div>
                                                               <article class="page-content">
                                                                  <section class="block bottom20">
                                                                     <div class="entity-detail">
                                                                        <div class="table-responsive">
                                                                           <table class="table mb-0" id="usersList">
                                                                              <thead>
                                                                                 <tr class="row-color">
                                                                                    <th>Visits</th>
                                                                                    <th>Store</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Source</th>
                                                                                    <th>Visit Date</th>
                                                                                 </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                 <?php 
                                                                                    $i=1;
                                                                                    foreach ($cntct->result() as $getCntct) {
                                                                                    ?>
                                                                                 <tr class="record">
                                                                                    <td><?php echo $i++; ?></td>
                                                                                    <td><?php 

                                                                                    $store=$this->db->query("select * from tbl_user_mst where user_id='".$this->session->userdata('user_id')."'");
                                                                                    $getStore=$store->row();
                                                                                    echo $getStore->first_name." ".$getStore->last_name?></td>
                                                                                    <td>
                                                                                       <?php 
                                                                                          if($getCntct->sales_amount != ''){
                                                                                            echo $getCntct->sales_amount;  
                                                                                          }else{
                                                                                              echo "0";
                                                                                          }
                                                                                          ?>        
                                                                                    </td>
                                                                                    <td><?php
                                                                                       $hdr=$this->db->query("select * from tbl_customers where customer_id='$getCntct->customer_id' ");
                                                                                       $getHdr=$hdr->row();
                                                                                       echo $getHdr->source;
                                                                                       ?></td>
                                                                                    <td><?=$getCntct->log_date?></td>
                                                                                 </tr>
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
                                                </div>
                                             </div>
                                             <!--tile-body p-0 close-->
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- related close -->
                              </div>
                           </div>
                        </div>
                  </section>
                  </div>
               </div>
            </div>
      </section>
      </div>
   </div>
</div>
<!-- Close ajax_content -->
<?php $this->load->view('footer.php'); ?>