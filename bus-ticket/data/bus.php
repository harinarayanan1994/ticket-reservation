<?php


if (isset($_POST)) {
  
   if (isset($_POST["from"])){
    $from= $_POST['from'];

    
  }
   if (isset($_POST["to"])){
    $to = $_POST['to'];
    
  }
    if (isset($_POST["date"])){
    $date = $_POST['date'];
    
  }
    if(isset($_POST['mon'])){
		$m=$_POST['mon'];
	}
	if(isset($_POST['yr'])){
		$y=$_POST['yr'];
	}
 
}
$t=explode('/',date('d/m/y'));
if( $from==""||$to==""||$date==""||$m==""||$y=="")
	die("Server Error:Please Fill all the required details");
else if($from==$to)
	die("Server error:Invalid input");
else if(checkdate($m,$date,$y)!=1)
	die("Server error:Enter valid date");

else if(($date<$t[0])&&($m==$t[1])&&($y==$t[2]))
	die("Server error:Invalid date");
else if(($m<$t[1])&&($y==$t[2]))
	die("Server error:Invalid date");
else if(($y!=$t[2])&&($y!=$t[2]+1))
	die("Server error:Invalid date");
else if(($date==$t[0])&&($m==$t[1])&&($y==$t[2]))
	die("You cannot book for today");
else if(($date==01)&&($m==01)&&($y==$t[2]+1))
	die("Holiday for new year and Booking for next year starts from January 1");
else if(($y==$t[2]+1))
	die("Booking for next year starts from January 1");


else
  { 
session_start();

$con=mysql_connect("localhost","root","");
 $db_found = mysql_select_db("bus");
$n=date("d/m/y", mktime(0, 0, 0, $m, $date, $y));

$result = mysql_query("SELECT * FROM schedule WHERE `From`='$from' AND `To`='$to'");

$c=mysql_num_rows($result);
if($c==0)
	die("<body bgcolor='wheat'><center><b><h1><cite>SORRY!!NO AVAILABLE BUSES</cite></h1>");
else
{
echo "<body bgcolor='wheat'><center><b><h1>".$_SESSION['log_user']."<br><cite>AVAILABLE BUSES</cite></h1>
<table border='1'><tr><th>Date</th><th>From</th><th>To</th><th>Departure</th><th>Arrival</th><th>Seats Booked out of 58</th></tr></b>";
$i=0;while($i<$c){
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $n ."</td>";
  echo "<td>" . $row['From'] . "</td>";
  echo "<td>" . $row['To'] . "</td>";
  echo "<td>" . $row['Departure'] . "</td>";
  $dep[$i]=$row['Departure'];
  echo "<td>" . $row['Arrival'] . "</td>";
  $seats=mysql_query("SELECT sum(seats) FROM bookings WHERE `From`='$from' AND `To`='$to' AND Departure='$dep[$i]' AND Date='$n'");
   while($seat = mysql_fetch_array($seats)){
        $book=$seat['sum(seats)'];
	if($book>=58)
		{echo "<td>Full</td>";$b[$i]="";}
	else
		{echo "<td>".$book."</td>";$b[$i]=$dep[$i];}
	
	}
  echo "</tr>";$i=$i+1;
  }}
echo "</table></center></body>";
mysql_close($con);
}
}


?>
<html><form name='hari' action='http://localhost/bus-ticket/data/ticket.php' method='POST'>
<head><script>
function check(){
if(hari.num.value!=hari.rep.value)
	{alert("Rewrite correct password!!!");hari.rep.focus();}
}</script></head>
<body><center>
<h1>BOOK YOUR TICKETS HERE</h1>
<img src='bus.jpg'>
<br><table border='2'><tr><td>Name:<td><input type="text" name='name'></tr>
<tr><td>Date:<td><select name='date'><option value='<?php echo $n ?>' selected><?php echo $n ?></select></tr>
<tr><td>From:<td><select name='from'><option value='<?php echo $from ?>' selected><?php echo $from ?></select></tr>
<tr><td>To:<td><select name='to'><option value='<?php echo $to ?>' selected><?php echo $to ?></select></tr>
<tr><td>Departure:<td><select name='dep'>
<?php 
while($i>0)
	{$i=$i-1;
     	echo "<option value=".$b[$i].">".$b[$i];
} 
?>
</select></tr>
<tr><td>Seats:<td><input type="number" name='seat' min='1' max='58'></tr>
<tr><td>Credit card:<td><input type='radio' name='card' checked='checked'  value='VISA'>VISA<input type='radio' name='card' value='Master Card' >Master Card
<input type='radio' name='card' value='American Express'>American Express<input type='radio' name='card' value='Discover'>Discover</tr>
<tr><td>Card Number:<td><input type='password' name='num'></tr>
<tr><td>Repeat Number:<td><input type='password' name='rep' onblur='check()'></tr>
<tr><td colspan='2' align='center'><input type='submit' value='book ticket'></tr></table>
</body></form></html>