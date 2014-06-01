<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

if(isset($_GET["del"])){
    $msg = "<font color='green'><b>Record Deleted Sucessfully</b></font>";
    
}

//if(isset($_POST["submit"])){
    $tcond    = '';
    $cocond   = '';
    $bcond    = '';
    $catcond  = '';
    $scond    = '';
    
    if(!empty($_POST['type'])){
        $tcond = "AND type = '".$_POST['type']."'";
        
    }
    if(!empty($_POST['company'])){
        $cocond = "AND `company` = '".mysql_real_escape_string(trim($_POST['company']))."'";
        
    }
    if(!empty($_POST['brand'])){
        $bcond = "AND `brand` = '".mysql_real_escape_string(trim($_POST['brand']))."'";
        
    }
    if(!empty($_POST['category'])){
        $catcond = "AND `category` = '".mysql_real_escape_string(trim($_POST['category']))."'";
        
    }
    if(!empty($_POST['subcategory'])){
        $scond = "AND `subcategory` = '".mysql_real_escape_string(trim($_POST['subcategory']))."'";
        
    }
    
   $getmain = mysql_query("SELECT * FROM `prodmain` WHERE code !='' $tcond $cocond $bcond $catcond $scond")or die(mysql_error());



?>
<!DOCTYPE HTML>
<html lang="en-US">
    
    <head>
        <meta charset="UTF-8">
        <title>Product List</title>
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
<?php
                    if (isset($_GET["vouchno"])){
                       delete("everest", "prodmain", "code", $_GET["vouchno"], "prod_lst.php?vouchno=$_GET[vouchno]"); 
                        $getimgpath  = mysql_query("SELECT `smallimg`, `largeimg` FROM `prodmain` WHERE code = '".mysql_real_escape_string($_GET['vouchno'])."' ")or die(mysql_error());
                        $img         = mysql_fetch_object($getimgpath);
                        $smallimg    = $img->smallimg;
                        $largeimg    = $img->largeimg;
                       if (file_exists($smallimg)){
                           unlink($smallimg);
                          /* if(unlink($smallimg)){
                              browse("Successfully deleted " . $smallimg);
                           }else{
                              browse("Problem deleting " . $smallimg);
                           }*/
                       }
                       if (file_exists($largeimg)){
                           unlink($largeimg);
                        /*   if(unlink($largeimg)){
                              browse("Successfully deleted " . $smallimg);
                           }else{
                              browse("Problem deleting " . $smallimg);
                           }*/
                       }
                        
                        delete("everest", "prodtran", "code", $_GET["vouchno"], "prod_lst.php?del=success");
                        
                    }
  


?>

<div class="row">
                 <div class="col-lg-12">
                <div class="box">
                  <header>
                    <h5>Product List</h5>
                    <center><?php echo $msg;?></center>
                    <div class="toolbar">
                      <div class="btn-group">
                          
                        <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm minimize-box">
                          <i class="fa fa-angle-up"></i>
                        </a>
                           <input type='button' class='btn btn-default btn-sm minimize-box btn-danger' value='Exit' onClick='window.location.href="prodlst.php";'/> 
                      </div>
                    </div>
                  </header>
                  <div id="sortableTable" class="body collapse in">
                    <table class="table table-bordered sortableTable responsive-table">
                      <thead>
                        <tr>
                          <th>Srno
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Type
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Company Name
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Brand
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Category
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Sub Category
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Product Image
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Action
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                         $ctr = 0;
                        while($row = mysql_fetch_object($getmain)){
                              $getype = mysql_query("SELECT `name` FROM `prodtype` WHERE code= '".$row->type."'")or die(mysql_error());
                              $mtype  = mysql_fetch_object($getype);
                              $type   = $mtype->name;
                              $ctr++;
                              $imgpath = $row->smallimg;
                              echo "<tr>";
                                echo "<td>";
                                 echo $ctr;
                                echo "</td>";
                                echo "<td>";
                                 echo $type;
                                echo "</td>";
                                echo "<td>";
                                 echo $row->company;
                                echo "</td>";
                                echo "<td>";
                                 echo $row->brand;
                                echo "</td>";
                                echo "<td>";
                                 echo $row->category;
                                echo "</td>";
                                echo "<td>";
                                 echo $row->subcategory;
                                echo "</td>";
                                echo "<td>";
                                 echo "<img src='".$imgpath."' style='width:180px;height:auto;'>";
                                 echo "<hr/>";
                                 echo "<span style='float:left;'><b>M.R.P -</b> <font color='#1E90FF'><b>".$row->mrp."</b></font></span>";
                                 echo "<span style='float:right;'><b>E.R.P -</b> <font color='green'><b>".$row->erp."</b></font></span>";
                                 
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='add_products.php?vouchno=".$row->code."'><i class='fa fa-edit' style='font-size:1.3em;color:#228B22;cursor:pointer;'></i></a> &nbsp;&nbsp;&nbsp;";
                                echo "<a href=\"?vouchno=$row->code\" onClick=\"return confirm('Confrim Delete?');\"><i class='fa fa-trash-o' style='font-size:1.3em;color:red;cursor:pointer;'></i></a> ";
                                echo "</td>";
                              echo "</tr>";
                            
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- /.col-lg-6 -->
            </div>
    <script src="assets/lib/jquery.min.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="assets/lib/datatables/jquery.dataTables.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>
    <script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/main.min.js"></script>
    <script>
      $(function() {
        metisTable();
        metisSortable();
      });
    </script>
  </body>
</html>
