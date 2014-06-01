<?php
/*
  Place code to connect to your DB here.
 */
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');


$maindb = "prodmain";
$trandb = "prodtran";
$grid = 'prodmain.php';

 if (isset($_GET["vouchno"])){
     delete("everest", "$maindb", "code", $_GET["vouchno"], "$grid?vouchno=$_GET[vouchno]"); 
     delete("everest", "$trandb", "code", $_GET["vouchno"], "$grid"); 
         header("refresh: 1; $grid");
}
?>

<!DOCTYPE HTML>
<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <title>Products</title>
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
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-1669764-16', 'onokumus.com');
            ga('send', 'pageview');

        </script>

        <script src="assets/lib/modernizr-build.min.js"></script>
        <script type="text/javascript" src="../js/jquery.js"></script>

        <?php
        $tbl_name = "prodmain";  //your table name
        // How many adjacent pages should be shown on each side?
        $adjacents = 3;

        /*
          First get total number of rows in data table.
          If you have a WHERE clause in your query, make sure you mirror it here.
         */
        $query = "SELECT COUNT(*) as num FROM $tbl_name";
        $total_pages = mysql_fetch_array(mysql_query($query));
        $total_pages = $total_pages[num];

        /* Setup vars for query. */
        $targetpage = "prodmain.php";  //your file name  (the name of this file)
        $limit = 20;         //how many items to show per page
        $page = $_GET['page'];
        if ($page)
            $start = ($page - 1) * $limit;    //first item to display on this page
        else
            $start = 0;        //if no page var is given, set start to 0

        /* Get data. */
        $sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
        $result = mysql_query($sql);

        /* Setup page vars for display. */
        if ($page == 0)
            $page = 1;     //if no page var is given, default to 1.
        $prev = $page - 1;       //previous page is page - 1
        $next = $page + 1;       //next page is page + 1
        $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;      //last page minus 1

        /*
          Now we apply our rules and draw the pagination object.
          We're actually saving the code to a variable in case we want to draw it more than once.
         */
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<div class=\"pagination\">";
            //previous button
            if ($page > 1)
                $pagination.= "<a href=\"$targetpage?page=$prev\" class='current btn btn-default btn-sm btn-success'> previous</a>";
            else
                $pagination.= "<span class=\"disabled current btn btn-default btn-sm btn-success\"> previous</span>";

            //pages	
            if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current btn btn-default btn-sm btn-primary\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\" class='btn btn-default btn-sm' >$counter</a>";
                }
            }
            elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                    }
                    $pagination.= "...";
                    $pagination.= "<a href=\"$targetpage?page=$lpm1\" class='btn btn-default btn-sm minimize-box'>$lpm1</a>";
                    $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                    $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                    $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\" class='btn btn-default btn-sm minimize-box'>$counter</a>";
                    }
                    $pagination.= "...";
                    $pagination.= "<a href=\"$targetpage?page=$lpm1\" class='btn btn-default btn-sm minimize-box'>$lpm1</a>";
                    $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                }
                //close to end; only hide early pages
                else {
                    $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                    $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                    $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\" class='btn btn-default btn-sm minimize-box'>$counter</a>";
                    }
                }
            }

            //next button
            if ($page < $counter - 1)
                $pagination.= "<a href=\"$targetpage?page=$next\" class='current btn btn-default btn-sm btn-success'>next</a>";
            else
                $pagination.= "<span class=\"disabled current btn btn-default btn-sm btn-success\">next </span>";
            $pagination.= "</div>\n";
        }
        ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <header>
                    <h5><a href='add_products.php?mode=true'><i class="fa fa-edit"> Add New Products</i></a></h5>
                    <center><?php echo $msg; ?></center>
                    <div class="toolbar">
                        <div class="btn-group">

                            <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm minimize-box">
                                <i class="fa fa-angle-up"></i>
                            </a>
                            <input type='button' class='btn btn-default btn-sm minimize-box btn-danger' value='Exit' onClick='window.location.href = "prodlst.php";'/> 
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
                            while ($row = mysql_fetch_object($result)) {
                                $getype = mysql_query("SELECT `name` FROM `prodtype` WHERE code= '" . $row->type . "'") or die(mysql_error());
                                $mtype = mysql_fetch_object($getype);

                                $xcomp = mysql_query("SELECT * FROM `company` WHERE `code`= '$row->company'") or die(mysql_error());
                                $mcomp = mysql_fetch_array($xcomp);

                                $xbrand = mysql_query("SELECT * FROM `brand` WHERE `code`= '$row->brand'") or die(mysql_error());
                                $mbrand = mysql_fetch_array($xbrand);

                                $xcat = mysql_query("SELECT * FROM `cycle_category` WHERE `code`= '$row->category'") or die(mysql_error());
                                $mcat = mysql_fetch_array($xcat);

                                $xsubcat = mysql_query("SELECT * FROM `subcat` WHERE `code`= '$row->subcategory'") or die(mysql_error());
                                $msubcat = mysql_fetch_array($xsubcat);



                                $type = $mtype->name;
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
                                echo $mcomp["name"];
                                echo "</td>";
                                echo "<td>";
                                echo $mbrand["name"];
                                echo "</td>";
                                echo "<td>";
                                echo $mcat["name"];
                                echo "</td>";
                                echo "<td>";
                                echo $msubcat["name"];
                                echo "</td>";
                                echo "<td>";
                                echo "<img src='" . $imgpath . "' style='width:180px;height:auto;'>";
                                echo "<hr/>";
                                echo "<span style='float:left;'><b>M.R.P -</b> <font color='#1E90FF'><b>" . $row->mrp . "</b></font></span>";
                                echo "<span style='float:right;'><b>E.R.P -</b> <font color='green'><b>" . $row->erp . "</b></font></span>";

                                echo "</td>";
                                echo "<td>";
                                echo "<a href='add_products.php?vouchno=" . $row->code . "'><i class='fa fa-edit' style='font-size:1.3em;color:#228B22;cursor:pointer;'></i></a> &nbsp;&nbsp;&nbsp;";
                                echo "<a href=\"?vouchno=$row->code\" onClick=\"return confirm('Confrim Delete?');\"><i class='fa fa-trash-o' style='font-size:1.3em;color:red;cursor:pointer;'></i></a> ";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            ?>

                            <?= $pagination ?>
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
