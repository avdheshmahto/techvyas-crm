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
               