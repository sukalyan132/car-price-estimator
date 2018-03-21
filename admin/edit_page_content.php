<?php 
include "header.php";
$data=$user->all_select_data_withoutquery('users');
$messages=$user->all_select_data_withoutquery('page_content');
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
            <a href="#">Pages</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i>All Pages</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>Page Id</th>
                    <th>Page Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
                while($row=mysql_fetch_array($messages))
                {
                    
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td ><?php echo $row['page_name'];?></td>
                    <td class="center">
                        <?php
                        if($row['status']=='1')
                        {
                            ?>
                            <span class="label-success label label-default">Active</span>
                            <?php
                        }
                         
                         if($row['status']=='0')
                        {
                            ?>
                            <span class="label-success label label-warning">Deactive</span>
                            <?php
                        }
                        ?>
                        
                    </td>
                    <td class="center">
                    
                        <a class="btn btn-success" href="edit_page.php?id=<?php echo $row['page_id'];?>">
                            <i class="glyphicon glyphicon-ok icon-white"></i>
                            Edit
                        </a>
                        
                    </td>
                </tr>
                <tr id="extra_<?php echo $i;?>" style="display: none;">
                    <td colspan="7">
                        <div  >
                        <?php echo $row['page_content'];?>
                        </div>
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
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
    
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
<script>
$(document).ready(
  function() {
  $("a[id^=show_]").click(function(event) {
    $("#extra_" + $(this).attr('id').substr(5)).slideToggle("slow");
    event.preventDefault();
});
  }
  );
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
