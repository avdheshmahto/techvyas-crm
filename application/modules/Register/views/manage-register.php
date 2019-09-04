<?php $this->load->view('header.php'); ?>
<?php 
  $customer = $this->db->query("select * from tbl_customers where status='A' AND maker_id='".$this->session->userdata('user_id')."' ");
  $arr  = array();
  $arr1 = array();
  foreach ($customer->result() as $getCustomer) 
  { 
       
    //$arr[] = $getCustomer->mobile_no."-".$getCustomer->first_name." ".$getCustomer->last_name ;
    $arr[] = $getCustomer->mobile_no;
  } 
    
  $json_mobile  = json_encode($arr,true);
  //print_r($arr);
  
  ?>
<div id="ajax_content">
  <section id="content">
    <div class="page page-tables-bootstrap">
      <div class="row">
        <div class="col-md-12">
          <section class="tile">
            <input type="hidden" id="json_phone" value='<?=$json_mobile;?>'>
            <div class="pageheader tile-bg">
              <h3>Register Customer</h3>
            </div>
            <!--pageheader close-->
            <div id="nextModal">
              <div class="panel-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label-modal">* Mobile No : <span class="label label-success" id="newid" style="display: none;">new</span></label>
                    <div class="typeahead__container ">
                      <div class="typeahead__field">
                        <div class="typeahead__query">
                          <input class="js-typeahead_phone form-control underline-input"
                            name="mobile_no" 
                            id="mobile_no"
                            type="search"
                            autofocus
                            autocomplete="off" maxlength="10" minlength="10" placeholder="Enter Mobile Number">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label-modal">Email :</label>
                    <input class="form-control underline-input" name="email_id" id="email_id" type="email" placeholder="Enter Email ID">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="nextForm" class="btn modal-nxt" onclick="nextPage();registeredData();">Next</button>
              </div>
            </div>
            <!-- Modal Register -->
            <form  method="POST" id="formId">
              <div id="registerModal" style="display: none;">
                <div class="modal-body">
                  <div class="sb-container container-example1">
                    <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel-body">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">Mobile No : </label>
                            <input type="text" name="mobile_no_next" id="mobile_no_next" class="form-control disable-input" readonly="">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Email Id : </label>
                            <input type='text' name="email_id_next" id="email_id_next" class="form-control disable-input" readonly="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <input type="hidden" name="c_type" id="c_type" class="form-control">
                            <input type="checkbox" name="register_type" id="register_type" onclick="check_type();">&nbsp;&nbsp;&nbsp;<span class="label-modal">Customers</span>
                          </div>
                          <div class="form-group col-md-6">
                            <input type="checkbox" name="visit_count" id="visit_count" onclick="check_visit();">&nbsp;&nbsp;&nbsp;<span class="label-modal">Count Visit</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">First Name : </label>
                            <input type="text" name="first_name" id="first_name"  class="form-control underline-input input-height" required="">
                            <input type="hidden" name="oldcustomer_id" id="oldcustomer_id">
                          </div>
                          <div id="check_sales">
                            <div class="form-group col-md-6">
                              <label class="label-modal">Sales Amount : </label>
                              <input type="number" name="sales_amount" id="sales_amount" class="form-control underline-input input-height">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">Last Name : </label>
                            <input type='text' name="last_name" id="last_name" class="form-control underline-input input-height">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Customer Category : </label>
                            <select name="categories" id="categories" class="form-control">
                              <option value="">--Select--</option>
                              <option value="Alignment">Alignment</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">DOB : </label>
                            <input type="date" name="dob" id="dob" class="form-control underline-input input-height">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Anniversary : </label>
                            <input type='date' name="anniversary" id="anniversary" class="form-control underline-input input-height">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">Gender : </label>
                            <select name="gender" id="gender" class="form-control">
                              <option value="">--Select--</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Other">Other</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Request Expected Date : </label>
                            <input type="date" name="expected_date" id="expected_date" class="form-control underline-input input-height">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="label-modal">Address : </label>
                            <textarea name="address" id="address" class="form-control underline-textarea textarea-height"></textarea>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="label-modal">Request Text : </label>
                            <textarea name="remarks" id="remarks" class="form-control underline-textarea textarea-height"></textarea>
                          </div>
                        </div>
                      </div>
                      <!--panel close-->
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn modal-back" onclick="backModal();" style="display: none;">Back</button>
                  <button type="button" id="formsave" class="btn modal-nxt" onclick="saveRegistration(this)">Save</button>
                </div>
              </div>
            </form>
            <!-- Modal Register close-->
          </section>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /ajax_content -->
