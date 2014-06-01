<?php

function insmess(){
    
    print '<script type="text/javascript">';
    print 'alert("RECORD ADDED SUCESSFULLY")';
    PRINT '</script>';
}

function updmess()
{
    print '<script type="text/javascript">';
    print 'alert("RECORDS UPDATED SUCESSFULLY")';
    print '</script>';
}

function browse($var)
{
    print '<script type="text/javascript">';
    print 'alert("'.$var.'")';
    print '</script>';
}

function mydt($var)
{
    mysql_real_escape_string($var);
    strtotime($var);
    date('Y-m-d',$var);
}

function monthname($month_int) {
    $month_int = (int) $month_int;
    $months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    return $months[$month_int];
}


function rsword($number)
{
if (($number < 0) || ($number > 999999999))
{
throw new Exception("Number is out of range");
}
$Gn = floor($number / 100000);  /* Millions (giga) */
$number -= $Gn * 100000;
$kn = floor($number / 1000);     /* Thousands (kilo) */
$number -= $kn * 1000;
$Hn = floor($number / 100);      /* Hundreds (hecto) */
$number -= $Hn * 100;
$Dn = floor($number / 10);       /* Tens (deca) */
$n = $number % 10;               /* Ones */
$res = "";
if ($Gn)
{
$res .= rsword($Gn) . " Lacs";
}
if ($kn)
{
$res .= (empty($res) ? "" : " ") .
rsword($kn) . " Thousand";
}
if ($Hn)
{
$res .= (empty($res) ? " " : " ") .
rsword($Hn) . " Hundred";
}
$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
"Nineteen");
$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
"Seventy", "Eigthy", "Ninety");
if ($Dn || $n)
{
if (!empty($res))
{
$res .= " and ";
}
if ($Dn < 2)
{
$res .= $ones[$Dn * 10 + $n];
}
else
{
$res .= $tens[$Dn];
if ($n)
{
$res .= "-" . $ones[$n];
}
}
}
if (empty($res))
{
$res = "zero";
}
return $res;
}


function delete($mydb, $table, $vouch, $chk, $file){
    mysql_select_db($mydb);
    

    mysql_query("DELETE FROM $table WHERE $vouch='$chk'") or die(mysql_error());
    header("refresh: 1; $file");
}
function table($res) {
  $i = 0;
  $colNames = array();
  $data = array();
  while($row = mysql_fetch_assoc($res)) 
  {
     if($i == 0)
     {
        foreach($row as $colname => $val)
           $colNames[] = $colname;
     }
     $data[] = $row;
  $i++;
  }
    $colNames = array_keys(reset($data));
    $num = mysql_num_rows($res);

    
    
    
    echo "<h1>Number Of Records: $num</h1>";
    echo '<table border="1" cellspacing="0" cellpadding="10">';
    echo "<tr>";

    foreach ($colNames as $colName) {
        echo "<th>$colName</th>";
    }

    foreach ($data as $row) {
        echo "<tr>";
        foreach ($colNames as $colName) {
            echo "<td>" . $row[$colName] . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";


    
}
function val($value)
{
if (get_magic_quotes_gpc())
  {
  $value = stripslashes($value);
  }
if (!is_numeric($value))
  {
  $value = "'" . mysql_real_escape_string($value) . "'";
  }
return $value;
}
/*********RE-sizing image************/

class SimpleImage {
    var $image; var $image_type;
    function load($filename) {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if( $this->image_type == IMAGETYPE_JPEG ) {
            $this->image = imagecreatefromjpeg($filename);
            } elseif( $this->image_type == IMAGETYPE_GIF ) {
                $this->image = imagecreatefromgif($filename);
                } elseif( $this->image_type == IMAGETYPE_PNG ) { 
                    $this->image = imagecreatefrompng($filename); }
                    }
                    function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
                                   if(file_exists($filename)){
                                       unlink($filename);
                                   } 
                        
                        if( $image_type == IMAGETYPE_JPEG ) { imagejpeg($this->image,$filename,$compression);
                        } elseif( $image_type == IMAGETYPE_GIF ) {
                            imagegif($this->image,$filename);
                            } elseif( $image_type == IMAGETYPE_PNG ) {
                                imagepng($this->image,$filename);
                                } if( $permissions != null) {
                                    chmod($filename,$permissions);
                                    }
                     } function output($image_type=IMAGETYPE_JPEG) {
                                        if( $image_type == IMAGETYPE_JPEG ) {
                                            imagejpeg($this->image);
                                            } elseif( $image_type == IMAGETYPE_GIF ) {
                                                imagegif($this->image);
                                                } elseif( $image_type == IMAGETYPE_PNG ) {
                                                    imagepng($this->image);
                                                    }
                                                    } function getWidth() { 
                                                        return imagesx($this->image);
                                                        } function getHeight() {
                                                            return imagesy($this->image);
                                                            } function resizeToHeight($height) {
                                                                $ratio = $height / $this->getHeight();
                                                                $width = $this->getWidth() * $ratio;
                                                                $this->resize($width,$height);
                                                                }
                                                                function resizeToWidth($width) {
                                                                    $ratio = $width / $this->getWidth();
                                                                    $height = $this->getheight() * $ratio;
                                                                    $this->resize($width,$height);
                                                                    }
                                                                    function scale($scale) {
                                                                        $width = $this->getWidth() * $scale/100;
                                                                        $height = $this->getheight() * $scale/100;
                                                                        $this->resize($width,$height);
                                                                        }
                                                                        function resize($width,$height) {
                                                                            $new_image = imagecreatetruecolor($width, $height);
                                                                            imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
                                                                            $this->image = $new_image; }   } 
                                                                      

?>
