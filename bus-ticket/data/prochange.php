<?php

session_start();

if (isset($_POST)) {
  
   if (isset($_POST["np"])){
    $np = $_POST['np'];
    $l=strlen($np);
    $ha = md5($np);
    
  }
   if (isset($_POST["cp"])){
    $cp = $_POST['cp'];
    
  }
  if (isset($_POST["op"])){
    $op = $_POST['op'];
    $oha = md5($op);
    
  }
  if (isset($_POST["us"])){
    $us = $_POST['us'];
   
    
  }
}

if( $us==""||$op==""||$np==""||$cp=="")
	die("Server Error:Please Fill all the required details");
else if($l<5||$l>10)
	die("Server error:invalid password");

else if(!preg_match('/^\w+$/',$np))
	die("Server Error:Invalid Password");

else if($np!=$cp)
	die("Server Error:Rewrite password correctly");
else 
{

$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");
$c=mysql_query("SELECT * FROM users  WHERE Username='$us' AND Password='$oha'");

$count= mysql_num_rows($c);

if($count==1)
{
$insert = "UPDATE  users SET Password='$ha' WHERE Username='$us' ";
$result = mysql_query( $insert );

if($result)
{
echo "<body bgcolor='wheat'><center><h1><b>".$_SESSION['log_user']."<br>Password Changed Successfully</b></h1><br>Login again with new password to continue..<br>
       <a href='http://localhost/bus-ticket/data/log.php'>LOGIN</a></center></body>";
}
else
      echo "activity failed.Please try again";
mysql_close($conn);
}
else
 echo "invalid Username or Password";
}


?>
