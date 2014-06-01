<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

if (isset($_GET["mode"]) == "true") {
    $addflag = 1;
    $addflag_title = "Add Home Page Slider";
    $gen1 = mysql_query("SELECT MAX(code) AS maxcode FROM `slider` LIMIT 0,1 ") or die(mysql_error());
    if (mysql_num_rows($gen1) > 0) {
        $vvouch = mysql_fetch_assoc($gen1);
        $qvouch = $vvouch["maxcode"] + 1;
    } else {
        $qvouch = '1';
    }
} else {
    $addflag = 0;
    $addflag_title = "Edit Home Page Slider";
    $qvouch = $_GET["vouchno"];
}


if (isset($_POST["submit"])) {
    $a = 1;
    $title            = $_POST["title"];
    $order          = trim($_POST["order"]);

    
    $home ="img/homepage/";
    
    if(!empty($_FILES['file']['name'])){
        
       move_uploaded_file($_FILES["file"]["tmp_name"], $home . $_FILES["file"]["name"]);
       $imgpath = $home . $_FILES["file"]["name"];
     /*  $image = new SimpleImage();
       $image->load($imgpath);
       $image->resize(639,360);
       $image->save($imgpath);*/
    
    }
    if ($a == 1) {
        if ($addflag == 1) {
            mysql_query("INSERT INTO `slider`(code, `title`, `order`, `sliderimg`)
                                       VALUES($qvouch, '$title', '$order', '$imgpath')") or die(mysql_error());
            header("Location: add_home.php?vouchno=$qvouch");
    }else{
          $mvouch = $qvouch;
          if(!empty($_FILES["file"]['name'])){
              mysql_query("UPDATE `slider` SET `title`='$title', `order`='$order', `sliderimg`='$imgpath'
                           WHERE code = '$mvouch' ") or die(mysql_error());
          }else{
              mysql_query("UPDATE `slider` SET `title`='$title', `order`='$order'  WHERE code = '$mvouch' ") or die(mysql_error());
              
              
          }
            updmess();
            header("refresh: 1; add_home.php?vouchno=$mvouch");
        }
    }
}

if ($addflag == 0) {
    $getvouch = $_GET["vouchno"];
    $result = mysql_query("SELECT *  FROM `slider` WHERE code='$getvouch'") or die(mysql_error());
    $get = mysql_fetch_array($result);
    
    $mimgpath = $get['sliderimg'];
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
    
    <head>
        <meta charset="UTF-8">
        <title>Home Slider</title>
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
    </head>

    <body onLoad="document.boq.vouchdt.focus();">
        <form action=''  name="products" method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-6" style='width:30%;float:left;'>
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5><?php echo $addflag_title; ?></h5>
            <!-- .toolbar -->
            <div class="toolbar">
                <ul class="nav">
                    <li><a href="#"></a></li>
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.toolbar -->
        </header>
        <div id="div-1" class="accordion-body collapse in body">
            <div class="form-horizontal">
              <div class="form-group">
                <label class="control-label col-lg-4">Title</label>
                   <div class="col-lg-8">
                         <input type="text" name="title" value="<?php echo ($addflag == 0) ? $get['title'] :" "; ?>"  class="form-control" />
                   </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Order</label>
                   <div class="col-lg-8">
                    <input type="text"  name="order" value="<?php echo ($addflag == 0) ? $get['order'] :" "; ?>"  class="form-control" />
                   </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Image</label>
                   <div class="col-lg-8">
                        <input type="file"  name="file" value="" class="form-control" />
                   </div>
              </div>

           </div>
    </div>
</div>        
</div>        

    <div class="col-lg-6" style='width:65%;float:right;'>
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-picture-o"></i></div>
            <h5>Slider Image</h5>
            <!-- .toolbar -->
            <div class="toolbar">
                <ul class="nav">
                    <?php 
                      if($addflag == 0){
                    ?>
                    <li><input type='button' value='New' class="btn btn-success"  onClick="window.location.href='add_home.php?mode=true'"></li>
                      <?php }?>
                    <li><input type='submit' name='submit' value='Save' class="btn btn-primary"></li>
                    <li><input type='button' name='exit' value='Exit' class="btn btn-danger" onClick="window.location.href='homemain.php'"></li>
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-2">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.toolbar -->
        </header>
        <div id="div-2" class="accordion-body collapse in body">
          <?php
             if($addflag == 0){
                 echo "<img src='".$mimgpath."' style='width:550px;height:auto;'>";
                 
             }
            
          ?>
  
            
    </div>    
        
</div>
</div>
</div>
</div>            
            
        </form>





              
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/lib/jquery.min.js"><\/script>')</script> 

        <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
        
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        

        
   <script src="assets/lib/uniform/jquery.uniform.min.js"></script>
<script src="assets/lib/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
<script src="assets/lib/autosize/jquery.autosize.min.js"></script>
<script src="assets/lib/jasny/js/bootstrap-inputmask.js"></script>
        

        <script src="assets/js/main.js"></script>

        
        <script>
            $(function() { formGeneral(); });
        </script>
        

    </body>
</html>
