<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

$formname = "Cateogry";
$file    = 'add_cat.php';
$grid    = 'catmain.php';
$maindb  = 'cycle_category';


 if (isset($_GET["vouchno"])){
     delete("everest", "$maindb", "code", $_GET["vouchno"], "$grid?vouchno=$_GET[vouchno]"); 
         header("refresh: 1; $grid");
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
    
    <head>
        <meta charset="UTF-8">
        <title>Home Page</title>
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


            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                      <h5><a href='<?=$file?>?mode=true'><i class='fa fa-edit'></i> Add <?=$formname?></a></h5>
                  </header>
                  <div id="collapse4" class="body">
                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                          $get = mysql_query("SELECT * FROM `$maindb`")or die(mysql_error());
                           while($row = mysql_fetch_object($get)){
                                 echo "<tr>";
                                  echo "<td>";
                                   echo $row->code;
                                  echo "</td>";
                                  echo "<td>";
                                   echo $row->name;
                                  echo "</td>";
                                echo "<td>";
                                echo "<a href='$file?vouchno=".$row->code."'><i class='fa fa-edit' style='font-size:1.3em;color:#228B22;cursor:pointer;'></i></a> &nbsp;&nbsp;&nbsp;";
                                echo "<a href=\"?vouchno=$row->code\" onClick=\"return confirm('Confrim Delete?');\"><i class='fa fa-trash-o' style='font-size:1.3em;color:red;cursor:pointer;'></i></a> ";
                                echo "</td>";
                                 echo "</tr>";
                               
                           }
                       
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->

            <!--End Datatables-->
            
            
            
            
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