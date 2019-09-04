<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CRM  | Beryl Systems</title>
    <link rel="icon" type="image/ico" href="<?=base_url();?>img/beryl.png" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ============== Stylesheets =================== -->
    <!-- vendor css files -->
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/animate.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/summernote/summernote.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
    <!-- project main css files -->
    <link rel="stylesheet" href="<?=base_url('customjs/jquery.typeahead.css');?>">
    <style type="text/css">
      .typeahead__container{
      font-size: 14px !important;
      }
      span.highlight__ {
      background-color: #ff0;
      display: -webkit-inline-box;
      }
    </style>

    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/main.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/activity.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/chosen/chosen.css">
    <!--/ stylesheets -->
    <!-- ==================== Modernizr ===================== -->
    <script src="<?=base_url();?>assets/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link href="<?=base_url();?>assets/assets/css/pipeline.css" rel="stylesheet">
    <!--/ modernizr -->
  </head>
  <body id="minovate" class="appWrapper">
    <div id="wrap" class="animsition">
    <!-- ======================== HEADER Content =============================== -->
    <section id="header">
      <header class="clearfix">
        <!-- Branding -->
        <!-- Branding end -->
        <!-- Left-side navigation -->
        <ul class="nav-left pull-left list-unstyled list-inline">
          <li class="sidebar-collapse divided-right"> 
            <a class="brand mt-5" href="<?=base_url();?>master/dashboard"> 
            <span><img src="<?=base_url();?>img/beryl_icon.png" class="logo-header" alt=""></span> 
            </a>
          </li>
          <li>
            <a href="#" class="collapse-sidebar mt-10">
            <i class="fa fa-outdent"></i>
            </a>
          </li>
        </ul>
        <!-- Left-side navigation end -->
        <!-- Search -->
        <script src="<?=base_url();?>assets/assets/chart_dashboard/labelschart_js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script>
          $(document).ready(function(){
            $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
          
              $("#myList").css('display','block');
              $("#myList li").filter(function() {
          
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
          });
          $(document).click(function (event) {            
              $('#myList').css('display','none');
              $('#myInput').val("");
          });
        </script>
        <!-- <div class="search" id="main-search">
          <input type="text" class="form-control underline-input" id="myInput" placeholder="Search...">
          </div> -->
        <ul id="myList" style="display: none;position: absolute;max-height: 200px !important;"></ul>
        <!-- Search end -->
        <!-- Right-side navigation -->
        <ul class="nav-right pull-right list-inline">
          <li class="dropdown nav-profile">
            <a href class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i> <span>
            <?php 
              $user=$this->db->query("select * from tbl_user_mst where user_id='".$this->session->userdata('user_id')."' ");
              $getUser=$user->row();
              ?>
            <?=$getUser->first_name;?>
            <i class="fa fa-angle-down"></i></span> </a>
            <ul class="dropdown-menu animated littleFadeInRight pull-right" role="menu">
              <li> <a role="button" tabindex="0" href="<?=base_url();?>master/user_profile"> <i class="fa fa-user"></i>Profile </a> </li>
              <li> <a role="button" tabindex="0" href="<?=base_url();?>master/Userdetails/manage_users"> <i class="fa fa-user"></i>Users </a> </li>
              <li class="divider"></li>
              <li> <a role="button" tabindex="0" href="<?=base_url();?>master/logout"> <i class="fa fa-sign-out"></i>Logout </a> </li>
            </ul>
          </li>
        </ul>
        <!-- Right-side navigation end -->
      </header>
    </section>
    <!--/ HEADER Content  -->
    <div id="controls">
      <!-- ============== SIDEBAR Content ============================ -->
      <aside id="sidebar">
        <div id="sidebar-wrap">
          <div class="panel-group slim-scroll" role="tablist">
            <div class="panel panel-default">
              <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                <div class="panel-body panel-top">
                  <!-- ======================= NAVIGATION Content ======================= -->
                  <ul id="navigation">
                    <?php $uri = $_SERVER['REQUEST_URI'];
                      @$uri1=explode('/',$uri);
                      @$uri2=@$uri1[2]."/".@$uri1[3]; ?>
                    <li <?php if($uri2 == "master/dashboard") { ?> class="active" <?php } ?> ><a href="<?=base_url()?>master/dashboard" title="Dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <?php
                      @session_start();
                      @$main=$_session['main'];
                      @$submain=$_session['submain'];
                      @$sub=$_session['sub'];
                      @$page0=$_SERVER['REQUEST_URI'];
                      @$page=explode('/',$page0);
                      @$page1=@$page[2]."/".@$page[3]."/".@$page[4];
                      @$page2=@$page[2]."/".@$page[3];
                      
                      $moduleQuery=$this->db->query("select * from tbl_profile_mst where status='A' and profile_id='".$this->session->userdata('role')."' ORDER BY module_id ASC");
                      
                      foreach($moduleQuery->result() as $getModule)
                      {
                      
                        if($getModule->create_id=='1' or $getModule->edit_id=='1' or $getModule->read_id=='1' or $getModule->delete_id=='1')
                        {
                          $moQuery=$this->db->query("select *from tbl_module_mst where module_id='$getModule->module_id' AND status='A' order by module_id asc");
                          $getMo=$moQuery->row();
                          ?>
                    <li <?php if($getMo->url==$page1 or $getMo->url==$page2){?> class="active"<?php } ?>><a href="<?php echo base_url();?><?php echo $getMo->url; ?>" title="<?=$getMo->module_name;?>"><i class="<?php echo $getMo->module_url; ?>"></i><span ><?php echo $getMo->module_name; ?></span></a></li>
                    <?php } ?> 
                    <?php } ?>
                  </ul>
                  <!--/ NAVIGATION Content -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>
      <!--/ SIDEBAR Content -->
    </div>
    <style type="text/css">
      .msg_container_base_hdr{
      background: #F5F5F5;
      margin: 0;
      padding: 0 0px 21px;
      max-height:300px;
      overflow-x:hidden;
      }
      .msg_container_base_hdr::-webkit-scrollbar-track
      {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      background-color: #F5F5F5;
      }
      .msg_container_base_hdr::-webkit-scrollbar
      {
      width: 12px;
      background-color: #F5F5F5;
      }
      .msg_container_base_hdr::-webkit-scrollbar-thumb
      {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
      }
    </style>