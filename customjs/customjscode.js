//=======================================User Form================================

$("#UserForm").validate({
      rules: {
       first_name: "required",
       mobile_no:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "add_edit_user";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultareauser").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#userModal .close").click();
                    $("#resultareauser").text(" "); 
                    $('#UserForm')[0].reset(); 
                    $("#userid").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultareauser").text(data);
                 }
                 ajex_UserListData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajex_UserListData(){
  ur = "ajax_userData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#ajax_content").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function editUser(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#userid').val(editVal.user_id);
      
      $('#first_name').val(editVal.first_name);
      $('#last_name').val(editVal.last_name);      
      $('#mobile_no').val(editVal.mobile_no);
      $('#email_id').val(editVal.email_id);
      $('#date_of_birth').val(editVal.date_of_birth);
      $('#gender').val(editVal.gender).prop('selected',true);      
      $('#address').val(editVal.address);
      $('#city').val(editVal.city);
      $('#state').val(editVal.state).prop('selected',true);      
      $('#pin_code').val(editVal.pin_code);
      //$('#new_password').val(editVal.password).prop('readonly',true);       
      //$('#confirm_password').val(editVal.password).prop('readonly',true);
      $('#buseiness_name').val(editVal.buseiness_name);
      $('#business_code').val(editVal.business_code);      
      $('#category').val(editVal.category);
      //$('#sub_category').val(editVal.sub_category); 
      show_sub_catg(editVal.sub_category);
      $('#manager_email').val(editVal.manager_email);
      $('#manager_mobile').val(editVal.manager_mobile);      
      $('#time_from').val(editVal.time_from);
      $('#time_to').val(editVal.time_to);       

    }  
      
      if(button_property == 'view'){
       $('.top_title').html('View');
       $("#UserForm :input").prop("disabled", true);
      }else{
      $('.top_title').html('Update');
       $("#UserForm :input").prop("disabled", false);
      }
};



//========================Customer Form =======================


$("#CustomerForm").validate({
      rules: {
       first_name: "required",
       //last_name:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "edit_customer";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultareacustomer").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#customerModal .close").click();
                    $("#resultareacustomer").text(" "); 
                    $('#CustomerForm')[0].reset(); 
                    $("#customer_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultareacustomer").text(data);
                 }
                 ajex_CustomerListData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajex_CustomerListData(){
  ur = "ajax_customerData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#ajax_content").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function editCustomer(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#customer_id').val(editVal.customer_id);
      $('#mobile_no').val(editVal.mobile_no);
      $('#email_id').val(editVal.email_id);
      $('#first_name').val(editVal.first_name);
      $('#last_name').val(editVal.last_name);      
      $('#dob').val(editVal.date_of_birth);      
      $('#anniversary').val(editVal.anniversary);      

      /*if(editVal.date_of_birth != "")
      {
        j_dob = JSON.parse(editVal.date_of_birth);
           if(j_dob != ""){
            for(var i=0;i<j_dob.length;i++){
              if(i == 0)
                $('#dob0').val(j_dob[0]);
              else
                addRowDob(j_dob[i],i);

         }
        }
      }

       if(editVal.anniversary != ""){
        j_anniversary = JSON.parse(editVal.anniversary);
        if(j_anniversary != ""){
        for(var i=0;i<j_anniversary.length;i++){
          if(i == 0)
           $('#anniversary0').val(j_anniversary[0]);
          else
           addRowAnniversary(j_anniversary[i],i);

          }
        }
      }*/

      $('#gender').val(editVal.gender).attr('selected',true);
      $('#address').val(editVal.address);
      $('#gst_no').val(editVal.gst_no);
      $('#pan_no').val(editVal.pan_no);
      //$('#sales_amount').val(editVal.sales_amount);
      $('#categories').val(editVal.categories).attr('selected',true);
      //$('#expected_date').val(editVal.expected_date);
      $('#remarks').val(editVal.remarks);
    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#CustomerForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#CustomerForm :input").prop("disabled", false);
    }

};


//============================Birthday Campaign Form=====================


$("#birthdayForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "birthday_campaign";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultareabirthday").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#birthdayModal .close").click();
                    $("#resultareabirthday").text(" "); 
                    $('#birthdayForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultareabirthday").text(data);
                 }
                 ajex_BirthDayData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajex_BirthDayData(){
  ur = "ajex_BirthDayListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_birthday_wishes(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);            
      $('#type').val(editVal.type);
      $('#sub_type').val(editVal.sub_type);

      $('#title').val(editVal.title);
      $('#language').val(editVal.language).attr('selected',true);
      $('#wishes_text').val(editVal.wishes_text);
      $('#send_before_days').val(editVal.send_before_days);
      $('#valid_till_days').val(editVal.valid_till_days);
      $('#vaild_till').val(editVal.vaild_till);
    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#birthdayForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#birthdayForm :input").prop("disabled", false);
    }

};

