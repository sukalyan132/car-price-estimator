<?php
include "header.php";
$user_data=$user->all_select_data_withoutquery('users');
$payment_list=$user->payment_list_for_admin();
?>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <?php include "leftmenu.php";?>
        <!--/span-->
        <!-- left menu ends -->

        <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Tables</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i>All Payment List</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Pay By</th>
                    <th>Phone No</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Payment Proof</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
                while($row=mysql_fetch_array($payment_list))
                {
                    $user_detail=$user->select_for_prticular_row_all2('users','name',$row['paymentBy']);
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td ><?php echo $user_detail['full_name'];?></td>
                    <td><?php echo $user_detail['phone'];?></td>
                    <td align="right"><strike>N</strike><?php echo $row['paymentAmount'];?></td>
                    <td><?php echo $row['paymentDescription'];?></td>
                    <td><img src="../payment_doc/<?php echo $row['paymentProve'];?>" width="200" hight="100" ></td>
                    <td class="center">
                        <?php
                        if($row['paymentStatus']=='1')
                        {
                            ?>
                            <span class="label-success label label-default">Approve</span>
                            <?php
                        }
                         if($row['paymentStatus']=='2')
                        {
                            ?>
                            <span class="label-success label label-danger">Rejected</span>
                            <?php
                        }
                         if($row['paymentStatus']=='0')
                        {
                            ?>
                            <span class="label-success label label-warning">Pending</span>
                            <?php
                        }
                        ?>
                        
                    </td>
                    <td class="center">
                    <?php
                        if($row['paymentStatus']=='0')
                        {
                            ?>
                        <a class="btn btn-success" onclick="approve_payment(<?php echo $row['payementId'];?>,<?php echo $row['paymentBy']?>);">
                            <i class="glyphicon glyphicon-ok icon-white"></i>
                            Approve
                        </a>
                        
                        
                            <a class="btn btn-danger" onclick="reject_payment(<?php echo $row['payementId'];?>,<?php echo $row['paymentBy'];?>);">
                            <i class="glyphicon glyphicon-off"></i>
                            Reject
                            </a>
                            <?php
                        }
                       
                        ?>
                    </td>
                </tr>
            <?php
            $i++;
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
    function approve_payment(id,userid)
    {
        var r = confirm("Are you sure ?");
            if (r == true) 
            {
               $.ajax({
                          url: 'ajax_page.php',
                          data: {tid : id, user:userid},
                          error: function() {
                           alert('<p>An error has occurred</p>');
                          },
                          dataType: 'json',
                          success: function(data) {
                           console.log(data);
                           if(data=='true' || data==true || data==1)
                           {
                            //$('#myModal').modal('hide');
                             window.location="admin_payment.php";
                           }
                           else
                           {
                             alert("Plan not added");
                           }
                          },
                          type: 'POST'
                       });
            } 
            else 
            {
                
            }
    }
	/////////////////////////////////////////////////
	 function reject_payment(id,userid)
    {
        var r = confirm("Are you sure ?");
            if (r == true) 
            {
               $.ajax({
                          url: 'ajax_page.php',
                          data: {trenjuctionid : id, user:userid},
                          error: function() {
                           alert('<p>An error has occurred</p>');
                          },
                          dataType: 'json',
                          success: function(data) {
                           console.log(data);
                           if(data=='true' || data==true || data==1)
                           {
                            //$('#myModal').modal('hide');
                             window.location="admin_payment.php";
                           }
                           else
                           {
                             alert("Plan not added");
                           }
                          },
                          type: 'POST'
                       });
            } 
            else 
            {
                
            }
    }
    ///////////////////////////////////////
    function deactive_user(val)
    {

        $.ajax({
              url: 'ajax_page.php',
              data: {userId : val},
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
                 alert("Plan not added");
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
