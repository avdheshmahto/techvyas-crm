
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
          