//========================Anniversary Campaign Form=============================

$("#anniversaryForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "anniversary_campaign";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultanniversary").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#anniversaryModal .close").click();
                    $("#resultanniversary").text(" "); 
                    $('#anniversaryForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultanniversary").text(data);
                 }
                 ajex_AnniversaryData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajex_AnniversaryData(){
  ur = "ajex_AnniversaryListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_anniversary_wishes(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);  
      $('#type').val(editVal.type);
      $('#sub_type').val(editVal.sub_type);

      $('#title').val(editVal.title);
      $('#language').val(editVal.language).attr('selected',true);
      $('#wishes_text').val(editVal.wishes_text);
      $('#send_before_days').val(editVal.send_before_days);
      $('#valid_till_days').val(editVal.valid_till_days);
      $('#vaild_till').val(editVal.vaild_till);
    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#anniversaryForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#anniversaryForm :input").prop("disabled", false);
    }

};


//================================Loyalty Campaign Form=======================

$("#LoyaltyForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "add_edit_loyalty";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultloyalty").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#loyaltyModal .close").click();
                    $("#resultloyalty").text(" "); 
                    $('#LoyaltyForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultloyalty").text(data);
                 }
                 ajax_LoyaltyData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajax_LoyaltyData(){
  ur = "ajex_loyaltyListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_loyalty(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);            
      $('#visits').val(editVal.visits);
      $('#free_items').val(editVal.free_items);
      $('#discount').val(editVal.discount);
      $('#discount_value').val(editVal.discount_value);
      $('#minimum_billing').val(editVal.minimum_billing);
      $('#maximum_discount').val(editVal.maximum_discount);
      $('#wishes_text').val(editVal.wishes_text);
    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#LoyaltyForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#LoyaltyForm :input").prop("disabled", false);
    }

};


//============================Events & Festivals Form===============

$("#eventsForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "add_edit_events";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultfestival").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#eventsModal .close").click();
                    $("#resultfestival").text(" "); 
                    $('#eventsForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultfestival").text(data);
                 }
                 ajax_FestivalData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajax_FestivalData(){
  ur = "ajex_eventsListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_events_wishes(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);            
      $('#type').val(editVal.type);
      $('#sub_type').val(editVal.sub_type);

      $('#title').val(editVal.title);
      $('#language').val(editVal.language).attr('selected',true);
      $('#wishes_text').val(editVal.wishes_text);
      $('#sent_date').val(editVal.sent_date);
      $('#vaild_till').val(editVal.vaild_till);

    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#eventsForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#eventsForm :input").prop("disabled", false);
    }

};



///============================Welcome==============================

$("#welcomeForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "add_edit_welcome";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultwelcome").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#welcomeModal .close").click();
                    $("#resultwelcome").text(" "); 
                    $('#welcomeForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultwelcome").text(data);
                 }
                 ajax_WelcomeData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajax_WelcomeData(){
  ur = "ajex_welcomeListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_welcome(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);                  
      $('#type').val(editVal.type);            

      $('#title').val(editVal.title);
      $('#language').val(editVal.language).attr('selected',true);
      $('#wishes_text').val(editVal.wishes_text);
      $('#valid_till_days').val(editVal.valid_till_days);
      $('#vaild_till').val(editVal.vaild_till);

    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#welcomeForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#welcomeForm :input").prop("disabled", false);
    }

};


//==============================bring back lost customer=============================

$("#bblcForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "add_edit_bblc";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultbblc").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#bblcModal .close").click();
                    $("#resultbblc").text(" "); 
                    $('#bblcForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultbblc").text(data);
                 }
                 ajax_BBLC_Data();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajax_BBLC_Data(){
  ur = "ajex_bblcListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_bblc(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);            
      $('#title').val(editVal.title);
      $('#language').val(editVal.language).attr('selected',true);
      $('#last_visited').val(editVal.last_visited);
      $('#till_day').val(editVal.till_day);
      $('#wishes_text').val(editVal.wishes_text);
      $('#start_date').val(editVal.start_date);
      $('#vaild_till').val(editVal.vaild_till);
      $('#gender').val(editVal.gender);
      $('#customer_source').val(editVal.customer_source);
      $('#customer_category').val(editVal.customer_category);
      $('#category').val(editVal.category);

    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#bblcForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#bblcForm :input").prop("disabled", false);
    }

};

