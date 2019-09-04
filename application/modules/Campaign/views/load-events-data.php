

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