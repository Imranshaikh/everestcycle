<?php
include ('../includes/function.php');
       $image = new SimpleImage();
       $image->load('img/homepage/mountain.jpg');
       //$image->resize(1800,1233);
       $image->resize(639,360);
       $image->save('img/homepage/mountain.jpg');

?>