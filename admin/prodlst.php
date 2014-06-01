<?php
require("../includes/check_auth_user.php");
require("../includes/dbconnect.php");
include ('../includes/function.php');

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


<div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5>Product List</h5>
                    <div class="toolbar">
                      <ul class="nav pull-right">
                        <li>
                          <a class="minimize-box" data-toggle="collapse" href="#div-4">
                            <i class="fa fa-chevron-up"></i>
                          </a>
                        </li>
                      </ul>
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-4" class="accordion-body collapse in body">
                    <form class="form-horizontal" action='prod_lst.php' method='POST'>
                      <div class="form-group">
                        <label class="control-label col-lg-3">Type</label>
                        <div class="col-lg-5">
                          <div class="input-group">
                            <select class='form-control' name='type'>
                            <option value=""></option>
                            <?php
                            $mown = mysql_query("SELECT code, `name` FROM `prodtype`") or die(mysql_error());
                            while ($trow = mysql_fetch_array($mown)) {
                                echo "<option value='$trow[code]'>$trow[name]</option>";
                            }
                            ?>
                       </select>

                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3">Company</label>
                        <div class="col-lg-5">
                          <div class="input-group">
                            <input type="text" size="40"  id="invno" name="company" value=""  class="form-control" /> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3">Brand</label>
                        <div class="col-lg-5">
                          <div class="input-group">
                              <input type="text" size="40"  id="invno" name="brand" value=""  class="form-control" />    
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3">Category</label>
                        <div class="col-lg-5">
                          <div class="input-group">
                           <input type="type" size="40" id="invdt" name="category" value="" class="form-control" />  
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3">Sub Category</label>
                        <div class="col-lg-5">
                          <div class="input-group">
                      <input type="text" size="40"  id="ordno" name="subcategory" value="" class="form-control"/>      
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3"></label>
                        <div class="col-lg-5">
                          <div class="input-group">
                      <input type='submit' name='submit' class='btn btn-success btn-lg' value='Proceed'>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
