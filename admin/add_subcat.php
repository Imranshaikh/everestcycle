<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

$formname = "Sub Category";
$file    = 'add_subcat.php';
$grid    = 'subcatmain.php';
$maindb  = 'subcat';

if (isset($_GET["mode"]) == "true") {
    $addflag = 1;
    $addflag_title = "Add $formname";
    $gen1 = mysql_query("SELECT MAX(code) AS maxcode FROM `$maindb` LIMIT 0,1 ") or die(mysql_error());
    if (mysql_num_rows($gen1) > 0) {
        $vvouch = mysql_fetch_assoc($gen1);
        $qvouch = $vvouch["maxcode"] + 1;
    } else {
        $qvouch = '1';
    }
} else {
    $addflag = 0;
    $addflag_title = "Edit Products";
    $qvouch = $_GET["vouchno"];
}

if (isset($_POST["submit"])) {
    $a = 1;
    $name             = $_POST["name"];
  
        if ($addflag == 1) {
            mysql_query("INSERT INTO `$maindb`(`code`, `name`)
                                          VALUES('$qvouch', '$name')") or die(mysql_error());
            insmess();
             
            header("refresh: 1; $file?mode=true");
    }else{
          $mvouch = $qvouch;
            mysql_query("UPDATE `$maindb` SET `name`='$name' WHERE code = '$mvouch' ") or die(mysql_error());
            updmess();
            header("refresh: 1; $file?vouchno=$mvouch");
        }

}

if ($addflag == 0) {
    $getvouch = $_GET["vouchno"];
    $result = mysql_query("SELECT *  FROM `$maindb` WHERE code='$getvouch'") or die(mysql_error());
    $get = mysql_fetch_array($result);
   
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
    
    <head>
        <meta charset="UTF-8">
        <title>Add <?=$formname?></title>
        <meta name="msapplication-TileColor" content="#5bc0de"/>
        <meta name="msapplication-TileImage" content="assets/img/metis-tile.png"/>
        
        <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/main.css"/>
        <link rel="stylesheet" href="assets/lib/Font-Awesome/css/font-awesome.css"/>

        <link rel="stylesheet" href="assets/css/theme.css">

        
        <link rel="stylesheet" href="assets/lib/uniform/themes/default/css/uniform.default.css">
        <link rel="stylesheet" href="assets/lib/inputlimiter/jquery.inputlimiter.1.0.css">
        <link rel="stylesheet" href="assets/lib/chosen/chosen.min.css">
        <link rel="stylesheet" href="assets/lib/colorpicker/css/colorpicker.css">
        <link rel="stylesheet" href="assets/lib/tagsinput/jquery.tagsinput.css">
        <link rel="stylesheet" href="assets/lib/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="assets/lib/datepicker/css/datepicker.css">
        <link rel="stylesheet" href="assets/lib/timepicker/css/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="assets/lib/switch/static/stylesheets/bootstrap-switch.css">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/flick/jquery-ui.css">
        
        
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  
                 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-1669764-16', 'onokumus.com');
            ga('send', 'pageview');

        </script>

        <script src="assets/lib/modernizr-build.min.js"></script>
        <script type="text/javascript" src="../js/jquery.js"></script>


<div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5><?=$addflag_title?></h5>
                    <div class="toolbar">
                      <ul class="nav pull-right">
                        <li>
                          <a class="minimize-box" data-toggle="collapse" href="#div-4">
                            <i class="fa fa-chevron-up"></i>
                          </a>
                        </li>
                      </ul>
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-4" class="accordion-body collapse in body">
                    <form class="form-horizontal" action='' method='POST'>
     
                      <div class="form-group">
                        <label class="control-label col-lg-3">Name</label>
                        <div class="col-lg-5">
                          <div class="input-group">
                            <input type="text" size="40"  id="invno" name="name" value="<?php echo ($addflag == 0) ? $get['name'] : ''; ?>"  class="form-control" /> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3"></label>
                        <div class="col-lg-5">
                          <div class="input-group">
                           <input type='submit' name='submit' class='btn btn-primary' value='Save'> &nbsp;&nbsp;
                           
                           <input type='button' name='exit' class='btn btn-danger' value='Exit' onClick="window.location.href='<?=$grid?>'">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
