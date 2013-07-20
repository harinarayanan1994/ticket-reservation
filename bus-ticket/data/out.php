<?php 
session_start();
unset($_SESSION['log_user']);
unset($_SESSION['pass']);
unset($_SESSION['roll']);
session_destroy();
?>
<html>
<body bgcolor="wheat"><center><b><h1>You have logged out.</h1>
<br><a href="http://localhost/bus-ticket/data/log.php">login</a><br>
<a href="http://localhost/bus-ticket/project1.html">home</a>
</body></html>