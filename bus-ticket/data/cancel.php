<?php
session_start();
if (isset($_POST)) {
  if (isset($_POST["name"])){
    $name = $_POST['name'];
    
  }
    if (isset($_POST["date"])){
    $date = $_POST['date'];
    
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
    if (isset($_POST["seat"])){
    $seat = $_POST['seat'];
    
  }
    if (isset($_POST["num"])){
    $num = $_POST['num'];
    $ha=md5($num);
    
  }
    if (isset($_POST["rep"])){
    $rep = $_POST['rep'];
    
  }
     if (isset($_POST["card"])){
    $card = $_POST['card'];
    
  }
   if (isset($_POST["remseat"])){
    $cancel = $_POST['remseat'];
    
  }
  if(isset($_POST['mon'])){
		$m=$_POST['mon'];
	}
	if(isset($_POST['yr'])){
		$y=$_POST['yr'];
	}
$t=explode('/',date('d/m/y'));
if($name==""||$num==""||$seat==""||$dep==""||$cancel==""||$from==""||$to==""||$date==""||$m==""||$y=="")
	die("Server Error:Please fill all details");
else if($_SESSION['log_user']=="")
	{echo "<br><a href='http://localhost/bus-ticket/data/log.php'>LOGIN</a><br>";die("Please login to continue");
	}
else if($num!=$rep)
	die("Server Error:Rewrite credit card number correctly");
else if($from==$to)
	die("Server Error:Invalid inputs");
else if($cancel>$seat)
	die("Sorry!!You have booked only".$seat."seats");
else if(checkdate($m,$date,$y)!=1)
	die("Server error:Enter valid date");
else if(($date<$t[0])&&($m==$t[1])&&($y==$t[2]))
	die("Server error:Invalid date");
else if(($m<$t[1])&&($y==$t[2]))
	die("Server error:Invalid date");
else if(($y!=$t[2]))
	die("Server error:Invalid date");
else if(($date==$t[0])&&($m==$t[1])&&($y==$t[2]))
	die("Sorry!!you have no permission to cancel todays ticket");

else{

$n=date("d/m/y", mktime(0, 0, 0, $m, $date, $y));
$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");
$c=mysql_query("SELECT * FROM `bookings`  WHERE  `From`='$from' AND `To`='$to' AND `Name`='$name' AND `Date`='$n' AND `Departure`='$dep' AND `seats`='$seat' AND `Credit_card`='$card' AND `Card_Number`='$ha'");
$a=mysql_query("SELECT * FROM `schedule`  WHERE  `From`='$from' AND `To`='$to'");
$count= mysql_num_rows($c);
if($count==1)
{

while($cost = mysql_fetch_array($a)){
	$pay=$cost['Fare_per_ticket'];
        $tpay=$seat*$cost['Fare_per_ticket'];}
if(($date==$t[0]+1)&&($m==$t[1])&&($y==$t[2]))
	$rf=($cancel*0.75*$pay);
else
	$rf=($cancel*0.9*$pay);
$new=$tpay-$rf;	
if($seat==$cancel)
{
while($s = mysql_fetch_array($c)){
        $next=$s['seatnum'];}

$sep=explode(',',$next);
$i=0;
while($i<=$cancel)
{$res=mysql_query("INSERT INTO `cancelled` VALUES ($sep[$i],'$n','$from','$to','$dep') ");$i++;
}
$rem = "DELETE FROM `bus`.`bookings` WHERE `Card_Number`='$ha'AND `Date`='$n' AND `From`='$from' AND `To`='$to' AND `Departure`='$dep' AND `Credit_card`='$card' ";
$result = mysql_query( $rem );
$num="nil";
}
else 
{
while($s = mysql_fetch_array($c)){
        $next=$s['seatnum'];}

$sep=explode(',',$next);
$i=0;
while($i<=$cancel)
{$res=mysql_query("INSERT INTO `cancelled` VALUES ($sep[$i],'$n','$from','$to','$dep') ");
$i++;}
$rem=explode(',',strrev($next));
$i=0;
while($i<=$cancel)
{array_pop($rem);
$i++;}
$num="".","."".strrev(implode(',',$rem));


$final=$seat-$cancel;
$rem = "UPDATE `bookings` SET `seats`='$final',`Fare`='$new',`seatnum`='$num' WHERE `Card_Number`='$ha' AND `Date`='$n' AND `From`='$from' AND `To`='$to' AND `Departure`='$dep' AND `Credit_card`='$card' ";
$result = mysql_query( $rem );
}
if($result)
{
echo "<body bgcolor='wheat'><center><h1><b>".$_SESSION['log_user']."<br> TICKET CANCELLED SUCCESSFULLY</b></h1><br>Your new seat no is".$num."<br>Rs".$rf."/- has been credited to your account.<br>
       		<a href='http://localhost/bus-ticket/data/out.php'>LOGOUT</a></center></body>";
}
else
      echo "activity failed.Please try again";

}

else
	echo "You Have not booked";
}
mysql_close($conn);
}
?>
