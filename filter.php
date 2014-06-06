<?php

include("includes/dbconnect.php");
include("includes/function.php");

$mcode = $_POST["company"];
$values = array();


$where = '';

// if(isset($mcode) && !empty($mcode)){
//   $compstr = implode(",", $mcode);
//   // $where .= "`company` IN ({$compstr})" ;

// }

$compstr = implode(',', array_fill(0, count($mcode), '?'));

// $ar = array("4");
// $arr = implode(",", $ar);
// echo json_encode($compstr) ;
$get_data = mysql_query('SELECT * FROM `prodmain` WHERE `company` IN ('. $compstr . ')') or die(mysql_error());

$row = mysql_fetch_assoc($get_data);

if($row){
  echo "true";
}else{
  echo "imran";
}
// $row = mysql_fetch_assoc($get_data);
// while ($row = mysql_fetch_assoc($get_data)) {
//   $values['company'] = $row['company'] ;
// }

// echo json_encode($row, JSON_UNESCAPED_SLASHES);

?>
