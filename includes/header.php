<?php
include('includes/dbconnect.php');
include('includes/function.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Everest Cycle</title><link rel="shortcut icon" href="saz.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/prettyPhoto/css/prettyPhoto.css">
        <link rel="stylesheet" href="assets/css/flexslider.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <!--<link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">-->
<!--start accordian at product grid-->
   <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
   <script src="js/vallenato.js" type="text/javascript"></script>
   <link rel="stylesheet" href="css/vallenato.css" type="text/css" media="screen">
<!--end accordian at product grid-->
<!--Start Price Range
    <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script> 
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
-->
    <script type="text/javascript">
/*$(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000,
      values: [ <?php echo $min; ?>, <?php echo $max; ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });*/
</script>
<script type="text/javascript" src="js/jquery.simplyscroll.js"></script>
<link rel="stylesheet" href="css/jquery.simplyscroll.css" media="all" type="text/css">

    <script type="text/javascript">
(function($) {
	$(function() {
		$("#scroller").simplyScroll();
	});
})(jQuery);
</script>
    
<!--END Price Range-->

<!--STartc Slide--->
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
<!--ENDc Slide--->
<!--FORCAPTION-->
        <link rel="stylesheet" type="text/css" href="css/caption.css" />
        <script src="js/modernizr.custom.97074.js"></script>
	<noscript><link rel="stylesheet" type="text/css" href="css/noJS.css"/></noscript>

<!--END CAPTION-->
<!--Start Product grid-->
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<!--End Product grid-->
    </head>

    <body>

        <!-- Header -->
        <div class="container">
            <div class="header row">
                <div class="span12">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <h1>
                                <a class="brand" href="index.php">Everest cycle</a>
                            </h1>
                    
                            <div class="nav-collapse collapse">
                                <ul class="nav pull-right">
                                    <!--<li class="current-page">
                                        <a href="index.php"><i class="icon-home"></i>Home</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-tasks"></i>Services</a>
                                    </li>-->
                                    <li>
                                        <a href="about.php"><i class="icon-user"></i>About Us</a>
                                    </li>
                                    <li>
                                        <a href="products.php"><i class="icon-align-justify"></i>Products</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-sitemap"></i>Branches</a>
                                    </li>
                                    <li>
                                        <a href="contact.php"><i class="icon-envelope"></i>Contact</a>
                                    </li>
                                </ul>
                                        
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
