<?php

include("includes/site_header.php");
require_once 'securimage.php';

$image = new Securimage();

$name = $email = $contact = $comment  = $output = '' ;

if (isset($_POST['submit'])) {
  $errors = array();
  if ($image->check($_POST['captcha_code']) == false) {
    array_push($errors, 'Please enter a valid Captcha');
  }else{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['phone']);
    $comment = trim($_POST['comment']);


    if(empty($name)) {
      array_push($errors, 'Please enter your name');
    }

    if (empty($email)) {
      array_push($errors, 'Please enter your email');
    }

    if(empty($contact)) {
      array_push($errors, 'Please enter your contact');
    }

    if (empty($comment)) {
      array_push($errors, 'Please enter your comment');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, 'Please enter a valid email');
    }

    if(strlen($output) == 0) {
      $to = "sales@everestcycle.com";
      $subject = "ENQUIRY FROM EVERESTCYLCE WEBSITE FROM";
      $from = 'From: '. $email ;
      $message = 'Name: '. $name ."\r\n".
              'Contact no: '. $contact. "\r\n".
              'Message: '. $comment ;

      if(mail($to, $subject, $message, $from)){
          $output = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>x</button>Thank you, we will get back to you soon.</div>";
      }else{
          $output = "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>x</button>Oops! something went wrong please try again.</div>";
      }
    }
  }
  //Prepare errors for output
  foreach($errors as $val) {
      $output .= "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>x</button>$val</div>";
  }
}
?>

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
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1885.4009735192612!2d73.00075599485918!3d19.072443500547696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1severest+cycles+vashi!5e0!3m2!1sen!2sin!4v1398179858929" width="600" height="450" frameborder="0" style="border:0"></iframe>
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
              </ul>
            </div>
          </div>
        </div>
        <form method="post"  name="contactform" action="contact.php">

          <div id="result">
            <?= $output; ?>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" name="do" value="contact" />
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
                <textarea cols="6" rows="7" id="comments" name="comment" class="form-control input-lg" placeholder="Message"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-6 col-md-6">
              <?php
                require_once 'securimage.php';
                echo Securimage::getCaptchaHtml();
              ?>
              <input id="submit" name="submit" type="submit" class="btn btn-primary btn-lg pull-right" value="Submit now!">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

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

       <!--  <form name="contact" method="POST" action="contact.php">
          <input type="text" name="test" />
          <input type="submit" name="submit" />
        </form>
 -->
  <script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
  <script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin -->
  <script src="js/helper-plugins.js"></script> <!-- Plugins -->
  <script src="js/bootstrap.js"></script> <!-- UI -->
  <script src="js/waypoints.js"></script> <!-- Waypoints -->
  <script src="plugins/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements -->
  <script src="js/init.js"></script> <!-- All Scripts -->
  <script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
  <script src="plugins/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer -->

  </body>
</html>
