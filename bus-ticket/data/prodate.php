<?php

session_start();

if (isset($_POST)) {

   if (isset($_POST["no"])){
    $no = $_POST['no'];
  
    
  }
  
   if (isset($_POST["from"])){
    $from = $_POST['from'];
  
    
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
    if (isset($_POST["fare"])){
    $rate = $_POST['fare'];
    
  }
 


if( $from==""||$to==""||$dep==""||$arr==""||$no==""||$rate=="")
	die("Server Error:Please Fill all the required details");
else if($from==$to||$dep==$arr)
	die("Server Error:Invalid inputs");
else 
{

$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");
$c=mysql_query("SELECT * FROM `schedule`  WHERE  `Bus_Number`='$no' AND `From`='$from' AND `To`='$to' ");
if(mysql_error())
	echo mysql_error();
$count= mysql_num_rows($c);

if($count==1)
{
$insert = "UPDATE `schedule` SET `Departure`='$dep',`Arrival`='$arr',`Fare_per_ticket`='$rate' WHERE Bus_Number='$no' ";
$result = mysql_query( $insert );

if($result)
{
echo "<body bgcolor='wheat'><center><h1><b>".$_SESSION['log_user']."<br>Schedule Changed Successfully</b></h1><br>Login again  to continue..<br>
       <a href='http://localhost/bus-ticket/data/log.php'>LOGIN</a></center></body>";
}
else
      echo "activity failed.Please try again";
mysql_close($conn);
}
else
 echo "The service doesnt exist ..give valid details";
}

}
?>