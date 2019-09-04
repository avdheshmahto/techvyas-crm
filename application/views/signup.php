<!doctype html>
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>CRM | Beryl Systems</title>
<link rel="icon" type="image/ico" href="<?=base_url();?>img/beryl.png" />

<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/animate.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/vendor/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/chosen/chosen.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/js/vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/main.css">
<script src="<?=base_url();?>assets/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body id="minovate" class="appWrapper">
<div id="wrap" class="animsition">
  <div class="page page-core page-signup">
    <div class="container main-width p-15 bg-white text-center mt-20">
      <div class="text-center">
        <img src="<?=base_url();?>img/beryl3.png" alt="">
      </div>
      <h2 class="text-light text-greensea">Create An Account</h2>
      <form method="post" id="SinUpForm" class="form-validation mt-20">
        <div id="username_error" class="error"></div>    
        <p class="help-block text-left">Personal Information : </p>
          <div class="form-group">
        		<div class="row">
        			<div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="first_name" id="first_name" class="form-control underline-input" placeholder="First Name" required="">
              </div>
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="last_name" id="last_name" class="form-control underline-input" placeholder="Last name" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="tel" name="mobile_no" id="mobile_no" class="form-control underline-input" placeholder="Mobile" onkeyup="check_user_mobile(this.value);" maxlength="10" minlength="10" required="">
              </div>
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="email" name="email_id" id="email_id" class="form-control underline-input" placeholder="Email" onkeyup="check_user_email(this.value);" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
      			  <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="new_password" id="new_password" placeholder="Password" class="form-control underline-input" required="">
              </div>
          	  <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="cnf_password" id="cnf_password" placeholder="Confirm Password" class="form-control underline-input" required="">
              </div>
            </div>
      		</div>
        <p class="help-block text-left">Business Information : </p>
          <div class="form-group">
            <div class="row">
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="buseiness_name" id="buseiness_name" class="form-control underline-input" placeholder="Business Name" required="">
              </div>
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <select class="form-control underline-select" name="category" id="category" onchange="subcatg(this.value);">
                  <option value="">Category</option>
                  <option value="18">Automobiles</option>             
                  <option value="17">Electronics</option>                          
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="selectpeople">
                  <select name="sub_category[]" id="sub_category" class="underline-select" multiple="multiple" style="width: 100%" >
                    <option value="">Sub Category</option>
                  </select>
              </div>
              </div>
            </div>
          </div>    
          <div class="form-group">
            <div class="row">
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <select name="state" id="state" class="form-control underline-select">
                  <option value="">Select State</option>
                  <?php $state=$this->db->query("select * from tbl_state_m where status='A' order by stateName"); 
                  foreach ($state->result() as $value) {  ?>
                    <option value="<?=$value->stateid?>"><?=$value->stateName?></option>
                  <?php } ?>
                </select> 
              </div>        
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="city" id="city" class="form-control underline-input" placeholder="City">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="address" id="address" class="form-control underline-input" placeholder="Street Address">
              </div>
              <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="pin_code" id="pin_code" placeholder="Pin Code" class="form-control underline-input" maxlength="6" minlength="6">
              </div>
            </div>
          </div>
          <div class="form-group signup-footer">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                  <input type="checkbox" id="terms">
                    <i></i>
                </label> I agree to the <a href="javascript:;">Terms of Service</a> &amp; <a href="javascript:;">Privacy Policy</a>       
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20 signup-btn">
                  <input type="button" class="btn btn-register b-0 text-uppercase_ pull-right" value="Register Now" onclick="validateForm(this)" id="saveButton"> 
                  <span>Already Have an Account? <a href="index" class="b-0 text-uppercase_ login-link">Login</a>
                  </span>
              </div>
            </div>
          </div>
          
      </form>
    </div>
  </div>
</div>


<script>window.jQuery || document.write('<script src="<?=base_url();?>assets/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
<script src="<?=base_url();?>assets/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/jRespond/jRespond.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/screenfull/screenfull.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/main.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/chosen/chosen.jquery.min.js"></script>
</body>
</html>

<script type="text/javascript">
  

function subcatg(v)
{
  //alert(v);
 ur="<?=base_url();?>master/get_sub_catg";
  $.ajax({
      url   : ur,
      type  : "POST",
      data  : {'ctg':v},
      success:function(data)
      {
        //alert(data);
        if(data != '')
        {
          $("#sub_category").empty().append(data);
        }
      }
  })
}
function check_user_mobile(value)
{
 var ur = "master/ajax_checkuser_mobile";
 // alert(value);
 $.ajax({
   url:ur,
   type:"POST",
   data:{'val':value},
   success:function(data){
     console.log(data);
          if(data == 1){
            $('#username_error').html("Sorry. This mobile number already exist");
            $('#saveButton').attr('disabled',true);
          } else {
            $('#username_error').html("");
            $('#saveButton').attr('disabled',false);
          }
      }
  });
}
function check_user_email(value)
{
 var ur = "master/ajax_checkuser_email";
 // alert(value);
 $.ajax({
   url:ur,
   type:"POST",
   data:{'val':value},
   success:function(data){
     console.log(data);
          if(data == 1){
            $('#username_error').html("Sorry. This email already exist");
            $('#saveButton').attr('disabled',true);
          } else {
            $('#username_error').html("");
            $('#saveButton').attr('disabled',false);
          }
      }
  });
}
function validateForm(v) 
{
  var x = $("#mobile_no").val();
  var y = $("#pin_code").val();
  var newP=$("#new_password").val();
  var cnfP=$("#cnf_password").val();
  var tCheck=$('#terms').is(":checked");
  //alert(tCheck);
  if(isNaN(x)) 
  {
    alert("Enter Valid Mobile Number !");
  }
  else if(isNaN(y))
  {
    alert("Enter Valid Pin Code !");
  }
  else if(newP != cnfP)
  {
    alert('Password and confirm password must be same !')
  }
  else if(tCheck == false)
  {
    alert("Please accept terms of serive & privacy policy ")
  }
  else if(!isNaN(x) && !isNaN(y) && newP == cnfP && tCheck == true)
  {
    v.type="submit";
    $("#SinUpForm").attr('action','<?=base_url();?>master/user_signup');
  }
}
</script>


