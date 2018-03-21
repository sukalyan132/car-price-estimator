<?php 
include "header.php";
$data=$user->all_select_data_withoutquery('users');
$messages=$user->select_for_prticular_row_all('userMessage','messageTo','admin');
///////////////////////////////////////////////////////////////
if(isset($_POST['submit']))
{
	$mess=$user->send_message_to_user($_POST);
	//exit();
    ?>
    <script type="text/javascript">
        alert("Message successfully send.");
        window.location="send_message.php";
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
                <h2><i class="glyphicon glyphicon-edit"></i> Form Elements</h2>

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
                        <label >Select User </label>
                        <select name="user_id"   class="form-control" data-rel="chosen">
                            <?php 
                            while($row=mysql_fetch_array($data))
                            {
                                ?>
                                <option value="<?php echo $row['name'];?>"><?php echo $row['full_name'];?></option>
                                <?php
                            }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label >Message Body</label>
                        <input type="text" name="message" class="form-control" placeholder="Message" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i>All Message From Users</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User Name</th>
                    <th>Phone No</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
                while($row=mysql_fetch_array($messages))
                {
                    $user_detail=$user->select_for_prticular_row_all2('users','name',$row['userId']);
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td ><?php echo $user_detail['full_name'];?></td>
                    <td><?php echo $user_detail['phone'];?></td>
                    <td><?php echo $row['subject'];?></td>
                    <td><a href="#" id="show_<?php echo $i;?>">Show Message</a></td>
                    <td class="center">
                        <?php
                        if($row['status']=='1')
                        {
                            ?>
                            <span class="label-success label label-default">Read</span>
                            <?php
                        }
                         
                         if($row['status']=='0')
                        {
                            ?>
                            <span class="label-success label label-warning">Unread</span>
                            <?php
                        }
                        ?>
                        
                    </td>
                    <td class="center">
                    <?php
                        if($row['status']=='0')
                        {
                            ?>
                        <a class="btn btn-success" onclick="message_as_read(<?php echo $row['payementId'];?>,<?php echo $row['paymentBy']?>);">
                            <i class="glyphicon glyphicon-ok icon-white"></i>
                            Read
                        </a>
                        <?php
                        }
                        else
                        {
                         ?>
                        
                            
                            <?php
                        }
                       
                        ?>
                    </td>
                </tr>
                <tr id="extra_<?php echo $i;?>" style="display: none;">
                    <td colspan="7">
                        <div  >
                        <?php echo $row['message'];?>
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

