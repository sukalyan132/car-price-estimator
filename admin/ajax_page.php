<?php
include "lib/functions.php";
$user= new functions();
header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
	header("Access-Control-Max-Age: 18000");
////////////////////////////////////////////////////////////////////
if(isset($_POST['planlabel']))
{
	//print_r($_FILES);
	$data=$user->add_vachail_to_table($_POST,$_FILES['file']['name']);
	move_uploaded_file( $_FILES["file"]["tmp_name"], "../img/" . $_FILES['file']['name']);
	echo $data;	
}

////////////////////////////////////////////////////////////////////
if(isset($_POST['data']))
{
	//data 
	//$data=file_get_contents('php://input');
	//$input= json_decode( $data, TRUE ); //convert JSON into array
	$data=$user->add_trip_type_to_table($_POST);
	echo json_encode($data);	
}
/////////////////////////////////////////////////////////////////////////
if(isset($_POST['userId']))
{
	if($_POST['userLabel']=='Y')
	{
		$status='N';
	}
	if($_POST['userLabel']=='N')
	{
		$status='Y';
	}
	$data=$user->update_common_for_all_table('users','userStatus',$status,'name',$_POST['userId']);
	echo json_encode($data);
}
//////////////////////////////////////////////////////////////////////
if(isset($_POST['tid']))
{
	$data=$user->accept_payment($_POST);
	echo json_encode($data);
}
////////////////////////////////////////////////////////////////////////
if(isset($_POST['trenjuctionid']))
{
	$data=$user->reject_payment($_POST);
	echo json_encode($data);
}
////////////////////////////////////////////////////////////////////////
if(isset($_POST['label']))
{
	$data2=array();
	$data=$user->select_for_prticular_row_all('users','user_label',$_POST['label']);
	while($row=mysql_fetch_array($data))
	{
		array_push($data2,$row);
	}
	echo json_encode($data2);
}
////////////////////////////////////////////////////////////////////////
if(isset($_POST['updateLabel']))
{
	//$data2=array();
	$data=$user->update_user_label_manually($_POST);
	
	echo json_encode($data);
}
////////////////////////////////////////////////////////////////////////
if(isset($_POST['cartypeedit']))
{
	//$data2=array();
	if(!$_FILES['file']['name'])
	{
		$data=$user->update_car_details($_POST,$_POST['oldImageName']);
		//move_uploaded_file( $_FILES["file"]["tmp_name"], "../img/" . $_FILES['file']['name']);
	}
	else
	{
		$data=$user->update_car_details($_POST,$_FILES['file']['name']);
		unlink('../img/'.$_POST['oldImageName']);
		move_uploaded_file( $_FILES["file"]["tmp_name"], "../img/" . $_FILES['file']['name']);
	}
	
	echo $data;
}
?>