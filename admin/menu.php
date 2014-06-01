<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $project_title;?></title>
        <meta name="msapplication-TileColor" content="#5bc0de"/>
        <meta name="msapplication-TileImage" content="assets/img/metis-tile.png"/>
        
        <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/main.css"/>
        <link rel="stylesheet" href="assets/lib/Font-Awesome/css/font-awesome.css"/>

        <link rel="stylesheet" href="assets/css/theme.css">

        
        <link rel="stylesheet" href="assets/lib/fullcalendar-1.6.2/fullcalendar/fullcalendar.css">
        

        
        
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1669764-16', 'onokumus.com');
  ga('send', 'pageview');

</script>

        <script src="assets/lib/modernizr-build.min.js"></script>
    </head>
    <body >
        <div id="wrap">

            <div id="top">
                <!-- .navbar -->
<nav class="navbar navbar-inverse navbar-static-top">
    <!-- Brand and toggle get grouped for better mobile display -->
    <header class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
      </button>
      
  </header>
    

    <div class="topnav">

        <div class="btn-toolbar">
         <!--  <div class="btn-group">
               <p data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <font style='font-size:15px;'>   Financial Year - <?php echo $_SESSION["tit"];?></font>
         
                   
               </p>
           </div>-->
           <div class="btn-group">
         <!--       <a href='?action=user' data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                    <i class="fa fa-user" style="font-size:20px;"></i>
                    
                </a>-->
                <a href='?action=changepass' data-placement="bottom" data-original-title="Company" data-toggle="tooltip" class="btn btn-default btn-sm">
                    <i class="fa fa-cog" style="font-size:20px;"></i>
                    
                </a>
            </div>
            <div class="btn-group">
                <a href="?action=bck" data-placement="bottom" data-original-title="Backup" data-toggle="tooltip" class="btn btn-default btn-sm">
                    <i class="fa fa-paste" style="font-size:20px;"></i>
                </a>

            </div>
            <div class="btn-group">
                <a href="logout.php" data-placement="bottom" data-original-title="Logout"  data-toggle="tooltip" class="btn btn-metis-1 btn-sm">
		  <i class="fa fa-power-off" style="font-size:20px;"></i>
                </a>
            </div>
        </div>


    </div>



    <!-- /.topnav -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <!-- .nav -->
        <ul class="nav navbar-nav">
            <li class="active"><a href="menu.php"><?php echo $project_title;?></a></li>

            <li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class='fa fa-plus-square-o'></i> Masters</a>
                <ul class="dropdown-menu">
                    <li><a href="?action=company" ><i class="fa fa-edit"></i> Add Company</a></li>
                    <li><a href="?action=brand" ><i class="fa fa-edit"></i> Add Brand ***</a></li>
                    <li><a href="?action=category" ><i class="fa fa-edit"></i>Category </a></li>
                    <li><a href="?action=subcategory" ><i class="fa fa-edit"></i>Sub Category </a></li>
                </ul>
            </li>
            <li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class='fa fa-plus-square-o'></i> Add items     </a>
                <ul class="dropdown-menu">
                    <li><a href="?action=product" ><i class="fa fa-edit"></i> Add Products </a></li>
                    <li><a href="?action=home" ><i class="fa fa-edit"></i> Homepage Slider </a></li>
                    <li><a href="?action=sortcat" ><i class="fa fa-edit"></i> Sort Category </a></li>
                </ul>
            </li>
            <li>
                <a href="?action=list" >
                   <i class='fa fa-list-ol'></i>  List 
                </a>
    
            </li>
            <!--<li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Reports <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Ledger</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Labels</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Daily Reports</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Daily Cash</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Staffwise Sale Summary</a></li>
                    <li><a href="#" onclick="window.open('paidreg.php', 'popupwindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Bank Book</a></li>
                    <li><a href="#" onclick="window.open('paidreg.php', 'popupwindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Cash Book</a></li>
                    <li><a href="#" onclick="window.open('paypend.php', 'popupwindow','height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Expense</a></li>
                    <li><a href="#" onclick="window.open('paypend.php', 'popupwindow','height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Outstandings Receivable</a></li>
                    <li><a href="#" onclick="window.open('paypend.php', 'popupwindow','height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Outstandings Payable</a></li>
                    <li><a href="#" onclick="window.open('paypend.php', 'popupwindow','height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Daily Transactions</a></li>
                    <li><a href="#" onclick="window.open('paypend.php', 'popupwindow','height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">G.R Query</a></li>
                    <li><a href="#" onclick="window.open('mainstat.php', 'popupwindow','height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Stock</a></li>
                </ul>
            </li>
            <li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Registers <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Purchase</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Sale</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Debit Note</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Credit Note</a></li>
                </ul>
            </li>
            <li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Finalizations <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Closing Stocks</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Trial Balance</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Profit / Loss</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Profit Sharing</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Balance Sheet</a></li>
                </ul>
            </li>
            <li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Tools <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Year Selection</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Year End</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Year Creation</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Graph</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Change Of Staff</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Copy to File</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Copy to Folder</a></li>
                    <li><a href="#" onclick="window.open('billreg.php', 'popUpWindow', 'height=600,width=970,left=20,top=20, resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Update Daily</a></li>

                </ul>
            </li>-->
        </ul>
    </div>
