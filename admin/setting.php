<?php 
include "header.php";
//$data=$user->all_select_data_withoutquery('users');
$admn_details=$user->select_for_prticular_row_all2('admin_table','id',$_GET['id']);
$admn_setting_details=$user->select_for_prticular_row_all2('subadmin_setting','subadmin_id',$_GET['id']);
///////////////////////////////////////////////////////////////
if(isset($_POST['submit']))
{
    //print_r($_POST);
    //exit();
    if(isset($_POST['user_management']))
    {
        if($_POST['user_management']=='on')
        {
            $update=$user->update_common_for_all_table('subadmin_setting','user_list','1','subadmin_id',$_GET['id']);
        }
        
    }
    else
    {
        $update=$user->update_common_for_all_table('subadmin_setting','user_list','0','subadmin_id',$_GET['id']);
    }
    if(isset($_POST['payment_management']))
    {
        if($_POST['payment_management']=='on')
        {
        $update=$user->update_common_for_all_table('subadmin_setting','payment_approve','1','subadmin_id',$_GET['id']);
        }
        
    }
    else
    {
        $update=$user->update_common_for_all_table('subadmin_setting','payment_approve','0','subadmin_id',$_GET['id']);
    }
    if(isset($_POST['plan_management']))
    {
        if($_POST['plan_management']=='on')
        {
            $update=$user->update_common_for_all_table('subadmin_setting','plan_details','1','subadmin_id',$_GET['id']);
        }
        
    }
    else
    {
        $update=$user->update_common_for_all_table('subadmin_setting','plan_details','0','subadmin_id',$_GET['id']);
    }
    if(isset($_POST['content_management']))
    {
        if($_POST['content_management']=='on')
        {
            $update=$user->update_common_for_all_table('subadmin_setting','edit_content','1','subadmin_id',$_GET['id']);
        }
        
    }
    else
    {
        $update=$user->update_common_for_all_table('subadmin_setting','edit_content','0','subadmin_id',$_GET['id']);
    }
    if(isset($_POST['subadmin_management']))
    {
        if($_POST['subadmin_management']=='on')
        {
            $update=$user->update_common_for_all_table('subadmin_setting','setting','1','subadmin_id',$_GET['id']);
        }
        
    }
    else
    {
        $update=$user->update_common_for_all_table('subadmin_setting','setting','0','subadmin_id',$_GET['id']);
    }
    if(isset($_POST['user_label_management']))
    {
        if($_POST['user_label_management']=='on')
        {
            $update=$user->update_common_for_all_table('subadmin_setting','update_user_label','1','subadmin_id',$_GET['id']);
        }
        
    }
    else
    {
        $update=$user->update_common_for_all_table('subadmin_setting','update_user_label','0','subadmin_id',$_GET['id']);
    }
    ?>
        <script type="text/javascript">
        alert("Updated successfully.");
        window.location="setting.php?id=<?php echo $_GET['id'];?>";
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
                <h2><i class="glyphicon glyphicon-edit"></i>Subadmin Role Management</h2>

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
                        <input type="text" name="user_name" value="<?php echo $admn_details['user_name'];?>" class="form-control" placeholder="User Name" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="user_management" <?php if($admn_setting_details['user_list']=='1'){ echo "checked";}else{echo "unchecked";}?> data-toggle="toggle">
                            User Management
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"  name="payment_management" <?php if($admn_setting_details['payment_approve']=='1'){ echo "checked";}else{echo "unchecked";}?> data-toggle="toggle">
                            Payment Management
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"  name="plan_management" <?php if($admn_setting_details['plan_details']=='1'){ echo "checked";}else{echo "unchecked";}?> data-toggle="toggle">
                            Plan Management
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="content_management" <?php if($admn_setting_details['edit_content']=='1'){ echo "checked";}else{echo "unchecked";}?> data-toggle="toggle">
                            Content Management
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="subadmin_management" <?php if($admn_setting_details['setting']=='1'){ echo "checked";}else{echo "unchecked";}?> data-toggle="toggle">
                            Subadmin Management
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="user_label_management" <?php if($admn_setting_details['update_user_label']=='1'){ echo "checked";}else{echo "unchecked";}?> data-toggle="toggle">
                            User Label Management
                          </label>
                        </div>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-default">Update</button>
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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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

