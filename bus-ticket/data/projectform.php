<?php

if (isset($_POST)) {
  if (isset($_POST["name"])){
    $name = $_POST['name'];
    
  }

  if (isset($_POST["gender"])){
    $gender = $_POST['gender'];
    
  }
  if (isset($_POST["phone"])){
    $roll = $_POST['phone'];
    
  }
 
 if (isset($_POST["id"])){
    $mail = $_POST['id'];
    $len=strlen($mail);
     $at=strpos($mail,'@');
    $d=strpos(strrev($mail),'.');
    $dot=$len-$d;
   

    
  }
  if (isset($_POST["add"])){
    $add = $_POST['add'];
    
  }

   
  
  if (isset($_POST["pwd"])){
    $pwd = $_POST['pwd'];
    $l=strlen($pwd);
    $ha=md5($pwd);
    
  }
  if (isset($_POST["pwd1"])){
    $rew = $_POST['pwd1'];
    
  }
      if (isset($_POST["user"])){
		
		$user=($_POST['user']);
		
		
}
	if (isset($_POST["phone"])){
		
		$phone=($_POST['phone']);
		
		
}
      
}


if($name==""||$mail==""||$pwd==""||$user=="")
	die("Server Error:Please Fill all the required details");

else if($l<5||$l>10)
	die("Server error:invalid password");

else if(!preg_match('/^\w+$/',$pwd))
	die("Server Error:Invalid Password");
else if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',$mail)||$at<1||$dot<$at+2)
	die("Server Error:Invalid mail id");
else if($pwd!=$rew)
	die("Server Error:Rewrite password correctly");

else 
{

$conn = mysql_connect("localhost","root","");
mysql_select_db("bus");
$insert = "INSERT INTO users (Name,Username,Gender,Email,Address,Phone,Password) 
           VALUES('$name','$user','$gender','$mail','$add','$phone','$ha')";
$result = mysql_query( $insert );
if($result)
{
echo "<h1><b>Your record added successfully\n</b></h1>";
echo "<body bgcolor='wheat'><table border='2'><tr><td>Name:<td>".$name."</tr><tr><td>Username:<td>".$user.
	"</tr><tr><td>Gender<td>".$gender.
	"</tr><tr><td>Email<td>".$mail."</tr><tr><td>Address<td>".$add."</tr><tr><td>Phone<td>".$phone."</tr><tr><td>Password<td>".$ha."</tr></table></body>";
}
else
{echo "<h1><b>Server error:Username or mailid already exists.Please refill the form</h1></b>";}


mysql_close($conn);
}


?>