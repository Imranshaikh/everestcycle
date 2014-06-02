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
  <div class="notice-bar">
      <div class="container">
          <div class="row">
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
    <div class="main" role="main">
      <div id="content" class="content full">
        <div class="container">
            <div class="row">

              <ul class="isotope-grid" data-sort-id="gallery">
                <?php
                  while($row = mysql_fetch_object($qry)){
                    $product_id = $row->code ;
                    $img = $row->smallimg;
                    $title = $row->title;

                  #get_product_detail.php?id=$row->code
                    echo '<li class="col-md-3 col-sm-3 grid-item post format-link">';
                    echo '<div class="grid-item-inner">';
                    // echo "<a href='#' data-target='get_product_detail.php?id=$row->code' data-toggle='modal' data-target='#myModal'  class='media-box'>";
                    echo "<a href='' data-id='" . $product_id . "' class='productDetail' data-toggle='modal' data-target='#myModal' >";
                    echo "<img src='$img' alt='$title' style=height:137px;width:230px;> </a>";
                    echo "<span style='float:left;color:#007F7B;'>MRP: 350000</span>";
                    echo "<span style='float:right;color:#B22222;'>ERP: 250000</span>";
                    echo "<hr/>";
                    echo "</div>";
                    echo "</li>";
                  }
                ?>

              </ul>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Product Description</h4>
          </div>
          <div class="modal-body">
            <form action="get_product_details.php" method="POST" >
              <input type="hidden" name="prod_id" id="prod_id" />
              <?php
                // $prod_id = "<input type='hidden' name='product_id' id='product_id' />";

                // echo $product_id;
                // echo "$maindb";
                // $get_product = mysql_query("SELECT * FROM `prodmain` WHERE `code`='$prod_id'")or die(mysql_error());
                // $product = mysql_fetch_assoc($get_product);
                // echo "<p>";
                // var_dump($product);

                var_dump($_POST['prod_id']);

              ?>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default inverted" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
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

  <script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
  <script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin -->
  <script src="js/helper-plugins.js"></script> <!-- Plugins -->
  <script src="js/bootstrap.js"></script> <!-- UI -->
  <script src="js/waypoints.js"></script> <!-- Waypoints -->
  <script src="plugins/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements -->
  <script src="js/init.js"></script> <!-- All Scripts -->
  <script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
  <script src="plugins/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer -->

  <script type="text/javascript">

    $(".productDetail").click(function(){
      var productId = $(this).attr('data-id');
      $('.modal-body #prod_id').val(productId);

      // productId = $(this).attr("href");

      // $(".modal-body #product_id").val(productId);
    });

  </script>

  </body>
</html>