//======================convert walkins into customer============================

$("#cwicForm").validate({
      rules: {
       title: "required",
       language:"required"
      },
      submitHandler: function(form) {
        //alert($('#TaskForm').serialize());
        //var formData = new FormData(form);
        ur = "add_edit_cwic";

         var formData = new FormData(form);

          $("#saveload").css("display","inline-block");
          $("#formsave").attr("type","button");
          $("#formsave").css("display","none");
        
          $.ajax({
              type : "POST",
              url  :  ur,
              //dataType : 'json', // Notice json here
              data : formData, // serializes the form's elements.
              //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  if(data == 1 || data == 2){
                    if(data == 1)
                      var msg = "Data Successfully Add !";
                    else
                      var msg = "Data Successfully Updated !";
                 
                    $("#resultcwic").text(msg); 
                    setTimeout(function() {   //calls click event after a certain time
                    $("#cwicModal .close").click();
                    $("#resultcwic").text(" "); 
                    $('#cwicForm')[0].reset(); 
                    $("#cmpgn_id").val("");
                    $("#saveload").css("display","none");
                    $("#formsave").css("display","inline-block");
                    $("#formsave").attr("type","submit");
                  }, 1000);
                }else{
                    $("#resultcwic").text(data);
                 }
                 ajax_CWIC_Data();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajax_CWIC_Data(){
  ur = "ajex_cwicListData";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
        //console.log(data);
     }
  });

}


function edit_cwic(ths) 
{

  //console.log('edit ready !');
  $('.project_images').remove();

  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
     //alert(editVal.contact_id);
    if(button_property != 'view')
    {

      $('#cmpgn_id').val(editVal.campaign_id);  
      $('#type').val(editVal.type);  
      $('#sub_type').val(editVal.sub_type);  

      $('#title').val(editVal.title);
      $('#language').val(editVal.language).attr('selected',true);
      $('#last_visited').val(editVal.last_visited);
      $('#till_day').val(editVal.till_day);
      $('#wishes_text').val(editVal.wishes_text);
      $('#start_date').val(editVal.start_date);
      $('#vaild_till').val(editVal.vaild_till);
      $('#gender').val(editVal.gender);
      $('#customer_source').val(editVal.customer_source);
      $('#customer_category').val(editVal.customer_category);
      $('#category').val(editVal.category);
    
    }  
      
    if(button_property == 'view'){
     $('.top_title').html('View');
     $("#cwicForm :input").prop("disabled", true);
    }else{
    $('.top_title').html('Update');
     $("#cwicForm :input").prop("disabled", false);
    }

};


//============================Campaign Template Form=================


$("#templateForm").validate({
    rules: {
     type: "required",
     //sub_type: "required",
     template_text: "required"
    },
    submitHandler: function(form) {
      //alert($('#TaskForm').serialize());
      //var formData = new FormData(form);
      ur = "add_edit_template";

       var formData = new FormData(form);

        $("#saveload").css("display","inline-block");
        $("#formsave").attr("type","button");
        $("#formsave").css("display","none");
      
        $.ajax({
            type : "POST",
            url  :  ur,
            //dataType : 'json', // Notice json here
            data : formData, // serializes the form's elements.
            //data : $('#OrganizationForm').serialize(), // serializes the form's elements.
              success : function (data) {
                //alert(data); // show response from the php script.
                if(data == 1 || data == 2){
                  if(data == 1)
                    var msg = "Data Successfully Add !";
                  else
                    var msg = "Data Successfully Updated !";
               
                  $("#result_template").text(msg); 
                  setTimeout(function() {   //calls click event after a certain time
                  $("#templateModal .close").click();
                  $("#result_template").text(" "); 
                  $('#templateForm')[0].reset(); 
                  $("#temp_id").val("");
                  $("#saveload").css("display","none");
                  $("#formsave").css("display","inline-block");
                  $("#formsave").attr("type","submit");
                }, 1000);
              }else{
                  $("#result_template").text(data);
               }
               //ajax_Template_Data();
             },
              error: function(data){
                  alert("error");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        return false;
      //e.preventDefault();
    }
});