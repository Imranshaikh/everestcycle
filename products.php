<?php
include("includes/dbconnect.php");
include("includes/function.php");

############ MAIN QUERY #########################
$maindb = "prodmain";
$qry = mysql_query("SELECT * FROM `$maindb`")or die(mysql_error());

$num = mysql_num_rows($qry);

#browse($num);

include("includes/site_header.php");
?>

            <!-- End Site Header --> 
            <!-- Start Nav Backed Header -->
            <div class="nav-backed-header parallax" style="background-image:url(banner.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Nav Backed Header --> 
            <!-- Start Page Header -->
            <!--<div class="page-header">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    
                  </div>
                </div>
              </div>
            </div>-->
            <div class="notice-bar">
                <div class="container">
                    <div class="row">
                     <!-- <div class="col-md-3 col-sm-6 col-xs-6 notice-bar-title"> <span class="notice-bar-title-icon hidden-xs"><i class="fa fa-calendar fa-3x"></i></span> <span class="title-note">Next</span> <strong>Upcoming Event</strong> </div>
                      <div class="col-md-3 col-sm-6 col-xs-6 notice-bar-event-title">
                        <h5><a href="single-event.html">Sountheast Asia Meet</a></h5>
                        <span class="meta-data">13th July, 2015</span> </div>
                       <div id="counter" class="col-md-4 col-sm-6 col-xs-12 counter" data-date="July 13, 2015">
                        <div class="timer-col"> <span id="days"></span> <span class="timer-type">days</span> </div>
                        <div class="timer-col"> <span id="hours"></span> <span class="timer-type">hrs</span> </div>
                        <div class="timer-col"> <span id="minutes"></span> <span class="timer-type">mins</span> </div>
                        <div class="timer-col"> <span id="seconds"></span> <span class="timer-type">secs</span> </div>
                      </div>
                        -->

                        <ul class="top-navigation hidden-sm hidden-xs" style="float:left;padding: 0px;">
                            <li><a href="#"><img src="brands/1.png" style="width:100px;height:auto;"></a></li>
                            <li><a href="#"><img src="brands/2.png" style="width:100px;height:auto;"></a></li>
                            <li><a href="#"><img src="brands/3.png" style="width:100px;height:auto;"></a></li>
                            <li><a href="#"><img src="brands/4.png" style="width:100px;height:auto;"></a></li>
                            <li><a href="#"><img src="brands/5.png" style="width:100px;height:auto;"></a></li>
                            <li><a href="#"><img src="brands/6.png" style="width:100px;height:auto;"></a></li>
                            <li><a href="#"><img src="brands/7.gif" style="width:100px;height:auto;"></a></li>
                            <li></li>
                        </ul>          
                        <div class="col-md-2 col-sm-6 hidden-xs"> <a href="#" class="btn btn-primary btn-lg btn-block">All Brands</a> </div>  
                    </div>
                </div>
            </div>  
            <!-- End Page Header --> 
            <!-- Start Content -->
            <div class="main" role="main">
         <!--                   <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button>
-->
<!--
<div class="modal fade" id="myModal">
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal'>&times;</button>
		<h3>A Header</h3>
	</div>
	<div class='modal-body'>
		<p>Loading...</p>
	</div>
	<div class='modal-footer'>
		<a href='#' class='btn' data-dismiss='modal'>Close</a>
	</div>
</div>-->
<!--
<div class="modal fade" id="myModal">
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal'>&times;</button>
		<h3>A Header</h3>
	</div>
	<div class='modal-body'>
		<p>Loading...</p>
	</div>
	<div class='modal-footer'>
		<a href='#' class='btn' data-dismiss='modal'>Close</a>
	</div>
