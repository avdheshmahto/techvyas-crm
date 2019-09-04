
  <section id="content">
    <div class="page page-tables-bootstrap">
      <div class="row">
        <div class="col-md-12">
          <section class="tile">
            <div class="pageheader tile-bg">
              <h3>Users</h3>
              <div class="page-bar">
                <ul class="page-breadcrumb mt-20">
                  <div class="btn-toolbar pull-left">
                    <div class="btn-group">
                      <select class="input-sm form-control inline">
                        <option value="0">All Users</option>
                      </select>
                    </div>
                  </div>
                </ul>
                <!-- <div class="btn-toolbar pull-right">
                  <div class="btn-group">
                  <button class="btn btn-danger mb-10" data-toggle="modal" data-target="#userModal" formid="#UserForm" id="formreset">Add User</button>
                  </div>
                  <div class="btn-group">
                  </div>
                  </div> -->
              </div>
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
                        <select class="btn btn-default btn-sm" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('master/Userdetails/manage_users?');?>">
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
                    <div class="col-sm-4"></div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <input type="text" class="input-sm form-control" id="searchTerm"  onkeyup="doSearch()" placeholder="Search...">
                        <span class="input-group-btn">
                        </span> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /tile body -->
              <div class="tile-body p-0">
                <div class="table-responsive table-overflow___">
                  <table class="table mb-0 table-hover" id="tblData">
                    <thead>
                      <tr class="row-color">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Email Id</th>
                        <th>Business Name</th>
                        <th>Business Code</th>
                        <th>Category</th>
                        <th style="text-align: right;">Action</th>
                      </tr>
                    </thead>
                    <tbody id="dataTable">
                      <?php 
                        foreach ($result as $fetch_list) {
                        ?>
                      <tr class="record" data-row-id="<?php echo $fetch_list->user_id; ?>">
                        <td><?php echo $fetch_list->first_name; ?></td>
                        <td><?php echo $fetch_list->last_name; ?></td>
                        <td><?php echo $fetch_list->mobile_no; ?></td>
                        <td><?php echo $fetch_list->email_id; ?></td>
                        <td><?php echo $fetch_list->buseiness_name; ?></td>
                        <td><?php echo $fetch_list->business_code; ?></td>
                        <td><?php
                          $data=$this->db->query("select * from tbl_master_data_mst where param_id='$fetch_list->category'");
                          $getData=$data->row();
                          echo $getData->keyname;
                          ?></td>
                        <td>
                          <?php 
                            $pri_col='user_id';
                            $table_name='tbl_user_mst';
                            ?>
                          <div class="btn-group pull-right">
                            <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" onclick="editUser(this);" property = "edit" type="button" data-toggle="modal" data-target="#userModal" arrt= '<?=json_encode($fetch_list);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This User</a></li>
                              <li style="display: none;"><a href="#" class="delbutton_user" id="<?php echo $fetch_list->user_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This User</a></li>
                            </ul>
                          </div>
                        </td>
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
                  <div class="col-sm-3 text-center"></div>
                  <div class="col-sm-4 text-right" style="margin: -22px 0px 0px 0px;">
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
