<?php
include("includes/dbconnect.php");
include("includes/function.php");

############ MAIN QUERY #########################
$maindb = "prodmain";
$qry = mysql_query("SELECT * FROM `$maindb`")or die(mysql_error());

$num = mysql_num_rows($qry);

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
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <tr>
              <td>Company</td>
              <td>Brand</td>
              <td>Category</td>
              <td>Subcategory</td>
            </tr>
            <tr>
              <td>
                <?php
                  $getcomp = mysql_query("SELECT * FROM `company`")or die(mysql_error());
                ?>

                <select name="company[]" id="company" multiple="multiple" onchange="companyfilter(this.id, $(this).val())">
                  <option value="">All Company</option>
                <?php
                  while ($comp = mysql_fetch_assoc($getcomp)) {
                    echo "<option value='".$comp['code']."'>". $comp['name'] ."</option>";
                  }
                ?>
                </select>
              </td>
              <td>
                <?php
                  $getbrand = mysql_query("SELECT * FROM `brand`")or die(mysql_error());
                ?>
                <select name="brand[]" id="brand" multiple="true" onchange="brandfilter(this.id, $(this).val())">
                  <option value="">All Brand</option>
                <?php
                  while ($brand = mysql_fetch_assoc($getbrand)) {
                    echo "<option value='".$brand['code']."'>". $brand['name'] ."</option>";
                  }
                ?>
                </select>
              </td>
              <td>
                <?php
                  $getcat = mysql_query("SELECT * FROM `category`")or die(mysql_error());
                ?>
                <select name="category[]" id="category" multiple="true" onchange="categoryfilter(this.id, $(this).val())">
                  <option value="">All Category</option>
                <?php
                  while ($cat = mysql_fetch_assoc($getcat)) {
                    echo "<option value='".$cat['code']."'>". $cat['name'] ."</option>";
                  }
                ?>
                </select>

              </td>
              <td>
                <?php
                  $getsubcat = mysql_query("SELECT * FROM `subcat`")or die(mysql_error());
                 ?>
                 <select name="subcategory[]" id="subcategory" multiple="true" onchange="subcatfilter(this.id, $(this).val())">
                  <option value="">All Subcategory</option>
                <?php
                  while ($subcat = mysql_fetch_assoc($getsubcat)) {
                    echo "<option value='".$subcat['code']."'>". $subcat['name'] ."</option>";
                  }
                ?>
                </select>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

    <div class="main" role="main">
      <div id="content" class="content full">
        <div class="container">
            <div class="row">
              <ul class="isotope-grid" id="gallery" data-sort-id="gallery" style="overflow: inherit !important;">
                <?php
                  while($row = mysql_fetch_object($qry)){
                    $product_id = $row->code ;
                    $img = $row->smallimg;
                    $title = $row->title;
                    echo "<input name='product_id' type='hidden' value='".$product_id."' />";
                    echo '<li class="col-md-3 col-sm-3 grid-item post format-link">';
                    echo '<div class="grid-item-inner">';
                    echo "<a href='' data-id='".$product_id."' data-toggle='modal' data-target='#myModal' class='productDetail'>";
                    echo "<img src='$img' alt='$title' style=height:137px;width:230px;> </a>";
                    echo "<span style='float:left;color:#007F7B;'>MRP: ". $row->mrp ."</span>";
                    echo "<span style='float:right;color:#B22222;'>ERP: ". $row->erp ."</span>";
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
      <div class="modal fade" id="myModal" style="display:none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Product Description</h4>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-6" style="padding-bottom:10px;">
                    <center><div id="title"></div></center>
                    <img>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-bordered hidden" id="tran">
                      <thead>
                        <th>Sr No.</th>
                        <th>Title</th>
                        <th>Description</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default inverted" id="close" data-dismiss="modal">Close</button>
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

  <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-3.0.3.min.css"> -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap-multiselect.css">
  <script type="text/javascript">
    $(document).ready(function() {
      $('#company').multiselect({
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 200
      });

      $('#brand').multiselect({
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 200
      });

      $('#category').multiselect({
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 200
      });

      $('#subcategory').multiselect({
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 200
      });

    });

    function companyfilter(inputId,values) {
      $(".container .row #gallery").empty();
      var compObj = {};
      compObj = values;
      $.ajax({
        type: "POST",
        url: "filter.php",
        data: {company:compObj},
        success: function(data) {
          var mdata = JSON.parse(data);
          var row = '';
          for(var i = 0; i < mdata.length; i++){
            var obj = mdata[i];
            var imgsrc = escape(obj.smallimg) ;
            row = "<input name='product_id' type='hidden' value='" + obj.code + "'>";
            row += "<li class='col-md-3 col-sm-3 grid-item post format-link'>";
            row += "<div class='grid-item-inner'>";
            row += "<a href='' data-id='" + obj.code + "' data-toggle='modal' data-target='#myModal' class='productDetail'>";
            row += "<img src='"+ imgsrc +"' alt='" + obj.title + "' style='height:137px;width:230px;'> </a>";
            row += "<span style='float:left;color:#007F7B;'>MRP: " + obj.mrp + "</span>";
            row += "<span style='float:right;color:#B22222;'>ERP: " + obj.erp + "</span>";
            row += "<hr />";
            row += "</div>";
            row += "</li>";
            if(row != ''){
              $(".container .row #gallery").append(row);
            }
          }
          if(row === ''){
            $('.container .row #gallery').append("<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Warning!</strong> No Record Found</div>");
          }

        }
      });
    }

    function brandfilter(inputId,values) {
      $(".container .row #gallery").empty();
      var brandObj = {};
      brandObj = values;
      $.ajax({
        type: "POST",
        url: "filter.php",
        data: {brand:brandObj},
        success: function(data) {
          var mdata = JSON.parse(data);
          var row = '';
          for(var i = 0; i < mdata.length; i++){
            var obj = mdata[i];
            var imgsrc = escape(obj.smallimg) ;
            row = "<input name='product_id' type='hidden' value='" + obj.code + "'>";
            row += "<li class='col-md-3 col-sm-3 grid-item post format-link'>";
            row += "<div class='grid-item-inner'>";
            row += "<a href='' class='productDetail' data-id='" + obj.code + "' data-toggle='modal' onclick='productDetail' data-target='#myModal' >";
            row += "<img src='"+ imgsrc +"' alt='" + obj.title + "' style='height:137px;width:230px;'> </a>";
            row += "<span style='float:left;color:#007F7B;'>MRP: " + obj.mrp + "</span>";
            row += "<span style='float:right;color:#B22222;'>ERP: " + obj.erp + "</span>";
            row += "<hr />";
            row += "</div>";
            row += "</li>";
            if(row != ''){
              $(".container .row #gallery").append(row);
            }
          }
          if(row === ''){
            $('.container .row #gallery').append("<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Warning!</strong> No Record Found</div>");
          }

        }
      });
    }

    function categoryfilter(inputId,values) {
      $(".container .row #gallery").empty();
      var catObj = {};
      catObj = values;
      $.ajax({
        type: "POST",
        url: "filter.php",
        data: {category:catObj},
        success: function(data) {
          var mdata = JSON.parse(data);
          var row = '';
          for(var i = 0; i < mdata.length; i++){
            var obj = mdata[i];
            var imgsrc = escape(obj.smallimg) ;
            row = "<input name='product_id' type='hidden' value='" + obj.code + "'>";
            row += "<li class='col-md-3 col-sm-3 grid-item post format-link'>";
            row += "<div class='grid-item-inner'>";
            row += "<a href='' data-id='" + obj.code + "' data-toggle='modal' data-target='#myModal' class='productDetail'>";
            row += "<img src='"+ imgsrc +"' alt='" + obj.title + "' style='height:137px;width:230px;'> </a>";
            row += "<span style='float:left;color:#007F7B;'>MRP: " + obj.mrp + "</span>";
            row += "<span style='float:right;color:#B22222;'>ERP: " + obj.erp + "</span>";
            row += "<hr />";
            row += "</div>";
            row += "</li>";
            if(row != ''){
              $(".container .row #gallery").append(row);
            }
          }

          if(row === ''){
            $('.container .row #gallery').append("<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Warning!</strong> No Record Found</div>");
          }

        }
      });
    }

    function subcatfilter(inputId,values) {
      $(".container .row #gallery").empty();
      var subcatObj = {};
      subcatObj = values;
      $.ajax({
        type: "POST",
        url: "filter.php",
        data: {subcategory:subcatObj},
        success: function(data) {
          var mdata = JSON.parse(data);
          var row = '';
          for(var i = 0; i < mdata.length; i++){
            var obj = mdata[i];
            var imgsrc = escape(obj.smallimg) ;

            row = "<input name='product_id' type='hidden' value='" + obj.code + "' />";
            row += "<li class='col-md-3 col-sm-3 grid-item post format-link'>";
            row += "<div class='grid-item-inner'>";
            row += "<a href='' data-id='"+ obj.code +"' data-toggle='modal' data-target='#myModal' class='productDetail'>";
            row += "<img src='"+ imgsrc +"' alt='" + obj.title + "' style='height:137px;width:230px;'> </a>";
            row += "<span style='float:left;color:#007F7B;'>MRP: " + obj.mrp + "</span>";
            row += "<span style='float:right;color:#B22222;'>ERP: " + obj.erp + "</span>";
            row += "<hr />";
            row += "</div>";
            row += "</li>";

            if(row !== ''){
              $(".container .row #gallery").append(row);
            }

          }

          if(row === ''){
            $('.container .row #gallery').append("<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Warning!</strong> No Record Found</div>");
          }

        }

      });

    }


    $(document).on("click", ".productDetail", function(e){
      e.preventDefault();

      var id = $(this).data('id');

      $.post("getid.php", { id: id }, function(response){
        var data = JSON.parse(response);
        $("#myModal .modal-body img").attr('src', data.largeimg);
        $("#myModal .modal-body #title").html(data.title);
        if(data.srno){
          var srnolen = Object.keys(data.srno).length;
          var row = "";
          if (srnolen > 0){
            for(var i = 0; i <= srnolen; i++){
              if(data.srno[i] && data.ttitle[i] && data.description[i]){
                row += "<tr><td>"+ data.srno[i] +"</td><td>"+ data.ttitle[i] +"</td><td>"+ data.description[i] +"</td></tr>";
              }
            }
            if(row != ""){
              $("#myModal .modal-body #tran").append(row).removeClass("hidden");
            }
          }
        }else{
          $("#myModal .modal-body #tran tbody").remove();
          $("#myModal .modal-body #tran").addClass("hidden");
        }

      });

      $(".modal-body").css('max-height','480px');
      $(".modal-body").css('overflow-y','scroll');
      $(".modal-body").css('overflow-x','hidden');

    });

  </script>

  </body>
</html>
