<?php 
include "header.php";
//$data=$user->all_select_data_withoutquery('users');
$admn_details=$user->select_for_prticular_row_all2('admin_table','id',$_SESSION['userid']);
///////////////////////////////////////////////////////////////
if(isset($_POST['submit']))
{
	$mess=$user->update_admin_profile($_POST);
	//exit();
    ?>
    <script type="text/javascript">
        alert("Update successfully.");
        window.location="edit_profile.php";
    </script>
    <?php
}
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
                <h2><i class="glyphicon glyphicon-edit"></i>Edit Profile</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content">
                <form  action="" method="POST">
                    <div class="form-group">
                        <label >User Name</label>
                        <input type="text" name="user_name" value="<?php echo $admn_details['user_name'];?>" class="form-control" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <label >Email</label>
                        <input type="email" name="email" value="<?php echo $admn_details['email_id'];?>" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label >Phone</label>
                        <input type="text" name="phone_no" value="<?php echo $admn_details['phone'];?>" class="form-control" placeholder="Phone No" required>
                    </div>
                    <div class="form-group">
                        <label >Bank Name</label>
                        <input type="text" name="bank_name" value="<?php echo $admn_details['bank_name'];?>" class="form-control" placeholder="Bank Name" required>
                    </div>
                    <div class="form-group">
                        <label >Bank Account Name</label>
                        <input type="text" name="bank_account_name" value="<?php echo $admn_details['account_name'];?>" class="form-control" placeholder="Account Holder Name" required>
                    </div>
                    <div class="form-group">
                        <label >Bank Account No</label>
                        <input type="text" name="account_no" value="<?php echo $admn_details['account_no'];?>" class="form-control" placeholder="Account No" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
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

