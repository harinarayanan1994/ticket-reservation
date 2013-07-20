
 <?php
      
 $con=mysql_connect("localhost","root","");
 $db_found = mysql_select_db("bus");


$result = mysql_query("SELECT * FROM schedule");
echo "<body bgcolor='wheat'><center><b><h1><cite>OUR SERVICES</cite></h1>
<table border='1'><tr><th>From</th><th>To</th><th>Departure</th><th>Arrival</th><th>Fare/ticket</th></tr></b>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  
  echo "<td>" . $row['From'] . "</td>";
  echo "<td>" . $row['To'] . "</td>";
  echo "<td>" . $row['Departure'] . "</td>";
  echo "<td>" . $row['Arrival'] . "</td>";
  echo "<td>" . $row['Fare_per_ticket'] . "</td>";
  echo "</tr>";
  }
echo "</table></center></body>";
mysql_close($con);
?>
 
