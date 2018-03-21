<?php 
include "header.php";
include "ckeditor/ckeditor/ckeditor.php";
include "ckeditor/ckfinder/ckfinder.php";
//$data=$user->all_select_data_withoutquery('users');
$page_details=$user->select_for_prticular_row_all2('page_content','page_id',$_GET['id']);
///////////////////////////////////////////////////////////////
if(isset($_POST['submit']))
{
	$mess=$user->update_page_content($_POST);
	//exit();
    ?>
    <script type="text/javascript">
        alert("Update successfully.");
        window.location="edit_page.php?id=<?php echo $_GET['id'];?>";
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
                <h2><i class="glyphicon glyphicon-edit"></i>Edit Pge</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content">
                <form  action="" method="POST">
                	<input type="hidden" name="page_id" value="<?php echo $_GET['id'];?>">
                    <div class="form-group">
                        <label >Page Name</label>
                        <input type="text" name="page_name" value="<?php echo $page_details['page_name'];?>" class="form-control" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <label >Page Content</label>
                        <?php
  
							$CKeditor = new CKeditor();
							$CKeditor->BasePath = 'ckeditor/';
							$CKeditor->config['filebrowserBrowseUrl'] = 'ckfinder/ckfinder.html';
							$CKeditor->config['filebrowserImageBrowseUrl'] = 'ckfinder/ckfinder.html?type=Images';
							$CKeditor->config['filebrowserFlashBrowseUrl'] = 'ckfinder/ckfinder.html?type=Flash';
							$CKeditor->config['filebrowserUploadUrl'] = 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
							$CKeditor->config['filebrowserImageUploadUrl'] = 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
							$CKeditor->config['filebrowserFlashUploadUrl'] = 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
							$CKeditor->editor('page_content',$page_details['page_content']);


							?>
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