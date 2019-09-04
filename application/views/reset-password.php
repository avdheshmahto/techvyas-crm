<?php
   if($result != ""){
       $user_id       = $result->user_id;
       $user_name     = $result->first_name." ".$result->last_name;
       $email_id      = $result->email_id;
       //$confirm_email = $result->confirm_email;
    } 
   ?>
<!doctype html>
<html class="no-js" lang="">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>CRM | Beyrl Systems</title>
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
      <!--/ stylesheets -->
      <!-- ==========================================
         ================= Modernizr ===================
         =========================================== -->
      <script src="<?=base_url();?>assets/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
      <!--/ modernizr -->
   </head>
   <body id="minovate" class="appWrapper">
      <div id="wrap" class="animsition">
         <div class="page page-core page-locked">
            <div class="container w-420 p-10 pb-0 bg-white mt-40">
               <div class="text-center logo-pwd">
                <img src="<?=base_url();?>img/beryl_index.png" class="logo-reset" alt=""></h3>
               </div>
               <div class="lt wrap-reset mb-10 mt-10 p-10 text-center">
                  <h2 class="m-0">Reset Your Password!</h2>
               </div>
               <div class="media p-15">
                  <div class="pull-left thumb thumb-lg mr-20"> <img class="media-object img-circle" src="<?=base_url();?>assets/assets/images/ici-avatar__.jpg" alt=""> </div>
                  <div class="media-body">
                     <form method="post" action="passwordReset" class="form-validation">
                        <h5 class="media-heading mb-20">Email&nbsp;&nbsp; :&nbsp; <strong> <?=$email_id;?></strong></h5>
                        <h5 class="media-heading mb-20">Name &nbsp;: &nbsp;<b> <?=$user_name;?></b></h5>
                        <div class="form-group mt-10">
                           <input type="hidden" name="emailid" value="<?=$email_id;?>" class="form-control underline-input mb-10">
                           <input type="hidden" name="useridd" value="<?=$user_id;?>" class="form-control underline-input">
                           <input type="password" name="entrpaswrd" id="entrpaswrd" placeholder="New Password" class="form-control underline-input mb-10" required="">
                           <input type="password" name="rentrpaswrd" id="rentrpaswrd" placeholder="Confirm Password" class="form-control underline-input" required="">
                        </div>
                        <div class="reset-pwd mt-30 "> 
                           <button type="button" onclick="validatePassword(this);" class="btn btn-greensea b-0 br-2 mr-5">Reset</button>
                        </div>
                        <div class="lt wrap-reset not-you m-0 pb-0">
                          <p class=""> <a href="<?=base_url();?>">Not you?</a> </p>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--/ Application Content -->
      <!-- ============================================
         ============== Vendor JavaScripts ===============
         ============================================= -->
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
      </script>
      <!--/ Page Specific Scripts -->
      <script type="text/javascript">
         function validatePassword(v)
         {
             var newpass=document.getElementById('entrpaswrd').value;
             var cnfpass=document.getElementById('rentrpaswrd').value;
         
             //alert(cnfpass);
             // if(newpass == '' || cnfpass == '')
             // {
             //   alert("Please Enter Details !");
             // }
         
             if(newpass == cnfpass)
             {
                 v.type="submit";
             }
             else
             {
                 alert("New Password and Confirm Password Not Match !");
             }
         }
         
      </script>
   </body>
</html>