<?php
session_start();

class createConnection //create a class for make connection
{
  private $host="localhost";
  private $username="root";    // specify the sever details for mysql
  private $password="123456";
  private $database="travelPro";
    

    public function __construct() // create a function for connect database
    {

        $conn= mysql_connect($this->host,$this->username,$this->password);
//mysql_set_charset($conn,"utf8");
        if(!$conn)// testing the connection
        {
            die ("Cannot connect to the database");
        }

        else
        {

           //$this->myconn = $conn;
            // echo "Connection established";
			
		mysql_select_db($this->database,$conn);  //use php inbuild functions for select database
          
		   
		 if(mysql_error()) // if error occured display the error message
         {

            echo "Cannot find the database ".$this->database;

         }
          //echo "Database selected..";    

        }

    }
    
}
?>