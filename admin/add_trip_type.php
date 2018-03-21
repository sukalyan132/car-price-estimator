<?php 
include "header.php";
$data=$user->all_select_data_withoutquery('vehicle');
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
            <a href="#">Trip Type</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Add Trip Type</h2>
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="form_val">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Trip Type Name </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="tripTypeName" placeholder="Trip Type Name" required><span id="error_msg3" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Description</label>
                      <div class="col-sm-10">          
                        <input type="text" class="form-control" id="description" placeholder="Description" required><span id="error_msg4" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Vehicle</label>
                      <div class="col-sm-10">          
                        <select  id="vehicle"  class="form-control" data-rel="chosen">
                            <?php 
                            while($row=mysql_fetch_array($data))
                            {
                                ?>
                                <option value="<?php echo $row['v_id'];?>"><?php echo $row['v_type'];?> (No of pax <?php echo $row['no_of_pax'];?>) </option>
                                <?php
                            }
                            ?>
                            
                        </select>
                        <span id="error_msg8" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Economy Price </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="economyPrice" placeholder="Economy Price" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Standard Price</label>
                      <div class="col-sm-10">          
                        <input type="text" class="form-control" id="standardPrice" placeholder="Standard Price" required><span id="error_msg5" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Delux Price</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="deluxPrice" placeholder="Delux Price" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Limit (KM)</label>
                      <div class="col-sm-10">          
                        <input type="text" class="form-control" id="limit" placeholder="Limit (KM)" required><span id="error_msg6" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Over Limit Charge Per KM</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="overLimitCharge" placeholder="Over Limit Charge Per KM" required><span id="error_msg7" style="color: red;"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <a onclick="addTripeType();" class="btn btn-primary" style="margin-left: 30px !important">Save</a>
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
    function addTripeType()
    {
        //console.log();
        var tripTypeName        =$('#tripTypeName').val();
        var description         =$('#description').val();
        var standardPrice       =$('#standardPrice').val();
        var limit               =$('#limit').val();
        var overLimitCharge     =$('#overLimitCharge').val();
        var vehicle             =$('#vehicle').val();
        
        if(!tripTypeName)
        {
          $("#error_msg3").html("Please enter trip type name");
          return false;
        }
        if(!description)
        {
          $("#error_msg4").html("Please enter description");
          return false;
        }
        if(!standardPrice)
        {
          $("#error_msg5").html("Please enter standard price");
          return false;
        }
        if(!limit)
        {
          $("#error_msg6").html("Please enter limit");
          return false;
        }
        if(!overLimitCharge)
        {
          $("#error_msg7").html("Please extra charge");
          return false;
        }
        if(!vehicle)
        {
          $("#error_msg8").html("Please select a car type");
          return false;
        }
        $.ajax({
              url: 'ajax_page.php',
              data: {tripTypeName : tripTypeName,description : description,standardPrice : standardPrice,limit : limit,overLimitCharge : overLimitCharge,vehicle : vehicle},
              error: function() {
               alert('<p>An error has occurred</p>');
              },
              dataType: 'json',
              success: function(data) {
               console.log(data);
               if(data=='true' || data==true || data==1)
               {
                $('#myModal').modal('hide');
                 window.location="trip_type_list.php";
               }
               else
               {
                 alert("Plan not added");
               }
              },
              type: 'POST'
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

