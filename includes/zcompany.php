<?php
function zcomp(){
    require("includes/dbconnect.php");

    $comp = mysql_query("SELECT * FROM `company`") or die(mysql_error());
    $zcomp = mysql_fetch_assoc($comp);
    echo "<font size='4px' color='#039'><b>$zcomp[compname]</font></b></font><br />";
    echo "<font size='2px' color='#039'><b> $zcomp[add1]</b></font><br /><br />";
    //echo "<b><font size='3px'>Date : " . date("M-d-Y") . "</b><br />";
    // echo "<b>"."Total Cenntre - $getno</b><br />";
  
}
?>
