<!-- listdataid -->
<article class="page-content">
  <section class="block bottom20">
    <div class="entity-detail">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
            <tr class="row-color">
              <th>Name</th>
              <th>Description</th>
              <th>Start Date</th>
              <th>Valid Till</th>
              <th style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $i=1;
              $cwic=$this->db->query("select * from tbl_campaign where type='Walkins Customers' AND maker_id='".$this->session->userdata('user_id')."' ");
              foreach ($cwic->result() as $getCwic) {
              ?>
            <tr class="record">
              <td><?php echo $getCwic->title; ?></td>
              <td style="width: 50%">                  <?php echo $getCwic->wishes_text; ?>
              </td>
              <td><?php echo $getCwic->start_date; ?></td>
              <td><?php echo $getCwic->vaild_till; ?></td>
              <td>
                <?php 
                  $pri_col='campaign_id';
                  $table_name='tbl_campaign';
                  ?>
                <div class="btn-group pull-right">
                  <a href="#" class=" dropdown-toggle-" title="Actions" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#" onclick="edit_cwic(this);" property = "edit" type="button" data-toggle="modal" data-target="#cwicModal" arrt= '<?=json_encode($getCwic);?>'  data-backdrop='static' data-keyboard='false'><i class="fa fa-edit"></i> Edit This Campaign</a></li>
                    <li><a href="#" class="delbutton" id="<?php echo $getCwic->campaign_id."^".$table_name."^".$pri_col ; ?>"><i class="fa fa-trash"></i> Delete This Campaign</a></li>
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