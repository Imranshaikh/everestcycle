<?php
require("../includes/dbconnect.php");

mysql_select_db('pile_root');
if ($_GET['qyear']) {

    $year = $_GET["qyear"];
    $result = mysql_query("SELECT *, DATE_FORMAT(`startdate`, '%d-%m-%Y') as stdate, DATE_FORMAT(`lastdate`, '%d-%m-%Y')as endate FROM compyear WHERE finyear='$year'") or die(mysql_error());

    $cc = mysql_fetch_assoc($result);
    
    echo "<table border='0'>";
     echo "<tr>";
      echo "<td>";
         echo "<strong>Start Date-</strong>";
      echo "</td>";   
      echo "<td>";   
         echo "<strong><font size='3px' color='#FF9966'>$cc[stdate]</font></strong>";
      echo "</td>";
     echo "</tr>";
     echo "<tr>";
      echo "<td>";
         echo "<strong>End Date-</strong>";
      echo "</td>";   
      echo "<td>";   
         echo "<strong><font size='3px' color='#FF9966'>$cc[endate]</font></strong>";
      echo "</td>";
     echo "</tr>";
    echo "</table>";
    

}
?>
