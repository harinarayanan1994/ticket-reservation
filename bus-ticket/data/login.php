<?php



if (isset($_POST)) {
  if (isset($_POST["log_user"])){
    $name = $_POST['log_user'];
    
  }
   if (isset($_POST["pass"])){
    $pass = $_POST['pass'];
    $pass = md5($pass);
   
    
    
  }
  if (isset($_POST["roll"])){
    $roll = $_POST['roll'];
    
  }
}
if($roll=="")
{
echo "<h1><b>Server Error:Enter ur roll number</b></h1>";
}
else
{

$conn = mysql_connect("localhost","root","");
mysql_select_db("hari");


$n=mysql_query("SELECT Name FROM spider WHERE Username='$name' and Password='$pass'and Roll_Number=$roll");


$count = mysql_num_rows($n);
if($count!=1)
{
	echo "<h1><b>Invalid username or password</b></h1>";

}
else
{
session_start();
$_SESSION['log_user']=$name;

$_SESSION['pass']=$pass;
$_SESSION['roll']=$roll;
echo "<html><body bgcolor='wheat'><center><b><h1>You have logged in.<br>WELCOME</h1><br>".$name;
echo "<br>".$roll;
echo "<br><center><a href='http://localhost/bus-ticket/data/out.php'>logout</a><br>
<a href='change.html'>Change Password</a><br>

</body>
</html>";
}


mysql_close($conn);
}
?>
