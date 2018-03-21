<?php 
include "header.php";
//$data=$user->all_select_data_withoutquery('users');
//$admn_details=$user->select_for_prticular_row_all2('admin_table','id',$_SESSION['userid']);
///////////////////////////////////////////////////////////////

?>
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <?php include "leftmenu.php";?>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Forms</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Add Vehicle Type</h2>
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="form_val" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Vehicle Type :</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="label" placeholder="Enter Vehicle Type" required><span id="error_msg" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Number of passengers :</label>
                      <div class="col-sm-10">          
                        <input type="text" class="form-control" id="downline" placeholder="Enter Number of passengers " required><span id="error_msg2" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Delux NA:</label>
                      <div class="col-sm-10">          
                        <select  class="form-control" id="deluxenableornot" required>
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">        
                      <label class="control-label col-sm-2" for="pwd">Image :</label>
                      <div class="col-sm-10">  
                        <input type="file"  class="form-control" id="file" placeholder="Enter Number of passengers " required><span id="error_msg2" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <a onclick="addPlan();" class="btn btn-primary" style="margin-left: 30px !important">Save</a>
                    </div>
                  </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
   
</div><!--/fluid-row-->

   
    <!-- Ad ends -->

    <hr>


    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href=" target="_blank">Sukalyan</a> 2012 - 2015</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://usman.it/free-responsive-admin-template">Sukalyan</a></p>
    </footer>

</div><!--/.fluid-container-->
<script type="text/javascript">
    function addPlan()
    {
        //console.log($('input[type=file]')[0].files[0]);
        //return false;
        var planlabel       =$('#label').val();
        var down_line       =$('#downline').val();
        var deluxenableornot=$('#deluxenableornot').val();
       // var image           =$('input[type=file]')[0].files[0];
        
        if(!planlabel)
        {
          $("#error_msg").html("Field needs filling");
          return false;
        }
        if(!down_line)
        {
          $("#error_msg2").html("Field needs filling");
          return false;
        }
        if(!deluxenableornot)
        {
          
        }
        data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('planlabel',planlabel);
        data.append('downline',down_line);
        data.append('deluxenableornot',deluxenableornot);
        /*$.ajax({
              url: 'ajax_page.php',
              data: {planlabel: planlabel,downline: down_line,deluxenableornot:deluxenableornot,carImg:image},
              error: function() {
               alert('<p>An error has occurred</p>');
              },
              dataType: 'json',
              success: function(data) {
               console.log(data);
               if(data=='true' || data==true || data==1)
               {
                $('#myModal').modal('hide');
                 window.location="vechile_list.php";
               }
               else
               {
                 alert("Plan not added");
               }
              },
              type: 'POST'
             });
             */
             $.ajax({
                    url: "ajax_page.php",
                    type: "POST",
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false   // tell jQuery not to set contentType
                  }).done(function(data) {
                                           if(data=='true' || data==true || data==1)
                                           {
                                            //$('#myModal').modal('hide');
                                             window.location="vechile_list.php";
                                           }
                                           else
                                           {
                                             alert("Data not added");
                                           }

                                        });
    }
    ///////////////////////////////////////tion 
    function openPopup()
    {
       modal.style.display = "block";
    }
    // Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>


</body>
</html>

