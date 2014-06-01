<?php
include("includes/site_header.php");


if (isset($_POST['submit']))
  {
  $name     = $_POST['name'];
  $email    = $_POST['email'];
  $subject  = "ENQUIRY FROM EVERESTCYLCE WEBSITE FROM";
  $message  = "NAME - ". $name." PHONE - ".$_POST['phone']." Email -". $email."<br/> ".$_POST['comments'];
  $headers = "From: EVEREST CYCLES <EVERESTCYCLES>" . "\r\n" . "Cc: info@everestcycle.com";

  mail("sales@everestcycle.com", $subject, $message, $headers);
  header("Location: contact.php?success=1");
  }
else
  {
  }
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
  <div class="page-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Contact</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page Header --> 
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <header class="single-post-header clearfix">
              <h2 class="post-title">Our Location</h2>
            </header>
            <div class="post-content">
              <div id="gmap">
<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1885.4009735192612!2d73.00075599485918!3d19.072443500547696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1severest+cycles+vashi!5e0!3m2!1sen!2sin!4v1398179858929" width="600" height="450" frameborder="0" style="border:0"></iframe>              </div>
              <div class="row">
                <form method="post"  name="contactform" class="contact-form" action="">
                    <?php
                        if(isset($_GET["success"])){
                            echo "<font color='green'>Mail Sent Successfully</font>";
                        }
                    
                    ?>
                  <div class="col-md-6 margin-15">
                    <div class="form-group">
                      <input type="text" id="name" name="name"  class="form-control input-lg" placeholder="Name*">
                    </div>
                    <div class="form-group">
                      <input type="email" id="email" name="email"  class="form-control input-lg" placeholder="Email*">
                    </div>
                    <div class="form-group">
                      <input type="text" id="phone" name="phone" class="form-control input-lg" placeholder="Phone">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea cols="6" rows="7" id="comments" name="comments" class="form-control input-lg" placeholder="Message"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <input id="submit" name="submit" type="submit" class="btn btn-primary btn-lg pull-right" value="Submit now!">
                  </div>
                </form>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- Start Sidebar -->
          <div class="col-md-3 sidebar"> 
            <!-- Recent Posts Widget -->
            <div class="widget-recent-posts widget">
              <div class="sidebar-widget-title">
                <h3>We are located at</h3>
              </div>
              <ul>
                <li class="clearfix">
                  <div class="widget-blog-content" style="width:100%;">
                      <a href="#"><?php
                     echo     nl2br("EVEREST CYCLE CO.                  
                                    8-13, SHIV CENTRE, SECTOR-17,
                                    VASHI, NEW MUMBAI. 400703    
                                    2789-8888.");
                        ?>
                      </a> <span class="meta-data"><i class="fa fa-calendar"></i></span> </div>
                </li>
               <!-- <li class="clearfix"> <a href="#" class="media-box post-image"> <img src="images/blog-image1.jpg" alt="" class="img-thumbnail"> </a>
                  <div class="widget-blog-content"><a href="#">Voluptatum deleniti atque corrupti</a> <span class="meta-data"><i class="fa fa-calendar"></i> on 17th Dec, 2013</span> </div>
                </li>
                <li class="clearfix"> <a href="#" class="media-box post-image"> <img src="images/blog-image2.jpg" alt="" class="img-thumbnail"> </a>
                  <div class="widget-blog-content"><a href="#">Voluptatum deleniti atque corrupti voluptatum deleniti atque corrupti</a> <span class="meta-data"><i class="fa fa-calendar"></i> on 17th Dec, 2013</span> </div>
                </li>-->
              </ul>
            </div>
          </div>
        </div>
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
</body>
</html>