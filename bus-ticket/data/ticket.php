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
    $s = $_POST['seat'];
    
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
$big=0;
$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");

 $seats=mysql_query("SELECT sum(seats) FROM bookings WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date'");
   while($seat = mysql_fetch_array($seats)){
        $book=$seat['sum(seats)'];
        $avai=58-$book;}
$now=date("m/d/Y h:i:s a", time());
$sec=mysql_query("SELECT * FROM bookings WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date'");
while($secret = mysql_fetch_array($sec)){
        $che=$secret['Card_Number'];
	$cheo=$secret['Credit_card'];
	if(($che==$ha)&&($cheo==$card))
		{die("Already existing card no.");}
}

if($name==""||$num==""||$s==""||$dep=="")
	die("Server Error:Please fill all details");
else if($num!=$rep)
	die("Server Error:Rewrite credit card number correctly");
else if($s>$avai)
	die("No enough seats");

else
{


$fare=mysql_query("SELECT Fare_per_ticket FROM schedule WHERE `From`='$from' AND `To`='$to' ");
while($cost = mysql_fetch_array($fare)){
        $pay=$s*$cost['Fare_per_ticket'];}
$t=mysql_query("SELECT * FROM bookings WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date' ");
$c=mysql_num_rows($t);
$dt=mysql_query("SELECT seats FROM `cancelled` WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date'");
$cdt=mysql_num_rows($dt);
if($c==0&&$cdt==0)
{
$place="";


$i=1;

while($i<=$s){

$place=$place.",".$i;
$i++;
}


}
else
{
$a=$cdt+1;
$bef=mysql_query("SELECT * FROM bookings WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date' ");
while($seat = mysql_fetch_array($bef)){
        $next=$seat['seatnum'];
	$sep=explode(',',$next);
	$size=end($sep);
	if($size>$big)
		{$big=$size;}
}
while($seat = mysql_fetch_array($dt)){
        $next=$seat['seats'];
	if($next>$big)
		{$big=$next;}
}
$inc=$big+1;
$place="";
$i=1;


while($i<$s+1){

$dt=mysql_query("SELECT seats FROM `cancelled` WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date'");
$cdt=mysql_num_rows($dt);
if($c!=0&&$cdt==0)
{


if($inc==59)
	break;
else
{
$i++;
$place=$place.",".$inc;
$inc++;}
}


else if($c==0&&$cdt==0)
{


if($a==59)
	break;
else
{
$i++;
$place=$place.",".$a;
$a++;}
}
else
	{
	$dt=mysql_query("SELECT seats FROM `cancelled` WHERE `From`='$from' AND `To`='$to' AND Departure='$dep' AND Date='$date'");
	while($cs = mysql_fetch_array($dt)){
	$next=$cs['seats'];
	if($i>$s)
		break;
        $place=$place.",".$next;
	
	$i++;
	$rem = mysql_query("DELETE FROM `bus`.`cancelled` WHERE `seats`='$next' ");
	}

	}


}

}

$insert = "INSERT INTO  bookings VALUES('$now','$name','$date','$from','$to','$dep','$s','$card','$ha','$pay','$place') ";
$result = mysql_query( $insert );

if($result)
{
echo "<body bgcolor='wheat'><center><h1><b>".$_SESSION['log_user']."<br>TICKET BOOKED SUCCESSFULLY</b></h1><br>
<table border='3'><tr><td colspan='8' align='center'><b><h1>VOLVO DELUXE BUS SERVICE</h1></b><tr><th>Name</th><th>No.of seats</th><th>From</th><th>To</th><th>Departure</th><th>Date</th><th>Fare</th><th>Seat no.</th></b></tr>
<tr><td>".$name."<td>".$s."<td>".$from."<td>".$to."<td>".$dep."<td>".$date."<td>".$pay."<td>".$place;





echo "</tr><tr><td colspan='8' align='center'><b>THANK U!!!HAVE A HAPPY JOURNEY!!!</b></tr></table><br>
       		<a href='http://localhost/bus-ticket/data/out.php'>LOGOUT</a></center></body>";
}
else
	echo "Booking Failed";



	
mysql_close($conn);
}


}


?>