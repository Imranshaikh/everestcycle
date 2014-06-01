<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

$formname = "Products";
$file     = 'add_products.php';
$grid     = 'prodmain.php';
$maindb   = 'prodmain';


if (isset($_GET["mode"]) == "true") {
    $addflag = 1;
    $addflag_title = "Add Products";
    $gen1 = mysql_query("SELECT MAX(code) AS maxcode FROM `prodmain` LIMIT 0,1 ") or die(mysql_error());
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
    $type             = $_POST["type"];
    $company          = trim($_POST["company"]);
    $brand            = trim($_POST["brand"]);
    $category         = trim($_POST["category"]);
    $subcategory      = trim($_POST["subcategory"]);
    $title            = trim($_POST["title"]);
    $color            = trim($_POST["color"]);
    $mrp              = trim($_POST["mrp"]);
    $erp              = trim($_POST["erp"]);


        $count  = $_POST["items"];
        $mvouch = $qvouch;
        
        mysql_query("DELETE FROM `prodtran` WHERE code='$mvouch'") or die(mysql_error());

        for ($i = 0; $i<$count; $i++){
             $msrno         = $_POST["srno_$i"];
             $mtitle         = $_POST["title_$i"];
             $mdescrip      = $_POST["descrip_$i"];

             if(!empty($msrno)){
                 mysql_query("INSERT INTO `prodtran`(code, srno, `title`, description)
                                              VALUES('$mvouch', '$msrno', '$mtitle', '$mdescrip')") or die(mysql_error());
             }
        }

    $small ="img/small/";
    $large ="img/large/";
    if(!empty($_FILES['file']) && !empty($_FILES['file2'])){
       move_uploaded_file($_FILES["file"]["tmp_name"], $small . $_FILES["file"]["name"]);
       $smallimg = $small . $_FILES["file"]["name"];
       move_uploaded_file($_FILES["file2"]["tmp_name"], $large . $_FILES["file2"]["name"]);
       $largeimg = $large . $_FILES["file2"]["name"];
       
    }
    if ($a == 1) {
        if ($addflag == 1) {
            mysql_query("INSERT INTO `prodmain`(code, type, `company`, `brand`, `category`, `subcategory`, `title`, `color`, mrp,
                                                erp, smallimg, largeimg)
                                          VALUES($qvouch, '$type', '$company', '$brand', '$category','$subcategory','$title', '$color','$mrp',
                                                 '$erp', '$smallimg', '$largeimg')") or die(mysql_error());
            insmess();
             
            header("refresh: 1; add_products.php?mode=true");
    }else{
          $mvouch = $qvouch;
            mysql_query("UPDATE `prodmain` SET `type`='$type', `company`='$company', `brand`='$brand', `category`='$category', `subcategory`='$subcategory',
                                               `title`='$title', `color`='$color', mrp='$mrp', erp='$erp', `smallimg`='$smallimg', largeimg='$largeimg'
                                                WHERE code = '$mvouch' ") or die(mysql_error());
            updmess();
            header("refresh: 1; add_products.php?vouchno=$mvouch");
        }
    }
}

if ($addflag == 0) {
    $getvouch = $_GET["vouchno"];
    $result = mysql_query("SELECT *  FROM `prodmain` WHERE code='$getvouch'") or die(mysql_error());
    $get = mysql_fetch_array($result);
   
    $xtype     = mysql_query("SELECT * FROM `prodtype` WHERE `code`= '$get[type]'")or die (mysql_error());
    $mtype     = mysql_fetch_array($xtype);
   
    $xcomp     = mysql_query("SELECT * FROM `company` WHERE `code`= '$get[company]'")or die (mysql_error());
    $mcomp     = mysql_fetch_array($xcomp);
   
    $xbrand     = mysql_query("SELECT * FROM `brand` WHERE `code`= '$get[brand]'")or die (mysql_error());
    $mbrand     = mysql_fetch_array($xbrand);
   
    $xcat     = mysql_query("SELECT * FROM `cycle_category` WHERE `code`= '$get[category]'")or die (mysql_error());
    $mcat     = mysql_fetch_array($xcat);
   
    $xsubcat     = mysql_query("SELECT * FROM `subcat` WHERE `code`= '$get[subcategory]'")or die (mysql_error());
    $msubcat     = mysql_fetch_array($xsubcat);
   
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
    
    <head>
        <meta charset="UTF-8">
        <title><?=$formname?></title>
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
        <script type="text/javascript">
            function keyPressed(evt)
            {
                var theEvent = evt || window.event;
                var k = theEvent.keyCode || theEvent.which;
                if (k == 89 || k == 78 || k == 8 || k == 46)
                    return true;
                else {
                    $.msgbox("Invalid Key. Press Y / N ");
                    // alert("Your Message");
                    evt.preventDefault();
                    return false;
                }
            }
        </script>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#data').on('keyup', '.qty, .rate, .amt', calculateRow);
                $('#data').on('blur', '.desc', addrows);

                  function addrows(){    
        
                   var ctr = $('#items').val();
                    $.post('prod_row.php', {ctr: ctr}, function(data) {
                        $(data).appendTo('#data');
                        ctr++;
                        $('#items').val(ctr);
                    });
                }

                $('#addnew').click(function() {
                       addrows();
                });
                $("#freight").keyup(function() {
                    var value  = parseFloat($("#total").val());
                    var value2 = parseFloat($("#freight").val());
                    var tot = value + value2;
                    $('#billamt').val(tot.toFixed(2));
                });
                $("#taxes").keyup(function() {
                    var value  = parseFloat($("#total").val());
                    var value2 = parseFloat($("#taxes").val());
                    var value3 = parseFloat($("#freight").val());
                    var tot = value + value2 + value3;
                    $('#billamt').val(tot.toFixed(2));
                });
           /*     $("#taxes").keyup(function() {
                    var value  = parseFloat($("#billamt").val());
                    var value2 = parseFloat($("#taxes").val());
                    var value3 = parseFloat($("#freight").val());
                    console.log(value);
                    var tot = value + value2 + value3;
                    $('#billamt').val(tot.toFixed(2));
                });*/


               function calculateTot() {
                     var amt    = 0;
                     var tdisc  = 0;
                     var tvat   = 0;
                     var tst    = 0;
                     var bill   = 0;
                     var val = 0;
                     /*********Total Part************/
                     
                    $(".amt").each(function() {
                        if (!isNaN(this.value) && this.value.length != 0) {
                            val += parseFloat(this.value);
                        }
                    });
                    amt = val.toFixed(2);
                    $("#total").val(amt);
                    $("#billamt").val(amt);
                
               }
                function calculateRow() {
                    var cost = 0;
                    var $row = $(this).closest("tr");
                 
                    var qty = $row.find('.qty').val();
                    var rate = parseFloat($row.find('.rate').val());
               
                    var cost = qty * rate;
                    if (isNaN(cost)) {
                        $row.find('.amt').val("0");
                    } else {
                        $row.find('.amt').val(cost.toFixed(1));
                    }
                    calculateTot();
                }
            });


        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#lessamt").keyup(function() {
                    var value = parseFloat($("#billamt").val());
                    var value2 = parseFloat($("#lessamt").val());
                    //var newValue = parseInt(value) - parseInt(value2);
                    //alert('newValue');
                    $('#finamt').val(value - value2).toFixed(2);
                });

            });
        </script>
        <style>
          /*  input[type='text']{
                border-radius: 5px;
                height: 20px;
                border: 1px solid #ccc;
            }
            #data td{
                height:10px;
            }*/
        </style>

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
                    <li><a href="#">Link</a></li>
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
              <input type="hidden" size="6" maxlength="6" id="mvouch" maxlength="6" name="mvouch" value="<?php echo ($addflag == 0) ? $get['vouchno'] : $qvouch; ?>" />      
              <div class="form-group">
                <label class="control-label col-lg-4">Product No.</label>
                   <div class="col-lg-8"> 
                      <input type="text" size="6"  id="vouchno" name="vouchno" value="<?php echo ($addflag == 0) ? $_GET['vouchno'] : $qvouch; ?>"  class="form-control" disabled />
                   </div> 
              </div> 
              <div class="form-group">
                <label class="control-label col-lg-4">Type</label>
                   <div class="col-lg-8"> 
                       <select class='form-control' name='type'>
                            <option value="<?php echo ($addflag == 0) ? $mtype['code'] : ""; ?>"><?php echo ($addflag == 0) ? $mtype['name'] : ""; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `prodtype`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value='$trow[code]'>$trow[name]</option>";
                            }
                            ?>
                       </select>
                      </div>
                    </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Company</label>
                   <div class="col-lg-8">
                       <select class='form-control' name='company'>
                            <option value="<?php echo ($addflag == 0) ? $mcomp['code'] : ""; ?>"><?php echo ($addflag == 0) ? $mcomp['name'] : ""; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `company`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value='$trow[code]'>$trow[name]</option>";
                            }
                            ?>
                       </select>
                   </div>
                </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Brand</label>
                   <div class="col-lg-8">
                       <select class='form-control' name='brand'>
                            <option value="<?php echo ($addflag == 0) ? $mbrand['code'] : ""; ?>"><?php echo ($addflag == 0) ? $mbrand['name'] : ""; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `brand`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value='$trow[code]'>$trow[name]</option>";
                            }
                            ?>
                       </select>

                   </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Category</label>
                   <div class="col-lg-8">
                       <select class='form-control' name='category'>
                            <option value="<?php echo ($addflag == 0) ? $mcat['code'] : ""; ?>"><?php echo ($addflag == 0) ? $mcat['name'] : ""; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `cycle_category`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value='$trow[code]'>$trow[name]</option>";
                            }
                            ?>
                       </select>
                   </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Sub Category</label>
                    <div class="col-lg-8">
                       <select class='form-control' name='subcategory'>
                            <option value="<?php echo ($addflag == 0) ? $msubcat['code'] : ""; ?>"><?php echo ($addflag == 0) ? $msubcat['name'] : ""; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `subcat`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value='$trow[code]'>$trow[name]</option>";
                            }
                            ?>
                       </select>
                      
                    </div> 
                    </div> 
              <div class="form-group">
                <label class="control-label col-lg-4">Title</label>
                    <div class="col-lg-8">
                        <input type="text"  id="orddt" name="title" value="<?php echo ($addflag == 0) ? $get['title'] : ""; ?>" class="form-control" />
                    </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Color</label>
                    <div class="col-lg-8">
                        <input type="text"  id="orddt" name="color" value="<?php echo ($addflag == 0) ? $get['color'] : ""; ?>" class="form-control" />
                    </div>
              </div>
                      
              <div class="form-group">
                <label class="control-label col-lg-4">M.R.P</label>
                    <div class="col-lg-8">
                        <input type="text"  id="orddt" name="mrp" value="<?php echo ($addflag == 0) ? $get['mrp'] : ""; ?>" class="form-control" />
                    </div>
                    </div>
              <div class="form-group">
                <label class="control-label col-lg-4">E.R.P</label>
                <div class="col-lg-8">
                        <input type="text"  id="orddt" name="erp" value="<?php echo ($addflag == 0) ? $get['erp'] : ""; ?>" class="form-control" />
                  </div>      
                  </div>      
              <div class="form-group">
                <label class="control-label col-lg-4">Small Image</label>
                    <div class="col-lg-8">    
                      <input type='file' name='file' class='form-control'>
                    </div>   
                     </div>   
              <div class="form-group">
                <label class="control-label col-lg-4">Large Image</label>
                <div class="col-lg-8">
                      <input type='file' name='file2' class='form-control'>
                    </div>
                </div>
           </div>
    </div>