</nav>
 </div>
  

            <div id="content">
                <div class="outer" style='width:100%;' >
                    <div class="inner">
                      <?php
               $src = "";
               $action = isset($_GET["action"]) ? $_GET["action"] : "";
               switch ($action){
                   case "company";
                       $head = "Add Company";
                       $src ="compmain.php";
                       break;
                   
                   case "brand";
                       $head = "Add Brand";
                       $src ="brandmain.php";
                       break;
                   
                   case "category";
                       $head = "Add Category";
                       $src ="catmain.php";
                       break;
                   
                   case "subcategory";
                       $head = "Add Sub Category";
                       $src ="subcatmain.php";
                       break;
                   
                   case "product";
                       $head = "Add Products";
                       $src ="prodmain.php";
                       break;
                   
                   case "list";
                       $head = "Product List";
                       $src ="prodlst.php";
                       break;
                   
                   case "list";
                       $head = "Product List";
                       $src ="prodlst.php";
                       break;
                   
                   case "home";
                       $head = "Home Page";
                       $src ="homemain.php";
                       break;
                   
                   case "sortcat";
                       $head = "Sort Category";
                       $src ="sort_cat.php";
                       break;
                   

                   default :
                        $head = "Home";
                        $src = "default.php";
               }
        ?>
                 <!--<h4><?php //echo $head; ?></h4>-->
                     <!--<iframe src="<?php/* echo $src; */ ?>" width="1300" height="900" frameBorder="0"></iframe>-->
                     <iframe src="<?php echo $src;  ?>" style="width: 100%; height: 900px;"  frameBorder="0"></iframe>

                    </div>
                    <!-- end .inner -->
                </div>
                <!-- end .outer -->
            </div>
            <!-- end #content -->

            

        </div>
        <!-- /#wrap -->


        <div id="footer">
            <p>2013 &copy; Raj Computers</p>
        </div>


        <!-- #helpModal -->        
        <div id="helpModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
		<p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
	      </div>
	      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->        
        <!-- /#helpModal -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/lib/jquery.min.js"><\/script>')</script> 




        <script src="assets/lib/bootstrap/js/bootstrap.js"></script>





     <!--   <script type="text/javascript" src="assets/js/style-switcher.js"></script>-->


        
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        

        
        <script src="assets/lib/fullcalendar-1.6.2/fullcalendar/fullcalendar.min.js"></script>
<script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
<script src="assets/lib/sparkline/jquery.sparkline.min.js"></script>
<script src="assets/lib/flot/jquery.flot.js"></script>
<script src="assets/lib/flot/jquery.flot.selection.js"></script>
<script src="assets/lib/flot/jquery.flot.resize.js"></script>
        

        <script src="assets/js/main.js"></script>

        
        <script>
            $(function() { dashboard(); });
        </script>
        

    </body>
</html>
