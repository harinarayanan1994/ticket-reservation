<?php
session_start();

if (isset($_POST)) {
  
   if (isset($_POST["from"])){
    $from= $_POST['from'];

    
  }
   if (isset($_POST["to"])){
    $to = $_POST['to'];
    
  }
  if (isset($_POST["dep"])){
    $dep = $_POST['dep'];
    
  }
  if (isset($_POST["arr"])){
    $arr = $_POST['arr'];
    
  }
   if (isset($_POST["no"])){
    $no = $_POST['no'];
    
  }
     if (isset($_POST["fare"])){
    $rate = $_POST['fare'];
    
  }

 

if( $from==""||$to==""||$dep==""||$arr==""||$no==""||$rate=="")
	die("Server Error:Please Fill all the required details");
else if($from==$to||$dep==$arr)
	die("Server error:Invalid input");
else if($_SESSION['log_user']=="")
	{echo "<br><a href='http://localhost/bus-ticket/data/log.php'>LOGIN</a><br>";die("Please login to continue");
	}

else 
{

$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");

$insert = "INSERT INTO  schedule VALUES('$no','$from','$to','$dep','$arr','$rate') ";
$result = mysql_query( $insert );

if($result)
{
echo "<body bgcolor='wheat'><center><h1><b>".$_SESSION['log_user']."<br>NEW SERVICE ADDED SUCCESSFULLY</b></h1><br>Login again  to continue..<br>
       		<a href='http://localhost/bus-ticket/data/log.php'>LOGIN</a></center></body>";
}
else
	echo "Already Exists";



	
mysql_close($conn);
}


}


?>
