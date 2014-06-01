<?php
require("../includes/config.php");
session_start();
if (!isset($_SESSION["username_".$dbname])) {
    header("Location: index.php");
}


?>