<?php $this->load->view('footer.php'); ?>
<script type="text/javascript">
  function nextPage()
  {
  
    var mo = $("#mobile_no").val();
    var em = $("#email_id").val();
  
    if(isNaN(mo) || mo == '' || (mo.length < 10) || (mo.length > 10))
    {
      alert("Enter valid mobile number !");
    }
    else
    {
          
      $("#mobile_no_next").val(mo);
      $("#email_id_next").val(em);
  
      $("#nextModal").css('display','none');
      $("#registerModal").css('display','block');
      
      $('#visit_count').prop('checked',true);
      $('#register_type').prop('checked',true);
      
      check_type();
      check_visit();
  
    }
  
  }
  
  function backModal()
  {
    $("#registerModal").css('display','none');
    $("#nextModal").css('display','block');  
  }
  
  function check_type()
  {
  
    var typ=$("#register_type").is(':checked');
  
    if(typ==false)
    {
      $("#c_type").val("Prospect");
    }
    else
    {
      $("#c_type").val("Customer");
    }
  
  }
  
  
  function check_visit()
  {
    
    var chk=$('#visit_count').is(':checked'); 
    //alert(chk);
    
    if(chk==false)
    {
      $("#check_sales").css('display','none');
      $("#sales_amount").val("");
    }
    else
    {
      $("#check_sales").css('display','block'); 
    }
  
  
  }
  
  
  function saveRegistration(v)
  {
   
    var mobile=$("#mobile_no_next").val();
    var firstName=$("#first_name").val();
  
    //alert(v);
    if(mobile !='' && firstName !='')
    {      
      $("#formId").attr('action', '<?=base_url();?>Register/register_customer');
      v.type="submit";
    }
    else
    {
      v.type="button";
      //$("#formId").attr('action', '');
      alert("Please Enter Required Field Value !");
    }
  
  }
  
  
  function registeredData()
  {
  
    var value=$("#mobile_no").val();
    var ur = "Register/ajax_checkRegisterdUser";
     
     //alert(value);
  
     $.ajax({
       url:ur,
       type:"POST",
       data:{'val':value},
       success:function(data){
         //console.log(data);
              if(data != false)
              {
               //console.log(data);
               data = JSON.parse(data);
  
               $("#newid").css("display","none");
               $('#oldcustomer_id').val(data.customer_id);
               $('#mobile_no').val(data.mobile_no);
               $('#email_id').val(data.email_id);
  
               if(data.type == 'Customer')
               {
                $('#register_type').attr("disabled",true);
                $('#register_type').prop('checked',true);
               }
               if(data.type == 'Prospect')
               {
                $('#register_type').prop('checked',false);
                $('#register_type').attr("disabled",false);
               }
  
               $('#first_name').val(data.first_name);
               $('#last_name').val(data.last_name);
               $('#dob').val(data.date_of_birth);      
               $('#anniversary').val(data.anniversary);
              
              $('#gender').val(data.gender).attr('selected',true);
              $('#address').val(data.address);
              //$('#sales_amount').val(data.sales_amount);
              $('#categories').val(data.categories).attr('selected',true);
              $('#expected_date').val(data.expected_date);
              $('#remarks').val(data.remarks);
            }
          }
      });
  
  }
  
</script>
<script type="text/javascript">
  var json_phone     = JSON.parse($('#json_phone').val());
   
    //console.log(json_phone);
    var data = {countries:json_phone};
  
    typeof $.typeahead === 'function' && $.typeahead({
        input: ".js-typeahead_phone",
        minLength: 1,
        order: "asc",
        maxItemPerGroup: 5,
        emptyTemplate: " <b style='color:blue'>{{query}}</b> will be added as a new mobile number !",
        source: {
            country: {
                data: data.countries
            },
        },
        callback: {
            onClickAfter: function (node, a, item, event) {
                event.preventDefault();
  
                var splitjs = item.display.split('-');
                var sindex  = "";
                if(splitjs.indexOf(1)==-1)
                  //sindex = splitjs[1];
                  sindex = splitjs[0];
                  //alert(sindex);
                  ur = "ajaxget_custPhoneData";
                  $.ajax({
                      type : "POST",
                      url  :  ur,
                      data :  {'id':sindex}, // serializes the form's elements.
                        success : function (data) {
                         // alert(data); // show response from the php script.
                         if(data != false){
                             //console.log(data);
                             data = JSON.parse(data);
  
                             $("#newid").css("display","none");
                             $('#oldcustomer_id').val(data.customer_id);
                             $('#mobile_no').val(data.mobile_no);
                             $('#email_id').val(data.email_id);
  
                             if(data.type == 'Customer')
                             {
                              $('#register_type').attr("disabled",true);
                              $('#register_type').prop('checked',true);
                             }
  
                             if(data.type == 'Prospect')
                             {
                              $('#register_type').prop('checked',false);
                              $('#register_type').attr("disabled",false);
                             }
  
                             $('#first_name').val(data.first_name);
                             $('#last_name').val(data.last_name);
                             $('#dob').val(data.date_of_birth);      
                             $('#anniversary').val(data.anniversary);
  
                            $('#gender').val(data.gender).attr('selected',true);
                            $('#address').val(data.address);
                            //$('#sales_amount').val(data.sales_amount);
                            $('#categories').val(data.categories).attr('selected',true);
                            $('#expected_date').val(data.expected_date);
                            $('#remarks').val(data.remarks);
  
                          }
                      }
                  });          
                $('.js-result-container').text('');                
           },
            onSearch:function (node, query) {
              //console.log(query);
  
              if(query != "")
              $("#newid").css("display","inline");
              $('.project_images').remove();
              $('#oldcustomer_id').val("");
              //$('#mobile_no').val("");
              $('#email_id').val("");
              $('#first_name').val("");
              $('#last_name').val("");
              $('#dob0').val("");
              $('#anniversary0').val("");
              $('#gender').val("").attr('selected',true);
              $('#address').val("");
              $('#sales_amount').val("");
              $('#categories').val("").attr('selected',true);
              $('#expected_date').val("");
              $('#remarks').val("");
                            
            },
  
            onResult: function (node, query, obj, objCount) {
                var text = "";
                if (query !== "") {
                    text = objCount + ' elements matching "' + query + '"';
                }
               //console.log(node);
               $("#newid").css("display","none");               
               if(objCount == 0)
                $("#newid").css("display","inline");
                $('.js-result-container').text(text);             
           }
        },
       // debug: true
    });
  
  
</script>