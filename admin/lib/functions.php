<?php
/* db connection */
include_once("dbconfig.php");
date_default_timezone_set("Africa/lagos");
?>
<?php	
//error_reporting(0);
class functions 
{
		/* calling db construct */
	public function __construct()
	{
		$connect=new createConnection();	
	}	

	//////////////////////////////// //////////////////////
function sanitize($data)
{
// remove whitespaces (not a must though)
$data = trim($data);

// apply stripslashes if magic_quotes_gpc is enabled
if(get_magic_quotes_gpc())
{
$data = stripslashes($data);
}

// a mySQL connection is required before using this function
$data = mysql_real_escape_string($data);

return $data;
}
////////////// logincheck function //////////////////
	public function logincheckforuser($userid,$password)
	{
		
		$uid=functions::sanitize($userid);
		$pass=functions::sanitize($password);
		$pas=md5($pass);
		$query=mysql_query("SELECT * FROM admin WHERE user_name='$uid' AND user_password='$pas'");
		$result=mysql_num_rows($query);
		
		if($result>0)
		{
			$res=mysql_fetch_array($query);
			$response='true';
			
			$_SESSION['userid']=$res['admin_id'];
		//functions::user_log_function($log);
			$_SESSION['user_name']=$res['admin_name'];
			//$_SESSION['type']=$res['type'];
			$action="Login to admin panel";
			//$que=mysql_query("INSERT INTO user_log (a_id,user_id,act_time,action_type) VALUES ('','$res[IDPUSER]',NOW(),'$action')");
			//mail('nobody@example.com', 'the subject', 'the message', null,'-fwebmaster@example.com');  
		}
		else
		{
			$response='false';
			
		}
		return $response;		
	}
	
/**********************************************/
function accoutactivation($uid)
{
	$query=mysql_query("UPDATE user_table SET status='1' WHERE user_id='$uid'");
	if($query)
	{
		$result="true";
	}
	else
	{
		$result="false";
	}
	return $result;
}
/////////////////////// update car details ///////////////////
public function update_car_details($post,$imgUrl)
{
	$query=mysql_query("UPDATE vehicle SET v_type='".$post['cartypeedit']."',no_of_pax='".$post['downline']."',disable_for_delux='".$post['deluxenableornot']."',img_url='".$imgUrl."' WHERE v_id='".$post['carId']."'");
	return $query;
}
//////////////// session check ///////////////////////////
	public function session_Check()
	{
		$txt_admin_name=$_SESSION['userid'];
		if(empty($txt_admin_name))
		{
		echo "<script>window.location='index.php'</script>"; 
		exit();
		}
		else
		{
		}
		
	}
		//////////////// session check ///////////////////////////
	public function session_Check_admin()
	{
		$txt_admin_name=$_SESSION['userid'];
		if(empty($txt_admin_name))
		{
		echo "<script>window.location='index.php'</script>"; 
		exit();
		}
		else
		{
		}
		
	}
	public function usr_session_Check()
	{
		$txt_admin_name=$_SESSION['frontuserid'];
		if(empty($txt_admin_name))
		{
		echo "<script>window.location='index.php'</script>"; 
		exit();
		}
	}
	/********************************************** inser query for vhacail **********************/
	publiC function add_vachail_to_table($post,$fileName)
	{
		$query=mysql_query("INSERT INTO vehicle (v_type,no_of_pax,disable_for_delux,img_url) VALUES ('".$post['planlabel']."','".$post['downline']."','".$post['deluxenableornot']."','".$fileName."')");
		return $query;
	}
	/********************************************** inser query for trip type **********************/
	publiC function add_trip_type_to_table($post)
	{
		for($i=0;$i<count($post['data']);$i++)
		{
			$query=mysql_query("SELECT trip_type_id FROM trip_type WHERE trip_category='".$post['data'][$i][0]."' AND vechile_type='".$post['data'][$i][4]."'");
			
			$count= mysql_num_rows($query);
			if($count>0)
			{
				$row=mysql_fetch_array($query);
				$query2=mysql_query("UPDATE trip_type SET standard_price='".$post['data'][$i][1]."',limit_km='".$post['data'][$i][2]."',over_limit_charge_per_km='".$post['data'][$i][3]."' WHERE trip_type_id='".$row['trip_type_id']."'");
				//echo $query2;
				//exit();
			}
			else
			{
				$query2=mysql_query("INSERT INTO trip_type (trip_category,standard_price,limit_km,over_limit_charge_per_km,vechile_type) VALUES ('".$post['data'][$i][0]."','".$post['data'][$i][1]."','".$post['data'][$i][2]."','".$post['data'][$i][3]."','".$post['data'][$i][4]."')");
			}
		}
		//
		return $query2;
	}
	////////////////////////////// log out function ///////////////
	public function logoutfunction()
	{
		$action="Logout from admin panel";
		//$que=mysql_query("INSERT INTO user_log (a_id,user_id,act_time,action_type) VALUES ('','$_SESSION[userid]',NOW(),'$action')");
		unset($_SESSION['userid']);
		unset($_SESSION['user_name']);
	
	}
		////////////////////////////// log out function ///////////////
	public function logoutfunctionforadmin()
	{
	$query67=mysql_query("UPDATE user_table SET user_online='0' WHERE user_id='$_SESSION[userid]'");
/**********************************************************/
		$log="Logout from user panel";
		//$que=functions::user_log_function($log);
		//unset($_SESSION['username']);
		unset($_SESSION['userid']);
		unset($_SESSION['album_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_full_name']);
		unset($_SESSION['user_role']);
		echo "<script>window.location='../login.php'</script>"; 
		exit();
	}
	public function userlogoutfunction()
	{
		//unset($_SESSION['username']);
		unset($_SESSION['frontuserid']);
		session_destroy();
		echo "<script>window.location='index.php'</script>"; 
		exit();
	}
// //// get get driving distance ////////////
public function get_driving_information($start, $finish, $raw = false)
{
	if(strcmp($start, $finish) == 0)
	{
		$time = 0;
		if($raw)
		{
			$time .= ' seconds';
		}
 
		return array('distance' => 0, 'time' => $time);
	}
 
	$start  = urlencode($start);
	$finish = urlencode($finish);
 
	$distance   = 'unknown';
	$time		= 'unknown';
 
	$url = 'http://maps.googleapis.com/maps/api/directions/xml?origin='.$start.'&destination='.$finish.'&sensor=false';
	if($data = file_get_contents($url))
	{
		$xml = new SimpleXMLElement($data);
 
		if(isset($xml->route->leg->duration->value) AND (int)$xml->route->leg->duration->value > 0)
		{
			if($raw)
			{
				$distance = (string)$xml->route->leg->distance->text;
				$time	  = (string)$xml->route->leg->duration->text;
			}
			else
			{
				$distance = (int)$xml->route->leg->distance->value / 1000; 
				$time	  = (int)$xml->route->leg->duration->value;
			}
		}
		else
		{
			$distance='false';
		}
 
		return array('distance' => $distance, 'time' => $time);
	}
	else
	{
		throw new Exception('Could not resolve URL');
	}
}
// //////////////////// Insert trip data to db //////////////////
public function insert_trip_data_to_db($data,$t_id)
{
	$que=mysql_query("SELECT cust_id FROM customer_details WHERE cust_phone='".$data['phoneNo']."' AND cust_email='".$data['emailId']."'");
	$count=mysql_num_rows($que);
	if($count>0)
	{
		$row=mysql_fetch_array($que);
		$id=$row['cust_id'];
	}
	else
	{
		$query=mysql_query("INSERT INTO customer_details (cust_name,cust_email,cust_phone) VALUES ('".$data['customerName']."','".$data['emailId']."','".$data['phoneNo']."')");
		$id = mysql_insert_id();
	}
	
	//$tripdate=date('YYYY-mm-dd',$data['tripDate']);
	$query2=mysql_query("INSERT INTO trip_details (from_address,to_address,trip_date,trip_type,customer_id) VALUES ('".$data['pickup']."','".$data['dropoff']."','".(mysql_real_escape_string(date("Y-m-d", strtotime($data['tripDate'] ) ) ))."','".$t_id."','".$id."')");
	return $query2;
}
//////////////////////// select all query ///////////////////////
public function select_for_all($statement,$page,$limit,$startpoint)
{
	$query=mysql_query("SELECT * FROM  {$statement}  LIMIT {$startpoint},{$limit}");
	return $query;
}
/*********************************************************************/
public function select_trip_type_data_perticular($trip_category_id,$vachail_id)
{
	$query=mysql_fetch_array(mysql_query("SELECT * FROM trip_type WHERE trip_category='$trip_category_id' AND vechile_type='$vachail_id'"));
	return $query;
}
/**************************************************************/
public function check_password($pass)
{
	$query=mysql_query("SELECT * FROM puser where IDPUSER='$_SESSION[userid]' AND PPASSWORD='$pass'");
	return $query;
}

/////////////////password reset//////////////////////
public function reset_pass($password)
{
	$query=mysql_query("update user_master set password='$password' where user_id='$user_id'");	
	if($query)
		return true;
	else
		return false;
}

//////////////////////// select particular row  query ///////////////////////
public function select_for_prticular_row_all($table,$fild,$id)
{
	$query=mysql_query("SELECT * FROM ".$table." WHERE ".$fild."='$id' ");
	
	return $query;
	 
}
///////////////////////////////////////// update page content //////////////////
public function select_car_type_for_car_img($carId)
{
	$query=mysql_fetch_array(mysql_query("SELECT img_url FROM vehicle WHERE v_id='".$carId."'"));
	return $query;
}
/////////////////////////////////total amount//////////////////////////////////
public function calculate_total_amount()
{
	$query=mysql_query("SELECT SUM(paymentAmount) as amount FROM payment_table WHERE paymentStatus='1'");
	$row=mysql_fetch_array($query);
	return $row['amount'];
}
//////////////////////// All data orderby ///////////////////////
public function select_for_prticular_row_all_blog($table,$fild,$order)
{
	$query=mysql_query("SELECT * FROM ".$table." ORDER BY ".$fild." ".$order."");
	
	return $query;
	 
}	
/********************************************************/
public function select_for_prticular_row_all2($table,$fild,$id)
{
	$query=mysql_fetch_array(mysql_query("SELECT * FROM ".$table." WHERE ".$fild."='$id'"));
	
	return $query;
	 
}
/***************************************************************/
/********************************************************/
public function select_for_prticular_row_all24($table,$fild,$id)
{
	$query=mysql_num_rows(mysql_query("SELECT * FROM ".$table." WHERE ".$fild."='$id'"));
	
	return $query;
	 
}
/********************************************************/
public function select_for_prticular_row_all241($table)
{
	$query=mysql_num_rows(mysql_query("SELECT * FROM ".$table));
	
	return $query;
	 
}
//////////////////////// update  query ///////////////////////
public function update_common_for_all_table($table,$fild,$value,$id,$idvalue)
{
	$query=mysql_query("UPDATE ".$table." SET ".$fild." = '".$value."'  WHERE ".$id."='".$idvalue."'");
	//$que=functions::admin_log_function($log);
	if($query)
		return true;
	else
		return false;
	
}
//////////////////////////////////////// update admin profile //////////////////////////
public function update_admin_profile($post)
{
	$query=mysql_query("UPDATE admin_table SET user_name='".$post['user_name']."',phone='".$post['phone_no']."',email_id='".$post['email']."',bank_name='".$post['bank_name']."',account_name='".$post['bank_account_name']."',account_no='".$post['account_no']."' WHERE id='".$_SESSION['userid']."'");
}
/////////////////////////////////////////////////////////////////////////////////
//////////////////////// update  query ///////////////////////
public function update_common_for_all_table2($table,$fild,$value,$id,$idvalue)
{
	$query=mysql_query("UPDATE ".$table." SET ".$fild." = '".$value."'  WHERE ".$id."='".$idvalue."'");
	
	if($query)
		return true;
	else
		return false;
	
}
/************************************* update print date **********************/
public function update_printtable2($table,$id,$idvalue)
{
	$query=mysql_query("UPDATE ".$table." SET PRINTDATE=NOW()  WHERE ".$id."='".$idvalue."'");
	
	
}
/******************************************** select query with out condition *********************/
public function all_select_data_withoutquery($table)
{
	$query=mysql_query("SELECT * FROM ".$table."");
	return $query;
}
/************************************ select query without condition and send all data as array **/
public function all_select_data_withoutquery_return_array_forcar($table)
{
	$query 	=mysql_query("SELECT * FROM ".$table."");
	$query2 =mysql_query("SELECT * FROM vehicle_type");
	$query3 =mysql_query("SELECT * FROM trip_catagoty");
	$car_details=array();
	$vehicle_type=array();
	$trip_catagoty=array();
	while($row=mysql_fetch_array($query))
	{
		$dataArr=array('v_id' => $row['v_id'], 'v_name' => $row['v_type'],'on_of_pax' => $row['no_of_pax']);
		array_push($car_details,$dataArr);
	}
	while($row1=mysql_fetch_array($query2))
	{
		$dataArr2=array('v_t_id' => $row1['v_t_id'], 'v_t_name' => $row1['v_t_name']);
		array_push($vehicle_type,$dataArr2);
	}
	while($row2=mysql_fetch_array($query3))
	{
		$dataArr3=array('t_c_id' => $row2['t_c_id'], 't_c_name' => $row2['t_c_name']);
		array_push($trip_catagoty,$dataArr3);
	}
	$arr =array();
    $arr = array('car_details' => $car_details, 'trip_catagoty' => $trip_catagoty,'vehicle_type' => $vehicle_type);
	return $arr;
}
/******************************** common delete option *****************************************/
public function common_delete_fun($table,$fild,$fildval)
{
	$query=mysql_query("DELETE FROM ".$table." WHERE ".$fild."='".$fildval."'");
}
/********************************************** inser query for plan *****************************************/

/******************************************common update function **************************/
public function common_update_fun($table,$fild,$fildval,$confild,$confildval)
{
	$query=mysql_query("UPDATE ".$table." SET ".$fild."='".$fildval."' WHERE ".$confild." = '$confildval'");

}
/*******************************************common update function 2 condition **************************/
public function common_update_fun_with2_conn($table,$fild,$fildval,$confild,$confildval,$confild2,$confildva2)
{
	$query=mysql_query("UPDATE ".$table." SET ".$fild."='".$fildval."' WHERE ".$confild."='".$confildval."' AND ".$confild2."='".$confildva2."'");
	

}
/************************************************************************************************/
public  function pagination($query, $per_page = 10,$page = 1, $url = '?'){        
    	$query = "SELECT COUNT(*) as `num` FROM {$query}";
    	$row = mysql_fetch_array(mysql_query($query));
    	$total = $row['num'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
/*****************************************************************************************/
public function pagination_query($statement,$startpoint,$limit)
	{
		   $query = mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}");
		   return $query;
		   
	}
/***********************************surch function****************************************************/
/////////////////////////////// for send email section ////////////////////////////////////
 function send_mail($email,$subject,$message,$name)
 {      
  require("PHPMailer-master/PHPMailerAutoload.php");
  $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->IsHTML(true); 
   $mail->SMTPDebug  = 0; 
   $mail->SMTPAuth   = true;
   $mail->Mailer     = "pop3";
   $mail->Host       = "mail.apxwealth.com";
   $mail->Port       = "587"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
   $mail->SMTPAuth   = true;
   $mail->SMTPSecure = 'ssl';
   $mail->Username   = "support@apxwealth.com";
   $mail->Password   = "support1243";
    
   $mail->From       = "support@apxwealth.com";
   $mail->FromName   = "Apex Wealth";
   $mail->AddAddress($email, $name);
   $mail->AddReplyTo("support@apxwealth.com", "Apex Wealth");
  // $mail->$headers = "MIME-Version: 1.0" . "\r\n";
   //$mail->$headers = "Content-type:text/html;charset=UTF-8";
   $mail->Subject    = $subject;
   $mail->Body       = $message;
   $mail->WordWrap   = 50;  

 
   if(!$mail->Send()) {
            //echo 'Message was not sent.';
            //echo 'Mailer error: ' . $mail->ErrorInfo;
           // exit;
   } else {
            //echo 'Message has been sent.';
   }
 }
}

