<?php
include "header.php";
$user_data=$user->all_select_data_withoutquery('trip_booking_details');
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
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Booking List</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i>All Users List</h2>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Trip Date</th>
                                <th>Booking Date/Time</th>
                                <th>Car Type</th>
                                <th>Hire Type</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            while($row=mysql_fetch_array($user_data))
                            {
                        ?>
                            <tr>
                                <td><?php echo $row['cust_name'];?></td>
                                <td ><?php echo $row['cust_email'];?></td>
                                <td><?php echo $row['cust_phone'];?></td>
                                <td><?php echo $row['from_address'];?></td>
                                <td><?php echo $row['to_address'];?></td>
                                <td><?php echo $row['trip_date'];?></td>
                                <td><?php echo $row['booking_date'];?></td>
                                <td><?php echo $row['v_type'];?></td>
                                <td><?php echo $row['t_c_name'];?></td>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Settings</h3>
                    </div>
                    <div class="modal-body">
                        <p>Here settings can be configured...</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                    </div>
                </div>
            </div>
        </div>


    </div><!--/.fluid-container-->
</div>
<!-- external javascript -->
<script type="text/javascript">
    function editUser(val)
    {
        console.log(val);
        $('#myModal').modal('show');
    }
    ///////////////////////////////////////
    function active_deactive_user(val,label)
    {

        $.ajax({
              url: 'ajax_page.php',
              data: {userId : val,userLabel:label},
              error: function() {
               alert('<p>An error has occurred</p>');
              },
              dataType: 'json',
              success: function(data) {
               console.log(data);
               if(data=='true' || data==true || data==1)
               {
                //$('#myModal').modal('hide');
                 window.location="user_list.php";
               }
               else
               {
                 alert("User status not change");
               }
              },
              type: 'POST'
             });
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
