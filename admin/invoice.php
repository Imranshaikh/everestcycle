<?php

require("includes/check_auth_user.php");
require("includes/dbconnect.php");
include ('includes/function.php');

$zdb = $_SESSION["zdbyear_bmexp"];


mysql_select_db($zdb);

if (isset($_GET["mode"]) == "true") {
    $addflag = 1;
    $gen1 = mysql_query("SELECT MAX(vouchno) AS maxcode FROM `salemain` LIMIT 0,1 ") or die(mysql_error());
    if (mysql_num_rows($gen1) > 0) {
        $vvouch = mysql_fetch_assoc($gen1);
        $qvouch = $vvouch["maxcode"] + 1;
    } else {
        $qvouch = '1';
    }
} else {
    $addflag = 0;
    $qvouch = $_GET["vouchno"];
}


if (isset($_POST["submit"])) {
    $a = 1;
    $invno       = trim($_POST["invno"]);
    $invdt       = trim($_POST["invdt"]);
    $ordno       = trim($_POST["ordno"]);
    $orddt       = trim($_POST["orddt"]);
    $party       = trim($_POST["cmbparty"]);
    $vessel      = trim($_POST["vessel"]);
    $pol         = trim($_POST["cmbpol"]);
    $pod         = trim($_POST["cmbpod"]);
    $find        = trim($_POST["cmbfin_d"]);
    $country     = trim($_POST["country"]);
    $subtot      = trim($_POST["total"]);
    $freight     = trim($_POST["freight"]);
    $taxes       = trim($_POST["taxes"]);
    $totst       = trim($_POST["totst"]);
    $billamt     = trim($_POST["billamt"]);
    $flight      = trim($_POST["flight"]);

    $rem1 = mysql_real_escape_string($_POST["rem1"]);
    $rem2 = mysql_real_escape_string($_POST["rem2"]);

    $count  = $_POST["items"];
        $mvouch = $qvouch;
        mysql_query("DELETE FROM `saletran` WHERE vouchno='$mvouch'") or die(mysql_error());
 //bro0wse($count);
    
    for ($i = 0; $i<$count; $i++){
        $msrno         = $_POST["srno_$i"];
        $mitem         = $_POST["item_$i"];
        $mqty          = $_POST["qty_$i"];
        $munit         = $_POST["unit_$i"];
        $mrate         = $_POST["rate_$i"];
        $mamt          = $_POST["amt_$i"];
        $mmarks        = $_POST["marks_$i"];
        $mdescrip      = $_POST["descrip_$i"];

        browse($mmarks);
        
             mysql_query("INSERT INTO `saletran`(vouchno, srno, item, qty, unit, rate, amt, marks, descrip)
                         VALUES('$mvouch', '$msrno', '$mitem', '$mqty', '$munit', '$mrate', '$mamt', '$mmarks', '$mdescrip')") or die(mysql_error());

    
             
    }

    
    if ($a == 1) {
        if ($addflag == 1) {
            mysql_query("INSERT INTO `salemain`(vouchno, `invdate`, partyname, vessel, invoice, orderno, orddate, portofloading, portofdischarge,
                                                finaldestination, country, total, freight, taxes, billamt, flight, `rem1`, `rem2`)
                                          VALUES($qvouch, '$invdt', '$party', '$vessel', '$invno','$ordno','$orddt', '$pol','$pod',
                                                 '$find', '$country', '$subtot', '$freight', '$taxes', '$billamt', '$flight', '$rem1', '$rem2')") or die(mysql_error());
            insmess();

            header("refresh: 1; invoice.php?mode=true");
    }else{
            $mvouch = $qvouch;
            mysql_query("UPDATE `salemain` SET `invdate`='$invdt', partyname='$party', vessel='$vessel', invoice='$invno', orderno='$ordno', `orddate`='$orddt',
                                                country='$country', portofloading='$pol', portofdischarge='$pod', finaldestination='$find', total='$subtot', freight='$freight',
                                                taxes='$taxes', billamt='$billamt', flight='$flight', `rem1`='$rem1', `rem2`='$rem2' WHERE vouchno = '$mvouch' ") or die(mysql_error());
            updmess();
            header("refresh: 1; invoice.php?vouchno=$mvouch");
        }
    }
}

if ($addflag == 0) {
    $getvouch = $_GET["vouchno"];
    $result = mysql_query("SELECT *, DATE_FORMAT(`invdate`, '%d-%m-%Y') as mydt,
                           DATE_FORMAT(`orddate`, '%d-%m-%Y') as orddt FROM `salemain`
                           WHERE vouchno='$getvouch'") or die(mysql_error());
    $get = mysql_fetch_array($result);
   
    $getpname =  mysql_query("SELECT * FROM `accmast` WHERE `accode`= '$get[partyname]'")or die (mysql_error());
    $getp     =  mysql_fetch_array($getpname);

    $getpol =  mysql_query("SELECT * FROM `port` WHERE `code`= '$get[portofloading]'")or die (mysql_error());
    $mpol   =  mysql_fetch_array($getpol);

    $getpod =  mysql_query("SELECT * FROM `port` WHERE `code`= '$get[portofdischarge]'")or die (mysql_error());
    $mpod   =  mysql_fetch_array($getpod);

    $findes    = mysql_query("SELECT * FROM `place` WHERE `code`= '$get[finaldestination]'")or die (mysql_error());
    $mfindes   = mysql_fetch_array($findes);

    $country    = mysql_query("SELECT * FROM `country` WHERE `code`= '$get[country]'")or die (mysql_error());
    $mcountry   = mysql_fetch_array($country);
   
    $vessel     = mysql_query("SELECT * FROM `vessel` WHERE `code`= '$get[vessel]'")or die (mysql_error());
    $getves     = mysql_fetch_array($vessel);
   
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
    
    <head>
        <meta charset="UTF-8">
        <title>Export Invoice</title>
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
        <script type="text/javascript" src="js/jquery.js"></script>
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
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#data').on('keyup', '.qty, .rate, .amt', calculateRow);
                $('#data').on('blur', '.desc', addrows);

                  function addrows(){    
        
                   var ctr = $('#items').val();
                    $.post('invoice_add.php', {ctr: ctr}, function(data) {
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
        <form action=''  name="invoice" method="POST">
<div class="row">
<div class="col-lg-6" style='width:30%;float:left;'>
    <div class="box dark">
        <header>
            <div class="icons"><i class="fa fa-edit"></i></div>
            <h5>Export Invoice</h5>
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
                <label class="control-label col-lg-4">Voucher No.</label>
                   <div class="col-lg-8"> 
                      <input type="text" size="6" maxlength="6" id="vouchno" name="vouchno" value="<?php echo ($addflag == 0) ? $get['vouchno'] : $qvouch; ?>"  class="form-control" disabled />
                   </div> 
              </div> 
              <div class="form-group">
                <label class="control-label col-lg-4">Party Name</label>
                   <div class="col-lg-8"> 
                        <select data-placeholder="Party" name="cmbparty" class="form-control">
                            <option value="<?php echo ($addflag == 0) ? $getp['accode'] : " "; ?>"><?php echo ($addflag == 0) ? $getp['name'] : " "; ?></option>
                            <?php
                            $mown = mysql_query("SELECT accode, `name` FROM `accmast` WHERE grpcode='010'") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value=$trow[accode]>$trow[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Vessel</label>
                   <div class="col-lg-8">
                       <!--<input type='text' name='vessel' value='<?php echo ($addflag == 0) ? $get['vessel'] : " "; ?>' class="form-control" />-->
                        <select data-placeholder="Vessel" name="vessel" class="form-control">
                            <option value="<?php echo ($addflag == 0) ? $getves['code'] : " "; ?>"><?php echo ($addflag == 0) ? $getves['name'] : " "; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `vessel`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value=$trow[code]>$trow[name]</option>";
                            }
                            ?>
                        </select>

                   </div>
                </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Invoice No.</label>
                   <div class="col-lg-8">
                    <input type="text" size="6" maxlength="6" id="invno" name="invno" value="<?php echo ($addflag == 0) ? $get['invoice'] :" "; ?>"  class="form-control" />
                   </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Invoice Date.</label>
                   <div class="col-lg-8">
                        <input type="date" size="" id="invdt" name="invdt" value="<?php echo ($addflag == 0) ? $get['invdate'] : ""; ?>" class="form-control" />
                   </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Order No.</label>
                    <div class="col-lg-8">
                      <input type="text" size="6" maxlength="6" id="ordno" name="ordno" value="<?php echo ($addflag == 0) ? $get['orderno'] : " "; ?>" class="form-control"/>
                    </div> 
                    </div> 
              <div class="form-group">
                <label class="control-label col-lg-4">Order Date.</label>
                    <div class="col-lg-8">
                        <input type="date" size="" id="orddt" name="orddt" value="<?php echo ($addflag == 0) ? $get['orddt'] : ""; ?>" class="form-control" />
                    </div>
              </div>
                      
              <div class="form-group">
                <label class="control-label col-lg-4">Port of Loading</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Port of Loading"  name="cmbpol"  class="form-control" >
                            <option value="<?php echo ($addflag == 0) ? $mpol['code'] : " "; ?>"><?php echo ($addflag == 0) ? $mpol['name'] : " "; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `port`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value=$trow[code]>$trow[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Port of Discharge</label>
                <div class="col-lg-8">
                        <select data-placeholder="Port of Discharge"  name="cmbpod"  class="form-control"  >
                            <option value="<?php echo ($addflag == 0) ? $mpod['code'] : " "; ?>"><?php echo ($addflag == 0) ? $mpod['name'] : " "; ?></option>
                            <?php
                            $cown = mysql_query("SELECT code, `name` FROM `port`") or die(mysql_error());
                            while ($crow = mysql_fetch_array($cown)) {
                                echo "<option value=$crow[code]>$crow[name]</option>";
                            }
                            ?>
                        </select>
                  </div>      
                  </div>      
              <div class="form-group">
                <label class="control-label col-lg-4">Final Destination</label>
                    <div class="col-lg-8">    
                        <select data-placeholder="Final Destination"  name="cmbfin_d"  class="form-control"  >
                            <option value="<?php echo ($addflag == 0) ? $mfindes['code'] : " "; ?>"><?php echo ($addflag == 0) ? $mfindes['name'] : " "; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `place`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value=$trow[code]>$trow[name]</option>";
                            }
                            ?>
                        </select>
                     </div>   
                     </div>   
              <div class="form-group">
                <label class="control-label col-lg-4">Country</label>
                <div class="col-lg-8">
					     <select placeholder="Country"  name="country"  class="form-control"  >
                            <option value="<?php echo ($addflag == 0) ? $mcountry['code'] : " "; ?>"><?php echo ($addflag == 0) ? $mcountry['name'] : " "; ?></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `country`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value=$trow[code]>$trow[name]</option>";
                            }
                            ?>
                        </select>
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
            <h5>Invoice Detail.</h5>
            <!-- .toolbar -->
            <div class="toolbar">
                <ul class="nav">
                    <li>
                      <?php
                       if($addflag == 0){
                            echo '<input class="btn btn-primary" type="button" id="submit" name="print" value="Custom Invoice" onclick="window.open(\'bmtcustinv_prin.php?vouchno=' . $getvouch . '\',\'popUpWindow\',\'height=800,width=950,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" style="width:130px;"/>';
                       }
                           ?>

                    </li>
                    <li>
                        <?php
                        if ($addflag == 0) {
                           echo '<input class="btn btn-primary" type="button" id="submit" name="print" value="Packing List" onclick="window.open(\'packinglist.php?vouchno=' . $getvouch . '\',\'popUpWindow\',\'height=800,width=950,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" style="width:130px;"/>';                        
					   }
                        ?>                        
                    </li>
                    <li>
                     <?php
                        if ($addflag == 0) {
                            echo '<input class="btn btn-primary" type="button" id="submit" name="print" value="Party Invoice" onclick="window.open(\'bmtinvoice_prin.php?vouchno=' . $getvouch . '\',\'popUpWindow\',\'height=800,width=950,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" style="width:130px;"/>';
                        }
                        ?>  
                    </li>
                    <li><input type='submit' name='submit' value='Save' class="btn btn-primary"></li>
                    <li><input type='button' name='exit' value='Exit' class="btn btn-danger" onClick="window.location.href='invoicemain.php'"></li>

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
            <table id="data" border="1px" width="90%">

                <tr>
                    <td width="60px" align="center"> <label class="control-label">Sr No.</label></td>
                    <td width="250px" align="center"><label class="control-label">Item Name</label></td>
                    <td width="90px" align="center"><label class="control-label">Qty</label></td>
                    <td width="50px" align="center"><label class="control-label">Unit</label></td>
                    <td width="100px" align="center"><label class="control-label">Rate</label></td>
                    <td width="120px" align="center"><label class="control-label">Amount</label></td>
                    <td width="200px" align="center"><label class="control-label">Marks& Nos</label></td>
                    <td width="250px" align="center"><label class="control-label">Description</label></td>
                </tr>
                <?php
                   if ($addflag == 0) {
                    $qry = mysql_query("SELECT * FROM  `saletran` WHERE vouchno='$getvouch' ORDER BY srno") or die(mysql_error());

                    $ctr = 0;
                    while ($row = mysql_fetch_array($qry)) {
                         $getitem = mysql_query("SELECT * FROM `item` WHERE code='$row[item]'")or die(mysql_error());
                         $item = mysql_fetch_object($getitem);
                echo "<tr>";
                echo "<td align='left'><input type='text' size='6' maxlength='6' maxlength='6' name='srno_$ctr' value='$row[srno]' class='sno form-control'/></td>";
                echo "<td align='left'>";
                echo "<select placeholder='Item'  name='item_$ctr' class='form-control'>";
                        echo "<option value='$item->code'>$item->name</option>";
                        $mown = mysql_query("SELECT code, `name` FROM `item`") or die(mysql_error());
                        while ($trow = mysql_fetch_array($mown)) {
                               echo "<option value=$trow[code]>$trow[name]</option>";
                        }
                        echo "</select>";
                        echo "</td>";
                        echo "<td>";
                        echo "<input type='text' size='6'  name='qty_$ctr' value='$row[qty]'  class='qty form-control' style='text-align:right'/>";
                        echo "</td>";
                        echo "<td align='center'><input type='text' size='6' name='unit_$ctr'  value='$row[unit]' class='unit form-control'/></td>";
                        echo "<td align='center'><input type='text' size='6' name='rate_$ctr'  value='$row[rate]' class='rate form-control' style='text-align:right'/></td>";
                        echo "<td align='center'><input type='text' size='6' name='amt_$ctr'   value='$row[amt]'  class='amt form-control' style='text-align:right' readonly/></td>";
                        echo "<td align='center'><input type='text' size='6' name='marks_$ctr' value='$row[marks]' class='trip form-control'/></td>";
                        echo "<td align='center'><textarea name='descrip_$ctr' cols='90' rows='1' class='desc form-control'>$row[descrip]</textarea></td>";
                    echo "</tr>";
                        $ctr++;
                    }
                    //browse($ctr);
                }else{
                ?>
                    <tr>
                        <td align="left"><input type="text" size="6" maxlength="6" maxlength="6" name="srno_0" class="sno form-control"/></td>
                        <td align="left">
                            <select data-placeholder="Item"  name="item_0" class="form-control"  >
                                <option value=""></option>
                                <?php
                                    $mown = mysql_query("SELECT code, `name` FROM `item`") or die(mysql_error());
                                    while ($trow = mysql_fetch_array($mown)) {
                                           echo "<option value=$trow[code]>$trow[name]</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td align="center"><input type="text" size="6" maxlength="9" maxlength="6" name="qty_0" class="qty form-control" style='text-align:right'/></td>
                        <td align="left">
                            <input type="text" size="6" maxlength="6" name="unit_0" class="unit form-control"/>
                        </td>
                        <td align="center"><input type="text" size="6" maxlength="9" maxlength="6" name="rate_0" class="rate form-control" style='text-align:right'/></td>
                        <td align="center"><input type="text" size="6" maxlength="9" maxlength="6" name="amt_0" id="amount" class="amt form-control" style='text-align:right' readonly/></td>
                        <td align="center"><input type="text" size="6"  name="marks_0" class="trip form-control"/></td>
                        <td align="center"><textarea name="descrip_0" cols="90" rows='1' class="desc form-control"></textarea></td>

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
</td><td width="240px"></td><td width="140px"></td><td width="200px" align="right"><label for=""><font color="black" size="3px">SubTotal</font><span></span></label></td>
            <td width="200px"><input id="total" type="text" name="total" class="form-control"  value="<?php echo ($addflag == 0) ? $get['total'] : "0.00"; ?>" readonly style='text-align:right'></td>
        </tr>
        <tr>
            <td width="150px"></td><td width="240px"></td><td width="140px"></td><td width="280px" align="right"><label for=""><font color="black" size="3px">Freight</font><span></span></label></td>
            <td><input id="freight" type="text" name="freight" class="form-control"  value="<?php echo ($addflag == 0) ? $get['freight'] : "0.00"; ?>"style='text-align:right'></td>
        </tr>
               
        <tr>
            <td width="150px"></td><td width="240px"></td><td width="140px"></td><td width="280px" align="right"><label for=""><font color="black" size="3px">Taxes</font><span></span></label></td>
            <td><input id="taxes" type="text" name="taxes" class="form-control"  value="<?php echo ($addflag == 0) ? $get['taxes'] : "0.00"; ?>"style='text-align:right'></td>
        </tr>
        <tr>
            <td width="150px"></td><td width="240px"></td><td width="140px"></td><td width="400px" align="right"><label for=""><font color="009900" size="3px">Bill Amount (Rs.)</font><span></span></label></td>
            <td><input id="billamt" type="text" name="billamt" class="form-control"  value="<?php echo ($addflag == 0) ? $get['billamt'] : "0.00"; ?>" readonly style='text-align:right'></td>
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
