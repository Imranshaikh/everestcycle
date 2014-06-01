<?php
session_start();
require("../includes/dbconnect.php");
require("../includes/config.php");
require("../includes/function.php");


$zdir = $dbname;
$zcomp = 1 ;
$zdbroot = $zdir;

if(isset($_POST['submit'])){
   $udbf = $zdbroot."passmain";

   $login = mysql_query("SELECT * FROM `passmain` WHERE `user` = '" .mysql_real_escape_string($_POST['user']) . "' and `password` = '" .mysql_real_escape_string($_POST['pass']) . "'") or die(mysql_error());

   $_SESSION["username_".$zdir] = $login["user"];
   
   $_SESSION["zdbroot"]= $zdbroot;
   $_SESSION["zdir"] =  $zdir;


   if(mysql_num_rows($login) == 1){
      $_SESSION['username_'.$zdir] = $_POST["user"];
      $_SESSION['logged-in'] = true;
      //browse("username_".$zdir);
      header("Location: menu.php");
      
   }
   else{
      print '<script type="text/javascript">';
      print 'alert("Invalid Login Credentials")';
      //header('refresh: 1; index.php');
      print '</script>';
   }
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
 
  </head>
  <body class="login">

	      
<div class="container">
    <div class="text-center">
        
        <h1><font color="white"><?php echo $project_title;?></font></h1>
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="" class="form-signin" method="POST">
                <p class="text-muted text-center">
                    Enter your username and password
                </p>
                <input type="text" placeholder="Username" name="user" class="form-control" autofocus >
                <input type="password" placeholder="Password" name="pass" class="form-control">
            <!--    <button class="btn btn-lg btn-primary btn-block" name='submit' type="submit">Sign in</button>-->
                <input type='submit' name='submit' value='Sign In' class="btn btn-lg btn-primary btn-block">
            </form>
        </div>
       <div id="forgot" class="tab-pane">
            <form action="index.html" class="form-signin">
                <p class="text-muted text-center">Enter your valid e-mail</p>
                <input type="email" placeholder="mail@domain.com" required="required" class="form-control">
                <br>
                <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
            </form>
        </div>
 <!--        <div id="signup" class="tab-pane">
            <form action="index.html" class="form-signin">
                <input type="text" placeholder="username" class="form-control">
                <input type="email" placeholder="mail@domain.com" class="form-control">
                <input type="password" placeholder="password" class="form-control">
                <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
            </form>
        </div>
    </div>-->
    <div class="text-center">
        <ul class="list-inline">
             <!--<li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
             <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>-->
                
            <!--<li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>-->
        </ul>
    </div>


</div> <!-- /container -->

	      
	      
      <script src="assets/lib/jquery.min.js"></script>
      <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
      
      <script>
            $('.list-inline li > a').click(function() {
                var activeForm = $(this).attr('href') + ' > form';
                //console.log(activeForm);
                $(activeForm).addClass('magictime swap');
                //set timer to 1 seconds, after that, unload the magic animation
                setTimeout(function() {
                    $(activeForm).removeClass('magictime swap');
                }, 1000);
            });

        </script>
  </body>
</html>
