<!doctype html>
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>CRM | Beryl Systems</title>
<link rel="icon" type="image/ico" href="<?=base_url();?>img/beryl.png" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
<!-- vendor css files -->
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/animate.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/animsition/css/animsition.min.css">
<!-- project main css files -->
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/main.css">

<style>

.main-head{
    height: 150px;
    background: #FFF;
}

.sidenav {
    height: 100%;
    overflow-x: hidden;
    padding-top: 20px;
    background-color:#1F2633;
    color: #fff;
    padding: 30px 0px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}


</style>
<script src="<?=base_url();?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body id="minovate" class="appWrapper">
  <div class="sidenav">
    <div class="container w-420 p-15 mt-20 text-center">
      <img src="<?=base_url();?>img/beryl_index.png" alt="">
      <div class="login">
        <form class="form-validation form-border mt-20" method="post" action="<?=base_url();?>master/set_dashboard">
          <div id="username_error" class="error">
          <font color="#0033FF" style="display:marker"><b><?php echo $this->session->flashdata('error');?></b> </font>
          <font color="#0033FF" style="display:marker"><b><?php echo $this->session->flashdata('message');?></b> </font>
          </div>
          <div class="form-group mt-20">
            <input type="text" name="username" class="form-control underline-input_" placeholder="Enter email id or mobile number" onBlur="check_user(this.value);">
          </div>
          <div class="form-group mt-20">
            <input type="password" name="password" placeholder="Enter password" class="form-control underline-input_">
          </div>
          <input type="submit" id="login" class="btn btn-lg mt-50 login-button" disabled="true" value="Login">
          <div class="checkbox_ mt-30">
            <a href="<?php echo base_url();?>master/forgot_page" class="#">Forgot Password?</a>
          </div>
          <br>
          <div class="checkbox_">
            <a href="<?php echo base_url();?>master/sign_up" class="#">Sign Up !</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--sidenav close-->
  <div class="main">
    <div class="col-md-12 col-sm-12 text-center">
      <h1>Dashboards</h1>
      <h3>See your business. Chart your course.</h3>
      <img src="<?=base_url();?>assets/assets/images/dashboard.png" alt="" class="img-responsive signin-img">
    </div>
  </div>
  <!--main close-->
  <div class="footer-bg footer-color">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 text-center text-color">
      Copyright &copy; <?php echo date('Y');?> &nbsp; <a target="_blank" class="text-link" href="http://berylsystems.com/"> Beryl Systems Pvt. Ltd. </a>&nbsp; All rights reserved.
      </div>
      <div class="col-sm-3"> </div>
    </div>
  </div>
  <!--footer-bg close-->
<script src="../../ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url();?>assets/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
<script src="<?=base_url();?>assets/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/jRespond/jRespond.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/screenfull/screenfull.min.js"></script>
<!--/ vendor javascripts -->
<!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
<script src="<?=base_url();?>assets/assets/js/main.js"></script>
<!--/ custom javascripts -->
<!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
<script>

  $(window).load(function(){
  });

  function check_user(value){
   var ur = "master/ajax_checkuser";
  // alert(value);
   $.ajax({
     url:ur,
     type:"POST",
     data:{'val':value},
     success:function(data){
       console.log(data);
       if(data != value)
       {
            if(data == 0){
              $('#username_error').html("Sorry. This email id or mobile number does not exist");
              $('#login').attr('disabled',true);
              return false;
            } else {
              $('#username_error').html("");
              $('#login').attr('disabled',false);
            }              
        }
        else{
          $('#login').removeAttr("disabled");
        }
     }
   });
  }
</script>
<!--/ Page Specific Scripts -->
</body>
</html>