</div>-->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Product Description</h4>
                  </div>
                  <div class="modal-body"></div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default inverted" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
                <div id="content" class="content full">
                    <div class="container">
                        <div class="row">
                            <!--    <li class="col-md-3 col-sm-3 grid-item post format-link">
                                    <div class="grid-item-inner"> <a href="http://www.google.com/" target="_blank" class="media-box">
                                            <img src="images/gallery-img4.jpg" alt=""> </a>
                                    
                                    <span style='float:left;color:#007F7B;'>MRP: 350000</span>
                                    <span style='float:right;color:#B22222;'>ERP: 250000</span>
                                    <hr/>
                                    </div>
                                </li>-->


                            <ul class="isotope-grid" data-sort-id="gallery">
                                <?php
                                    while($row = mysql_fetch_object($qry)){
                                          $img = $row->smallimg;
                                          $title = $row->title;
                                        #get_product_detail.php?id=$row->code
                                          echo '<li class="col-md-3 col-sm-3 grid-item post format-link">';  
                                          echo '<div class="grid-item-inner">';
                                          echo "<a href='#' data-target='get_product_detail.php?id=$row->code' data-toggle='modal' data-target='#myModal'  class='media-box'>";
                                          echo "<img src='$img' alt='$title' style=height:137px;width:230px;> </a>";
                                          echo "<span style='float:left;color:#007F7B;'>MRP: 350000</span>";
                                          echo "<span style='float:right;color:#B22222;'>ERP: 250000</span>";
                                          echo "<hr/>";
                                          echo "</div>";
                                          echo "</li>";
                                          
                                    }
                                
                                
                                
                                ?>
                                
                                
                            <!--    <li class="col-md-3 col-sm-3 grid-item post format-image">
                                    <div class="grid-item-inner"> <a href="images/gallery-img1.jpg" data-rel="prettyPhoto" class="media-box"> <img src="images/gallery-img1.jpg" alt=""> </a> </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-image">
                                    <div class="grid-item-inner"> <a href="images/newhere.jpg" data-rel="prettyPhoto" class="media-box"> <img src="images/newhere.jpg" alt=""> </a> </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-gallery">
                                    <div class="grid-item-inner">
                                        <div class="media-box">
                                            <div class="flexslider" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="slide" data-pause="yes">
                                                <ul class="slides">
                                                    <li class="item"><a href="images/gallery-img2.jpg" data-rel="prettyPhoto[postname]"><img src="images/gallery-img2.jpg" alt=""></a></li>
                                                    <li class="item"><a href="images/gallery-img3.jpg" data-rel="prettyPhoto[postname]"><img src="images/gallery-img3.jpg" alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-link">
                                    <div class="grid-item-inner"> <a href="http://www.google.com/" target="_blank" class="media-box">
                                            <img src="images/gallery-img4.jpg" alt=""> </a>
                                    
                                    <span style='float:left;color:#007F7B;'>MRP: 350000</span>
                                    <span style='float:right;color:#B22222;'>ERP: 250000</span>
                                    <hr/>
                                    </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-image">
                                    <div class="grid-item-inner"> <a href="images/sermons.jpg" data-rel="prettyPhoto" class="media-box"> <img src="images/sermons.jpg" alt=""> </a> </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-link">
                                    <div class="grid-item-inner"> <a href="http://www.google.com/" target="_blank" class="media-box"> <img src="images/gallery-img5.jpg" alt=""> </a> </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-video">
                                    <div class="grid-item-inner"> <a href="https://vimeo.com/19564018" data-rel="prettyPhoto" class="media-box"> <img src="images/staff.jpg" alt=""> </a> </div>
                                </li>
                                <li class="col-md-3 col-sm-3 grid-item post format-video">
                                    <div class="grid-item-inner"> <a href="http://youtu.be/NEFfnbQlGo8" data-rel="prettyPhoto" class="media-box"> <img src="images/gallery-img9.jpg" alt=""> </a> </div>
                                </li>-->
                            </ul>
                        </div>
                    <!--    <div class="text-align-center">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
  <!-- Start Footer -->
 <!-- <footer class="site-footer">
    <div class="container">
      <div class="row"> 
        <div class="col-md-4 col-sm-4 widget footer-widget">
          <h4 class="footer-widget-title">About our Church</h4>
          <img src="images/logo.png" alt="Logo">
          <div class="spacer-20"></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis consectetur adipiscing elit. Nulla convallis egestas rhoncus</p>
        </div>
        <div class="col-md-4 col-sm-4 widget footer-widget">
          <h4 class="footer-widget-title">Blogroll</h4>
          <ul>
            <li><a href="index-2.html">Church Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="events.html">All Events</a></li>
            <li><a href="sermons.html">Sermons Archive</a></li>
            <li><a href="blog-masonry.html">Our Blog</a></li>
          </ul>
        </div>
        <div class="col-md-4 col-sm-4 widget footer-widget">
          <h4 class="footer-widget-title">Our Church on twitter</h4>
          <ul class="twitter-widget">
          </ul>
        </div>
      </div>
    </div>
  </footer>-->
  <footer class="site-footer-bottom">
    <div class="container">
      <div class="row">
        <div class="copyrights-col-left col-md-6 col-sm-6">
          <p>&copy; 2014 Everest Cycle. All Rights Reserved</p>
        </div>
        <div class="copyrights-col-right col-md-6 col-sm-6">
          <div class="social-icons"> <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a> <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a> <a href="http://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a> <a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a> <a href="http://www.pinterest.com/" target="_blank"><i class="fa fa-youtube"></i></a> <a href="#"><i class="fa fa-rss"></i></a> </div>
        </div>
      </div>
    </div>
  </footer>
        </div>
        <script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call --> 
        <script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin --> 
        <script src="js/helper-plugins.js"></script> <!-- Plugins --> 
        <script src="js/bootstrap.js"></script> <!-- UI --> 
        <script src="js/waypoints.js"></script> <!-- Waypoints --> 
        <script src="plugins/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements --> 
        <script src="js/init.js"></script> <!-- All Scripts --> 
        <script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider --> 
        <script src="plugins/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer --> 
        <!--<script src="style-switcher/js/jquery_cookie.js"></script> 
        <script src="style-switcher/js/script.js"></script> 
        <!-- Style Switcher Start -->
        <!--<div class="styleswitcher visible-lg visible-md">
          <div class="arrow-box"><a class="switch-button"><span class="fa fa-cogs fa-lg"></span></a> </div>
          <h4>Color Skins</h4>
          <ul class="color-scheme">
            <li><a href="#" data-rel="colors/color1.css" class="color1" title="color1"></a></li>
            <li><a href="#" data-rel="colors/color2.css" class="color2" title="color2"></a></li>
            <li><a href="#" data-rel="colors/color3.css" class="color3" title="color3"></a></li>
            <li><a href="#" data-rel="colors/color4.css" class="color4" title="color4"></a></li>
            <li><a href="#" data-rel="colors/color5.css" class="color5" title="color5"></a></li>
            <li class="nomargin"><a href="#" data-rel="colors/color6.css" class="color6" title="color6"></a></li>
            <li class="nomargin"><a href="#" data-rel="colors/color7.css" class="color7" title="color7"></a></li>
            <li class="nomargin"><a href="#" data-rel="colors/color8.css" class="color8" title="color8"></a></li>
            <li class="nomargin"><a href="#" data-rel="colors/color9.css" class="color9" title="color9"></a></li>
            <li class="nomargin"><a href="#" data-rel="colors/color10.css" class="color10" title="color10"></a></li>
          </ul>
          <h4>Layout</h4>
          <ul class="layouts">
            <li class="wide-layout"><a href="#" title="Wide">Wide</a></li>
            <li class="boxed-layout"><a href="#" title="Boxed">Boxed</a></li>
          </ul>
          <h4>Background Pattern</h4>
          <ul class="background-selector">
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt1.png" data-nr="0" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt2.png" data-nr="1" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt3.png" data-nr="2" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt4.png" data-nr="3" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt5.png" data-nr="4" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt6.png" data-nr="5" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt7.png" data-nr="6" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt8.png" data-nr="7" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt9.png" data-nr="8" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/patterns/pt10.png" data-nr="9" width="20" height="20"></li>
            <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt11.jpg" data-nr="10" width="20" height="20"></li>
            <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt12.jpg" data-nr="11" width="20" height="20"></li>
            <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt13.jpg" data-nr="12" width="20" height="20"></li>
            <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt14.jpg" data-nr="13" width="20" height="20"></li>
            <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt15.jpg" data-nr="14" width="20" height="20"></li>
          </ul>
          <small>*only for boxed layout</small>
          <h4>Background Image</h4>
          <ul class="background-selector1">
            <li><img alt="" src="style-switcher/backgrounds/images/img1-thumb.jpg" data-nr="0" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/images/img2-thumb.jpg" data-nr="1" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/images/img3-thumb.jpg" data-nr="2" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/images/img4-thumb.jpg" data-nr="3" width="20" height="20"></li>
            <li><img alt="" src="style-switcher/backgrounds/images/img5-thumb.jpg" data-nr="4" width="20" height="20"></li>
          </ul>
          <small>*only for boxed layout</small> </div>-->
<script type="text/javascript">
	$("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });

	$(function(){
		// Calling Login Form
	/*	$("#login_form").click(function(){
			$(".social_login").hide();
			$(".user_login").show();
			return false;
		});

		// Calling Register Form
		$("#register_form").click(function(){
			$(".social_login").hide();
			$(".user_register").show();
			$(".header_title").text('Register');
			return false;
		});

		// Going back to Social Forms
		$(".back_btn").click(function(){
			$(".user_login").hide();
			$(".user_register").hide();
			$(".social_login").show();
			$(".header_title").text('Login');
			return false;
		});*/

	})
</script>
        
    </body>
</html>