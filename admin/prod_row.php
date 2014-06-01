
<?php

if ($_REQUEST["ctr"]){
    $ctr = $_REQUEST["ctr"];
             echo "<tr>";
                echo "<td align='left'><input type='text' size='3'  maxlength='2' name='srno_$ctr' class='sno form-control' autofocus/></td>";
                echo "<td align='center'><input type='text' size='6' name='title_$ctr' style='text-align:left' class='qty form-control'/></td>";
                echo "<td align='center'><textarea name='descrip_$ctr' cols='125' rows='1' class='desc form-control'></textarea></td>";
             echo "</tr>";

}
else{
    echo "ERROR";
}?>
