<?php

include("includes/dbconnect.php");
include("includes/function.php");

$mcomp = $_POST["company"];
$mbrand = $_POST["brand"];
$mcat = $_POST["category"];
$msubcat = $_POST["subcategory"];

$rows = array();

$comp_where = $brand_where = $cat_where = $subcat_where = "";

$comp_check = array_filter($mcomp);
if(isset($mcomp) && !empty($comp_check)){
  $compstr = implode(",", $mcode);
  $comp_where = "AND `company` IN ($compstr)" ;
}

$brand_check = array_filter($mbrand);
if(isset($mbrand) && !empty($brand_check)){
  $brandstr = implode(",", $mbrand);
  $brand_where = "AND `brand` IN ($brandstr)" ;
}

$cat_check = array_filter($mcat);
if(isset($mcat) && !empty($cat_check)){
  $catstr = implode(",", $mcat);
  $cat_where = "AND `category` IN ($catstr)" ;
}

$subcat_check = array_filter($msubcat);
if(isset($msubcat) && !empty($subcat_check)){
  $subcatstr = implode(",", $msubcat);
  $subcat_where = "AND `subcategory` IN ($subcatstr)" ;
}





$get_data = mysql_query("SELECT * FROM `prodmain` WHERE `code` != '' $comp_where $brand_where $cat_where $subcat_where") or die(mysql_error());


while($rec = mysql_fetch_assoc($get_data)){
  $rows[] = $rec ;
}

mysql_free_result($get_data);

echo json_encode($rows, JSON_UNESCAPED_SLASHES);
// $row = mysql_fetch_assoc($get_data);
// while ($row = mysql_fetch_assoc($get_data)) {
//   $values['company'] = $row['company'] ;
// }

// echo json_encode($row, JSON_UNESCAPED_SLASHES);

?>
