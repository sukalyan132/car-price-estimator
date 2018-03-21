<?php
include "../admin/lib/functions.php";
$user= new functions();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
header("Access-Control-Max-Age: 18000");
//data 
$data=file_get_contents('php://input');
$input= json_decode( $data, TRUE ); //convert JSON into array
//echo $input['email'];
if($input['case']=='calculate_price')
{
	$returnData 	=array();
	$result 		=$user->get_driving_information($input['pickup'],$input['dropoff']);
	$get_trip_type 	=$user->select_trip_type_data_perticular($input['tripType'],$input['noOfPax']);
	$car_img 		=$user->select_car_type_for_car_img($input['noOfPax']);
	//echo json_encode($result['distance']);
	//exit();
	if($result=='false')
	{
		$returnData=array('status'=>'false');
	}
	else
	{
		if($get_trip_type['limit_km']>=$result['distance'])
		{
			$tripStandardPrice=$get_trip_type['standard_price'];
			if($input['tripType']==1)
			{
				$realPrice=$tripStandardPrice-(($tripStandardPrice/100)*10);
			}
			if($input['tripType']==3)
			{
				$realPrice=$tripStandardPrice+(($tripStandardPrice/100)*10);
			}
			if($input['tripType']==2)
			{
				$realPrice=$tripStandardPrice;
			}
			$returnData=array('tripPrice' => $realPrice, 'tripDistance' => $result['distance'],'status'=>'true','carImg'=>$car_img['img_url']);
		}
		if($get_trip_type['limit_km']<$result['distance'])
		{
			$extra_km 				= $result['distance']-$get_trip_type['limit_km'];
			$extraprice 			= $extra_km*$get_trip_type['over_limit_charge_per_km'];
			$tripStandardPrice 		= $extraprice+$get_trip_type['standard_price'];
			if($input['tripType']==1)
			{
				$realPrice=$tripStandardPrice-(($tripStandardPrice/100)*10);
			}
			if($input['tripType']==3)
			{
				$realPrice=$tripStandardPrice+(($tripStandardPrice/100)*10);
			}
			if($input['tripType']==2)
			{
				$realPrice=$tripStandardPrice;
			}
			$returnData=array('tripPrice' => $realPrice, 'tripDistance' => $result['distance'],'status'=>'true','carImg'=>$car_img['img_url']);
		}
		/*
		$to = "somebody@example.com";
		$subject = "YOUR QUOTE";
		$txt = "The suggested quote we can give you today is";
		$headers = "From: webmaster@example.com" . "\r\n" .
		"CC: somebodyelse@example.com";
		mail($to,$subject,$txt,$headers);
		*/
		$insert_trip_data_to_db=$user->insert_trip_data_to_db($input,$get_trip_type['trip_type_id']);
	}
	
	
	echo json_encode($returnData);
}
if($input['case']=='carAndTripData')
{
	$result=$user->all_select_data_withoutquery_return_array_forcar('vehicle');
	echo json_encode($result);
}
?>