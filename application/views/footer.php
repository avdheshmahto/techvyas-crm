<?php $this->load->view('javascriptPage'); ?>

<div class="footer-bg footer-bg-color">
<div class="row">
<div class="col-sm-12 text-color text-center">
Copyright &copy; <?php echo date('Y');?> <a target="_blank" class="text-link" href="http://berylsystems.com/"> Beryl Systems Pvt. Ltd. </a> All rights reserved.
</div>
</div>
</div>



<script>window.jQuery || document.write('<script src="<?=base_url();?>assets/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<!--- typehead js-->
<script src="<?=base_url('customjs/jquery.typeahead.js');?>"></script>
<!---close typehead js-->

<script src="<?=base_url();?>assets/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/jRespond/jRespond.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/d3/d3.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/d3/d3.layout.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/rickshaw/rickshaw.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/screenfull/screenfull.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/flot/jquery.flot.min.js"></script>

<script src="<?=base_url();?>assets/assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/raphael/raphael-min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/morris/morris.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/slider/bootstrap-slider.min.js"></script>

<script src="<?=base_url();?>assets/assets/js/vendor/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/summernote/summernote.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/fullcalendar/fullcalendar.min.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/coolclock/coolclock.js"></script>
<script src="<?=base_url();?>assets/assets/js/vendor/coolclock/excanvas.js"></script>


<!-- ============== Custom JavaScripts =============== -->
<script src="<?=base_url();?>assets/assets/js/main.js"></script>
<!--/ =============Custom Javascripts ================ -->

<!-- =========================== Page Specific Scripts ====================== -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="<?=base_url();?>customjs/customjscode.js"></script>


<script>
    $(window).load(function(){
        $('#ex1').slider({
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });
        $("#ex1").on("slide", function(slideEvt) {
            $("#ex1SliderVal").text(slideEvt.value);
        });

        $("#ex2, #ex3, #ex4, #ex5").slider();

        //load wysiwyg editor
        $('#summernote').summernote({
            height: 100   //set editable area's height
        });
        //*load wysiwyg editor
    });
</script>
<!--/ Page Specific Scripts -->


<script type="text/javascript">
//manage page search script//

function doSearch() {
  var $rows = $('#dataTable tr');
  var val = $.trim($('#searchTerm').val()).replace(/ +/g, ' ').toLowerCase();
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
         if(text == "" || val == ''){
           $(this).css('color','black');
          } else {
         
            $(this).css('color','green');
        }
        console.log(val);
        return !~text.indexOf(val);
    }).hide();
}

// ends

//-===header search=================
function doSearch1() {
  var $rows = $('#dataTable tr');
  var val = $.trim($('#searchTerm1').val()).replace(/ +/g, ' ').toLowerCase();
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
         if(text == "" || val == ''){
           $(this).css('color','black');
          } else {
         
            $(this).css('color','green');
        }
        console.log(val);
        return !~text.indexOf(val);
    }).hide();
}
//////////////////close//////////////////////

function loadFile(ths) {
  if (ths.files && ths.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#image').attr('src', e.target.result);
            };
          reader.readAsDataURL(ths.files[0]);
        }
}


 //=============start url get entries code==================

$("#entries").change(function()
    {
      var value=$(this).val();
      var pageurl  = $(this).attr('url');
      
      url = pageurl+"&entries="+value;
      window.location.href = url;
    });

$("#filter").change(function()
    {
      var value=$(this).val();
      var pageurl  = $(this).attr('url');
      
      url = pageurl+"&filter="+value;
      window.location.href = url;
    });

//=============end url get entries code==================

$(document).ready(function(){
  
  $('.msg_container_base').css('display','none');
  $('.glyphicon-minus').addClass('glyphicon-plus').removeClass('glyphicon-minus');
  $('.icon_minim').addClass('panel-collapsed');

  $('.summernote').summernote({
            height: 100   //set editable area's height
        });
  
   $(document).delegate("#formreset","click",function(){
      var formid =  $('#formreset').attr('formid');
      //alert(formid);
      $(formid)[0].reset();
      
      $(".hiddenField").val('');
      $(".chosen-select").trigger('chosen:updated');
      //$(".top_title").html('Add');
      $(".error").html('');
      $('.project_images').remove();
      $('#summernote').code('');

    });

});


// ===============starts here this javascript code is for single delete ===============


$(function() {
$(document).delegate(".delbutton_customers","click",function(){  
 //Save the link in a variable called element
 var element = $(this);
 //Find the id of the link that was clicked
 var del_id = element.attr("id");
 //Built a url to send
 var info = 'id=' + del_id;

  if(confirm("Are You Sure? You want to delete !"))
   {
    $.ajax({
     type: "GET",
     url: "delete_data_customers",
     data: info,
     success: function(){
     }
  });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }
return false;
});
});




$(function() {
$(document).delegate(".delbutton_user","click",function(){  
 //Save the link in a variable called element
 var element = $(this);
 //Find the id of the link that was clicked
 var del_id = element.attr("id");
 //Built a url to send
 var info = 'id=' + del_id;

  if(confirm("Are You Sure? You want to delete !"))
   {
    $.ajax({
     type: "GET",
     url: "delete_data_user",
     data: info,
     success: function(){
     }
  });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }
return false;
});
});

  
$(function() {
$(document).delegate(".delbutton","click",function(){  
 //Save the link in a variable called element
 var element = $(this);
 //Find the id of the link that was clicked
 var del_id = element.attr("id");
 //Built a url to send
 var info = 'id=' + del_id;

  if(confirm("Are You Sure? You want to delete !"))
   {
    $.ajax({
     type: "GET",
     url: "delete_data",
     data: info,
     success: function(){
     }
  });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }
return false;
});
});

  //------------------------Multiple Delete Single  table---------------------
  
  //$('.delete_all').on('click', function(e) { 
    $(document).delegate(".delete_all_","click",function(e){
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });  

    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      //$("#loading").show(); 
      WRN_PROFILE_DELETE = "Are you sure? You want to delete this row!";  
      var check = confirm(WRN_PROFILE_DELETE);  
      //alert(check);
      if(check == true){  
        //for server side
        var table_name=document.getElementById("table_name").value;
        var pri_col=document.getElementById("pri_col").value;
        var join_selected_values = allVals.join(","); 
        //alert(join_selected_values);
  
        $.ajax({   
          type: "POST",  
          url: "multiple_delete_table",  
          cache:false,  
          data: "ids="+join_selected_values+"&table_name="+table_name+"&pri_col="+pri_col,  
          //alert(data);
          success: function(response)  
          {   
            $("#loading").hide();  
            $("#msgdiv").html(response);
           //referesh table
          }   
        });
      //for client side
        $.each(allVals, function( index, value ) {
          $('table tr').filter("[data-row-id='" + value + "']").remove();
        });
        

      }  
    }  
  });

// ends here this javascript code is for multiple delete 

</script>

<!--dateTimePicker js final close-->  
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/date-time/jquery.datetimepicker.css"/>
<script src="<?=base_url();?>assets/assets/date-time/jquery.datetimepicker.js"></script>
<script>
$('.datetimepicker_mask').datetimepicker({
  //mask:'9999/19/39 29:59',
});
</script>
<!--dateTimePicker js final close-->