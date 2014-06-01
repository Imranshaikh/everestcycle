<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

if(isset($_POST['submit'])){
   
    $count = $_POST['count'];
        for ($i = 0; $i<$count; $i++){
             $order         = $_POST["order_$i"];
             $code          = $_POST["code_$i"];

             if(!empty($order)){
                 mysql_query("UPDATE `category` SET `order`='$order' WHERE code='$code'") or die(mysql_error());
             }
        }
    updmess();
}



   $getmain = mysql_query("SELECT * FROM `category` ORDER BY `order`")or die(mysql_error());



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
                    }
  


?>
        <body>
            <form action=''  name="products" method="POST" enctype="multipart/form-data">

       <div class="row">
                 <div class="col-lg-12">
                <div class="box">
                  <header>
                    <h5><a href='add_category.php?mode=true'><i class='fa fa-edit'></i> Add Category</a></h5>
                    <center></center>
                    <div class="toolbar">
                      <div class="btn-group">
                        <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm minimize-box">
                          <i class="fa fa-angle-up"></i>
                        </a>
                           <input type='submit' name='submit' class='btn btn-default btn-sm btn-primary' value='Save' /> 
                           
                      </div>
                    </div>
                  </header>
                  <div id="sortableTable" class="body collapse in">
                   <table class="table table-bordered sortableTable responsive-table">
                      <thead>
                        <tr>
                          <th>Order By
                            <i class="icon-sort"></i>
                            <i class="icon-sort-down"></i>
                            <i class="icon-sort-up"></i>
                          </th>
                          <th>Name
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
                              $ctr++;
                              echo "<tr>";
                                echo "<td>";
                                 echo "<input type='text' name='order_$ctr' style='width:10%;' value='$row->order' class='form-control'>";
                                echo "</td>";
                                echo "<td>";
                                 echo $row->name;
                                  echo "<input type='hidden' name='code_$ctr' value='$row->code'>";
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='add_category.php?vouchno=".$row->code."'><i class='fa fa-edit' style='font-size:1.3em;color:#228B22;cursor:pointer;'></i></a> &nbsp;&nbsp;&nbsp;";
                                echo "<a href=\"?vouchno=$row->code\" onClick=\"return confirm('Confrim Delete?');\"><i class='fa fa-trash-o' style='font-size:1.3em;color:red;cursor:pointer;'></i></a> ";
                                echo "</td>";
                              echo "</tr>";
                            
                        }
                        
                      ?>
                          <input type='hidden' name='count' value='<?php echo $ctr;?>'>
                      </tbody>
                    </table>
                 </div>
                </div>
              </div>
            </div>
</form>
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
