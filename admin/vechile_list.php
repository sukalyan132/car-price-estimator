<?php
include "header.php";
$user_data=$user->all_select_data_withoutquery('vehicle');
?>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        <!-- left menu starts -->
        <?php include "leftmenu.php";?>
        <!--/span-->
        <!-- left menu ends -->

        <!-- Modal -->
        

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a>Home</a>
            </li>
            <li>
                <a>Vehicle</a>
            </li>
        </ul>
        <a href="add_vachail_type.php" class="btn  btn-round btn-default">Add Vehicle</a>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2>All Vehicle Type List</h2>

        

    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>Vehicle Type</th>
                    <th>No Of Pax</th>
                    <th>Delux Available</th>
                    <th>Vehicle Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                while($row=mysql_fetch_array($user_data))
                {
            ?>
                <tr>
                    <td><?php echo $row['v_type'];?></td>
                    <td ><?php echo $row['no_of_pax'];?></td>
                    <td ><?php if($row['disable_for_delux']==0){ echo "YES";}else{echo "NA";};?></td>
                    <td ><img src="../img/<?php echo $row['img_url'];?>" width="200" height="75"></td>
                    <td class="center">
                        <a class="btn btn-info" href="edit_car_type.php?car_id=<?php echo $row['v_id'];?>">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            Edit
                        </a>
                    </td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    <!--/span-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

    
    <!-- Ad ends -->

    <hr>

     <!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Add Plan</h3>
                    </div>
                    <div class="modal-body">
                        
                          <form class="form-horizontal" id="form_val">
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="email">Label :</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="label" placeholder="Enter myModalLabel" required><span id="error_msg" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="pwd">Down Line:</label>
                              <div class="col-sm-10">          
                                <input type="text" class="form-control" id="downline" placeholder="Enter Down line" required><span id="error_msg2" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="email">Amount To Paid:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="paidamount" placeholder="Enter Paid Amount" required><span id="error_msg3" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="pwd">Return Amount:</label>
                              <div class="col-sm-10">          
                                <input type="text" class="form-control" id="returnamount" placeholder="Enter Return Amount" required><span id="error_msg4" style="color: red;"></span>
                              </div>
                            </div>
                          </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <a onclick="addPlan();" class="btn btn-primary">Save</a>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- The Modal -->
<div id="myModal" class="modal" >

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2><?php echo $admilMessageList['subject'];?></h2>
    </div>
    <div class="modal-body" onclick="gotoMessagesection();">
      <p><?php echo $admilMessageList['message'];?></p>
      
    </div>
    <div class="modal-footer">
      <h3></h3>
    </div>
  </div>

</div>

    </div><!--/.fluid-container-->
</div>
<!-- external javascript -->
<script type="text/javascript">
   
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
