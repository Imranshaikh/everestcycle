<?php 
require("../includes/check_auth_user.php");

require("../includes/dbconnect.php");
require("../includes/function.php");

if(isset($_POST["submit"])){
    
    $_SESSION["zdbyear_".$dbname] = $_SESSION["zdir"].'_1_'.$_POST["cmbyear"];
    $_SESSION["tit"]= $_POST["cmbyear"];
    
   /* $gethrs = mysql_query("SELECT workhrs FROM `compyear` WHERE finyear='" .mysql_real_escape_string($_POST['cmbyear']) . "'") or die(mysql_error());
    $hrs = mysql_fetch_array($gethrs);*/
   // $_SESSION["zwork"]= $hrs["workhrs"];
    header("Location: menu.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
        <meta name="msapplication-TileColor" content="#5bc0de"/>
        <meta name="msapplication-TileImage" content="assets/img/metis-tile.png"/>
        
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/lib/magic/magic.css">
 
    
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script>
        $(document).ready(function(){
            var year = $('#cmbyear').val();
           
         function showyear(){   
              $.ajax({
                  type: "GET",
                  url: "ajaxyear.php",
                  data: { qyear: year },
                  success:function(result){
                   $("#date").html(result);
                  }
              });
              $('#date').css("height","60px");
        }
        showyear();
        });
        </script>

  </head>
  <body class="login">

	      
<div class="container" onLoad="document.year.cmbyear.focus(); showyear('ajaxyear.php?qyear='+document.year.cmbyear.value);">
    <div class="text-center">

        <h1><font color="white">Best Marine Exports</font></h1>
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="" name='year' class="form-signin" method="POST">
                <p class="text-muted text-center">
                    Select A Financial Year
                </p>
                
                <select id='cmbyear' name="cmbyear" onchange="return showyear();" class="form-control" style="height:40px;">
                <?php 
                  $year = mysql_query("SELECT * FROM `compyear` order by `lastdate` DESC") OR die(mysql_error());
                    while ($row = mysql_fetch_array($year)){
                           echo "<option value=\"$row[finyear]\">$row[finyear]</option>";
                    }
                 ?>
                </select>
                <br/>
                <div id='date' class="form-control"></div><br/>
                <button class="btn btn-lg btn-primary btn-block" name='submit' type="submit" autofocus >Sign in</button>
            </form>
        </div>


</div>

	      
  </body>
</html>
