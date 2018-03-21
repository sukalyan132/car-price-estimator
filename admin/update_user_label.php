<?php 
include "header.php";
//$data=$user->all_select_data_withoutquery('users');
$admn_details=$user->select_for_prticular_row_all2('admin_table','id',$_SESSION['userid']);
$data=$user->all_select_data_withoutquery('users');
///////////////////////////////////////////////////////////////
$plan_data=$user->all_select_data_withoutquery('manage_plan');
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
                <h2><i class="glyphicon glyphicon-edit"></i>Upgrade User Label</h2>

               
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="form_val">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Select User</label>
                      <div class="col-sm-10">
                        <select name="user_id" id="user_id"  class="form-control" data-rel="chosen">
                            <?php 
                            while($row=mysql_fetch_array($data))
                            {
                                ?>
                                <option value="<?php echo $row['name'];?>"><?php echo $row['full_name'];?> (Label <?php echo $row['user_label'];?>) </option>
                                <?php
                            }
                            ?>
                            
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Update Label</label>
                      <div class="col-sm-10">          
                        <select name="plan_id" id="plan_id" onchange="select_all_parent()"  class="form-control" data-rel="chosen">
                          <option value="0">Label 0</option>
                            <?php 
                            while($row=mysql_fetch_array($plan_data))
                            {
                                ?>
                                <option value="<?php echo $row['plan_id'];?>">Label <?php echo $row['label'];?></option>
                                <?php
                            }
                            ?>
                            
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Select Parent</label>
                      <div class="col-sm-10">
                        <select name="parent_id" id="parent_id"   class="form-control" >
                            
                            
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Take charge From User</label>
                      <div class="col-sm-10">
                        <select name="take_charge" id="take_charge"   class="form-control" >
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-10"> 
                        <a onclick="update_user_label();" class="btn btn-primary">Save</a>
                      </div>
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
  function select_all_parent()
  {
    var label=$("#plan_id").val();
    var dat_select='';
    $.ajax({
              url: 'ajax_page.php',
              data: {label: label},
              error: function() {
               alert('<p>An error has occurred</p>');
              },
              dataType: 'json',
              success: function(data) {
               console.log(data.length);
               if(data.length>0)
               {
                  dat_select +='<option value="0">Admin</option>';
                  $.each(data, function( index, value ) {
                    dat_select +='<option value="'+value.name+'">'+value.full_name+'(No of leg '+value.no_of_link+')</option>';
                  });
                  $("#parent_id").html(dat_select);
               }
               else
               {
                  dat_select +='<option value="0">Admin</option>';
                  $("#parent_id").html(dat_select);
               }
              },
              type: 'POST'
          });

  }
  /***********************************************/
    function update_user_label()
    {
        //console.log();
        var userid          =$('#user_id').val();
        var plan_id         =$('#plan_id').val();
        var parent_id       =$('#parent_id').val();
        var take_charge     =$('#take_charge').val();
        
        if(!userid)
        {
          alert("Select a user");
          return false;
        }
        if(!plan_id)
        {
          alert("Select a label");
          return false;
        }
        if(!parent_id)
        {
          alert("Select a parent");
          return false;
        }
        $.ajax({
              url: 'ajax_page.php',
              data: {userid: userid,plan_id: plan_id,parent_id: parent_id,take_charge:take_charge,updateLabel: 'true'},
              error: function() {
               alert('<p>An error has occurred</p>');
              },
              dataType: 'json',
              success: function(data) {
               console.log(data);
               
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

