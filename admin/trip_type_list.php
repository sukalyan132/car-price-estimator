<?php
include "header.php";
$car_data=$user->all_select_data_withoutquery('vehicle');

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
                <a>Trip</a>
            </li>
        </ul>
        <a href="add_trip_type.php" class="btn  btn-round btn-default">Add Trip Type</a>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2>All Trip Type List</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered responsive">
        
          <?php
          $i=0;
          while ($row=mysql_fetch_array($car_data)) {
            $array_data=array();
          ?>
        
          <tr>
            <th>
              <b style="color: blue"><?php echo $row['v_type']; ?>(<?php echo $row['no_of_pax'];?>)</b>

            </th>
            <td>
                <form id="Myform<?php echo $i;?>" autocomplete="off">
                <table class="table table-striped table-bordered  responsive">
                  <thead>
                      <tr>
                          <th>Trip Type Name</th>
                          <th>Description</th>
                          <th>Economy Price</th>
                          <th>Standard Price</th>
                          <th>Delux Price</th>
                          <th>Limit (KM)</th>
                          <th>Over Limit Charge Per KM</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php 
                    //$array_data['v_id']     = $row['v_id'];
                    $j=0;
                    $category_data=$user->all_select_data_withoutquery('trip_catagoty');
                    ?>
                    
                    <?php
                    while($row1=mysql_fetch_array($category_data))
                    {
                      $trip_typedata  =$user->select_trip_type_data_perticular($row1['t_c_id'],$row['v_id']);
                      $array_data[]=array('t_c_id'=>$row1['t_c_id'],'standard_price'=>$trip_typedata['standard_price'],'limit_km'=>$trip_typedata['limit_km'],'over_limit_charge_per_km'=>$trip_typedata['over_limit_charge_per_km']);
                    ?>
                    <input type="hidden" id="t_c_id<?php echo $i;?><?php echo $j;?>" value="<?php echo $row1['t_c_id'];?>">
                    <tr>
                      <td><?php echo $row1['t_c_name'];?></td>
                      <td ><?php echo $row1['t_c_description'];?></td>
                      <td id="echonomy_price<?php echo $i;?><?php echo $j;?>"></td>
                      <td >
                        <input type="text" class="form-control" id="standard_price<?php echo $i;?><?php echo $j;?>"  value="<?php echo $trip_typedata['standard_price'];?>" ></td>
                        <?php
                          if($row['disable_for_delux']=='0')
                          {
                            ?>
                            <td  id="delux_price<?php echo $i;?><?php echo $j;?>"></td>
                            <?php
                          }
                          else
                          {
                            ?>
                            <td>NA</td>
                           <?php
                          }
                          ?>
                        
                      <td >
                        <input type="text" class="form-control"  id="limit_km<?php echo $i;?><?php echo $j;?>" value="<?php echo $trip_typedata['limit_km'];?>">
                      </td>
                      <td >
                        <input type="text" class="form-control" id="over_limit_charge_per_km<?php echo $i;?><?php echo $j;?>"  value="<?php echo $trip_typedata['over_limit_charge_per_km'];?>">
                      </td>
                    </tr>
                    <script type="text/javascript">
                    $( document ).ready(function() {
                           $('#echonomy_price<?php echo $i;?><?php echo $j;?>').html( "<?php echo $trip_typedata['standard_price']-(($trip_typedata['standard_price']/100)*10);?>" );
                           $('#delux_price<?php echo $i;?><?php echo $j;?>').html( "<?php echo (($trip_typedata['standard_price']/100)*10)+$trip_typedata['standard_price'];?>");
                           $('#standard_price<?php echo $i;?><?php echo $j;?>').keyup(function() {
                              var standard_price=parseFloat($("#standard_price<?php echo $i;?><?php echo $j;?>").val());
                              var delux_price   = parseFloat(standard_price)+parseFloat((parseFloat(standard_price)/100)*10);
                              var echonomy_price= parseFloat(standard_price)-parseFloat((parseFloat(standard_price)/100)*10);
                              //console.log(echonomy_price);
                              $('#echonomy_price<?php echo $i;?><?php echo $j;?>').html(echonomy_price);
                              $('#delux_price<?php echo $i;?><?php echo $j;?>').html(delux_price);
                            });
                      });
                    </script>
                    <?php
                        $j++;
                      }
                      $arr =array();
                      $arr = array('v_id' => $row['v_id'], 'data' => $array_data);
                    ?>
                    
                  </tbody>

              </td>
            </tr>
            </table>
            </form>
            <div class="clearfix"></div>
              
              <div class="row">
              <div class="form-group">
                  <a onclick="addTripeType<?php echo $i;?>(<?php echo htmlspecialchars(json_encode($arr)) ; ?>)" class="btn btn-primary"  id="buttonmini<?php echo $i;?>" style="margin-left: 30px !important;background-color: green !important;display: none !important">Save</a>
                  <a class="btn btn-primary"  id="buttonminibutton<?php echo $i;?>" style="margin-left: 30px !important;background-color: gray !important;">Save</a>

                </div>
                </div>
                
                <script type="text/javascript">
                    // for button enable disable
                      $('#Myform<?php echo $i;?> :input').change(function(){
                         //alert("Form changed <?php echo $i;?>");
                         $('#buttonmini<?php echo $i;?>').show();
                         $('#buttonminibutton<?php echo $i;?>').hide();
                         //$(this).attr("disabled", "disabled");
                      });
                      // trip type edit function
                  function addTripeType<?php echo $i;?>(data)
                  {
                    var v_id = <?php echo $row['v_id'];?>;
                    //var data = {'standard_price':'','limit_km':'','over_limit_charge_per_km':'','v_id':<?php echo $row['v_id'];?>,'t_c_id':''};
                    var sendArray = [];
                    var data      = [];
                    var flag      =1;
                    //console.log($('input','#Myform<?php echo $i;?>'));
                    var formData= $('input','#Myform<?php echo $i;?>');
                    var k       = 0;
                    $.each(formData, function( index, value ) {
                      //console.log( index + ": " + value.value );
                      var flag      =1;
                      if(k==3)
                      {
                        data.push(value.value);
                        data.push(<?php echo $row['v_id'];?>);
                        sendArray.push(data);
                        data=[];
                        k=0;
                        flag=0;
                        //console.log('here');
                      }
                      if(k==2)
                      {
                        data.push(value.value);
                        k++;
                      
                      }
                      if(k==1)
                      {
                        data.push(value.value);
                        k++
                        
                      }
                      if(flag==1)
                      {
                        if(k==0)
                        {
                          //console.log('here');
                          data.push(value.value);
                          k++;
                          
                          
                          //console.log(k);
                        }
                      }
                      

                       
                    });
                    //console.log(sendArray);
                    $.ajax({
                            url: 'ajax_page.php',
                            data: {'data':sendArray,'case':'enterTripType'},
                            error: function() {
                                               alert('An error has occurred');
                                              },
                            dataType: 'json',
                            success: function(data) {
                                                       console.log(data);
                                                       if(data=='true' || data==true || data==1)
                                                       {
                                                        //$('#myModal').modal('hide');
                                                         window.location="trip_type_list.php";
                                                       }
                                                       else
                                                       {
                                                         alert("Trip type not added");
                                                       }
                                                    },
                            type: 'POST'
                           });
                  }
                </script>
          <?php $i++; }?>
          
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

    function addTripeType(data)
    {

      //var data2=$("form1").serialize();
 console.log($('input','#form1'));

      return false;
      
        $.ajax({
              url: 'ajax_page.php',
              data: {'data':data},
              error: function() {
               alert('An error has occurred');
              },
              dataType: 'json',
              success: function(data) {
               console.log(data);
               if(data=='true' || data==true || data==1)
               {
                //$('#myModal').modal('hide');
                 //window.location="plan_list.php";
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