</div>        
</div>        

    <div class="col-lg-6" style='width:65%;float:right;'>
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Detail.</h5>
            <!-- .toolbar -->
            <div class="toolbar">
                <ul class="nav">
  
                    <li><input type='submit' name='submit' value='Save' class="btn btn-primary"></li>
                    <li><input type='button' name='exit' class='btn btn-danger' value='Exit' onClick="window.location.href='<?=$grid?>'"></li>
                    

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
                <div style="max-height:300px;overflow: auto; border: 0px solid;">
                <div style="float:left; margin-right:-8220000px;">   
            <table id="data" border="1px" width="80%">

                <tr>
                    <td width="10px" align="center"> <label class="control-label">Sr No.</label></td>
                    <td width="180px" align="center"><label class="control-label">Title</label></td>
                    <td width="90px" align="center"><label class="control-label">Description</label></td>
                </tr>
                <?php
                   if ($addflag == 0) {
                    $qry = mysql_query("SELECT * FROM  `prodtran` WHERE code='$getvouch' ORDER BY srno") or die(mysql_error());

                    $ctr = 0;
                    while ($row = mysql_fetch_array($qry)) {
  
                     echo "<tr>";
                        echo "<td align='left'><input type='text' size='3' maxlength='3' name='srno_$ctr' value='$row[srno]' class='sno form-control'/></td>";
                        echo "<td>";
                        echo "<input type='text' size='6'  name='title_$ctr' value='$row[title]'  class='form-control' style='text-align:left'/>";
                        echo "</td>";
                        echo "<td align='center'><textarea name='descrip_$ctr' cols='150' rows='1' class='desc form-control'>$row[description]</textarea></td>";
                    echo "</tr>";
                        $ctr++;
                    }
                    //browse($ctr);
                }else{
                ?>
                    <tr>
                        <td align="center">
                            <input type="text" size="3" maxlength="2" name="srno_0" class="sno form-control" />
                        </td>
         
                        <td align="center"><input type="text" size="6" name="title_0" class="qty form-control" style='text-align:left;'/></td>
                        <td align="center"><textarea name="descrip_0" cols="125" rows='1' class="desc form-control"></textarea></td>

                    </tr>
                <?php } ?>
   </table>
            </div>  
        
    </div>
            <table border='0' width='100%'>
   

        <tr>
            <td width="150px">
                <input type="button" id="addnew" class="btn btn-success btn-lg" name="addnew" value="+" />
                       <input type="hidden" id="items" name="items" value="<?php echo ($addflag == 0) ? $ctr : 1; ?>" />  
              </td><td width="240px"></td><td width="140px"></td><td width="200px" align="right"</td>
            <td width="200px"></td>
        </tr>
       
            </table>
            
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
