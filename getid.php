<?php

include("includes/dbconnect.php");
include("includes/function.php");

$mcode = $_REQUEST["id"];
$values = array();

$get_data = mysql_query("SELECT * FROM `prodmain` WHERE `code`='$mcode'")or die(mysql_error());
$row = mysql_fetch_assoc($get_data);
$code = $row['code'];
$type = $row['type'];
$company = $row['company'];
$brand = $row['brand'];
$category = $row['category'];
$subcategory = $row['subcategory'];

// $gettype = mysql_query("SELECT `name` FROM `prodtype` WHERE code='$type'")or die(mysql_error());
// $mtype = mysql_fetch_assoc($gettype);
// $getcomp = mysql_query("SELECT `name` FROM `company` WHERE code='$company'")or die(mysql_error());
// $mcomp = mysql_fetch_assoc($getcomp);
// $getbrand = mysql_query("SELECT `name` FROM `brand` WHERE code='$brand'")or die(mysql_error());
// $mbrand = mysql_fetch_assoc($getbrand);
// $getcat = mysql_query("SELECT `name` FROM `category` WHERE code='$category'")or die(mysql_error());
// $mcat = mysql_fetch_assoc($getcat);
// $getsubcat = mysql_query("SELECT `name` FROM `subcat` WHERE code='$subcategory'")or die(mysql_error());
// $msubcat = mysql_fetch_assoc($getsubcat);

if($row){
  $values['id'] = $row['code'];
  $values['title'] = $row['title'];
  $values['largeimg'] = $row['largeimg'];
  // $values['type'] = $mtype['name'];
  // $values['company'] = $mcomp['name'];
  // $values['brand'] = $mbrand['name'];
  // $values['category'] = $mcat['name'];
  // $values['subcat'] = $msubcat['name'];
}

$tranqry = mysql_query("SELECT * FROM `prodtran` WHERE code='$code'")or die(mysql_error());
$i = 1;
while ($prodtran = mysql_fetch_assoc($tranqry)) {
  $values['srno'][$i] = $prodtran['srno'];
  $values['ttitle'][$i] = $prodtran['title'];
  $values['description'][$i] = $prodtran['description'];
  $i++;
}

echo json_encode($values, JSON_UNESCAPED_SLASHES);

?>
