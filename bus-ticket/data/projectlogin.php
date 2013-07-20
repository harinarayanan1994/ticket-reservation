<?php



if (isset($_POST)) {
  if (isset($_POST["log_user"])){
    $name = $_POST['log_user'];
    
  }
   if (isset($_POST["pass"])){
    $pass = $_POST['pass'];
    $pass = md5($pass);
   
    
    
  }
  



$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");


$n=mysql_query("SELECT Name FROM users WHERE Username='$name' and Password='$pass'");


$count = mysql_num_rows($n);

if($count!=1)
{
	echo "<h1><b>Invalid username or password</b></h1>";

}
else if($count==1&&$name=='hari_nara')
{
session_start();
$_SESSION['log_user']=$name;

$_SESSION['pass']=$pass;

echo "<html><body bgcolor='wheat'><center><b><h1>You have logged in.<br>WELCOME ADMIN</h1><br>";
while($result = mysql_fetch_array($n)) {

echo  $result['Name'];

}

echo "<br><center><a href='http://localhost/bus-ticket/data/out.php'>logout</a><br>
<a href='http://localhost/bus-ticket/data/prochange.html'>Change Password</a><br>
<a href='http://localhost/bus-ticket/data/prodate.html'>Change Schedule</a><br><form  action='http://localhost/bus-ticket/data/bus.php' method='POST'><table border='3'><tr><td>From:<td><input type='text' name='from'><br>
</tr><tr><td>To:<td><input type='text' name='to'><br></tr><tr><td>Date:<td>Day:<input type='text' name='date' size='1'>Month:<input type='text' name='mon' size='1'>Year:(yy)<input type='text' name='yr' size='1'>
<br></tr><tr><td colspan='2' align='center'><input type='submit' value='check bus list'><br></table><a href='http://localhost/bus-ticket/data/new.html'>Add buses</a><br><a href='http://localhost/bus-ticket/data/delete.html'>Remove Bus</a>
<br><a href='http://localhost/bus-ticket/data/cancel.html'>Cancel Ticket</a>
</body>
</html>";
}
else
{
session_start();
$_SESSION['log_user']=$name;

$_SESSION['pass']=$pass;

echo "<html><body bgcolor='wheat'><center><b><h1>You have logged in.<br>WELCOME</h1><br>";
while($result = mysql_fetch_array($n)) {

echo $result['Name'];

}

echo "<br><center><a href='http://localhost/bus-ticket/data/out.php'>logout</a><br>
<a href='http://localhost/bus-ticket/data/prochange.html'>Change Password</a><br><form  action='http://localhost/bus-ticket/data/bus.php' method='POST'><table border='3'><tr><td>From:<td><input type='text' name='from'></tr><br><tr><td>
To:<td><input type='text' name='to'><br></tr><tr><td>Date:<td>Day:<input type='text' name='date' size='1'>Month:<input type='text' name='mon' size='1'>Year:<input type='text' name='yr' size='1'></tr><br><tr><td colspan='2' align='center'><input type='submit' value='check bus list'>
</tr></table><br><a href='http://localhost/bus-ticket/data/cancel.html'>Cancel Ticket</a>
</body>
</html>";
}


mysql_close($conn);
}


?>
