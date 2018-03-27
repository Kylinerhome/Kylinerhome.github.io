<!DOCTYPE html>
<html>
<body>

<a href="home.html">BACK</a>
<br><br>
<?php
$drug1 = $_POST["drug1"];
$drug2 = $_POST["drug2"];
$minSupport = $_POST["minSupport"];
$minPRR = $_POST["minPRR"];
//$minPRR = 2;

echo '<table border="1" width="600" align="center">';
echo '<caption><h1>Information</h1></caption>';
echo '<tr bgcolor="#dddddd">';
echo '<th>Drug1</th><th>Drug2</th><th>minSupport</th><th>minPRR</th>';
echo '</tr>';
echo '<tr>';
echo '<th>'.$drug1.'</th><th>'.$drug2.'</th><th>'.$minSupport.'</th><th>'.$minPRR.'</th>';
echo '</tr>';

$con = new mysqli("127.0.0.1","root","liang123","xiangya");
if(!$con)
{
  die("Could not connect2:" . mysql_error());
}

//mysql_select_db("xiangya", $con);
//$result = mysql_query("select * from drug");
//$searchString = "select * from drugs2_event where (drug1='".$drug1."' and drug2='".$drug2."' and support>".$minSupport." and PRR> ".$minPRR.");";
$searchString = "select * from drugs2_event where (drug1='".$drug1."' and drug2='".$drug2."' and support>".$minSupport." and PRR>2);"; 
echo $searchString;
$result = $con->query($searchString);

echo '<table border="1" width="600" align="center">';
echo '<caption><h1>Results</h1></caption>';
echo '<tr bgcolor="#dddddd">';
echo '<th>Event</th><th>Support</th><th>PRR</th><th>CI</th>';
echo '</tr>';
while($row = mysqli_fetch_array($result))
{
  echo "<tr>";
  echo "<td>".$row['event']."</td>";
  echo "<td>".$row['support']."</td>";
  echo "<td>".$row['PRR']."</td>";
  echo "<td>".$row['CI']."</td>";
  echo "</tr>";
}

mysqli_close($con);
?>

</body>
</html>
