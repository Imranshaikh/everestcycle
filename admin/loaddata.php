<?php
include_once('db.php');

$query="SELECT vouchno FROM `qrydata` ORDER BY vouchno ASC";
$res    = mysqli_query($connection,$query);
$counter  = mysqli_num_rows($res);
$page = (int) (!isset($_REQUEST['pageId']) ? 1 :$_REQUEST['pageId']);
$page = ($page == 0 ? 1 : $page);
$start = ($page-1) * 5;
$adjacents = "2";
    
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($counter/5);
$lpm1 = $lastpage - 1;   
$pagination = "";
if($lastpage > 1)
    {   
        $pagination .= "<div class='pagination'>";
        if ($page > 1)
            $pagination.= "<a href=\"#Page=".($prev)."\" onClick='changePagination(".($prev).");'>&laquo; Previous&nbsp;&nbsp;</a>";
        else
            $pagination.= "<span class='disabled'>&laquo; Previous&nbsp;&nbsp;</span>";   
    
        if($lastpage > 5 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2))
            {
                for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if($counter == $page)
                        $pagination.= "<span class='current'>$counter</span>";
                    else
                        $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
                }
                $pagination.= "...";
                $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
                $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           
           }
           elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "...";
               for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
               {
                   if($counter == $page)
                       $pagination.= "<span class='current'>$counter</span>";
                   else
                       $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
               }
               $pagination.= "..";
               $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
               $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           }
           else
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "..";
               for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<span class='current'>$counter</span>";
                   else
                        $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a href=\"#Page=".($next)."\" onClick='changePagination(".($next).");'>Next &raquo;</a>";
        else
            $pagination.= "<span class='disabled'>Next &raquo;</span>";
        
        $pagination.= "</div>";       
    }
    
if(isset($_POST['pageId']) && !empty($_POST['pageId']))
{
    $id=$_POST['pageId'];
}
else
{
    $id='0';
}
$query="select `partyname`, `brand`, `descrip`, `colour`, `rem1`, `remark`, `imgpath` FROM `qrydata` order by vouchno asc
limit ".mysqli_real_escape_string($connection,$start).",5";
//echo $query;
$res    =   mysqli_query($connection,$query);
$count  =   mysqli_num_rows($res);
$HTML='';
print $count."<br/>";
if($count > 0)
{
    while($row=mysqli_fetch_array($res))
    {
        
        $name=$row['partyname'];
        $brand=$row['brand'];
        $descrip=$row['descrip'];
        $colour=$row['colour'];
        $rem1=$row['rem1'];
        $remark=$row['remark'];
        $imgpath=$row['imgpath'];
        $HTML.='<table border="1" width="100%">';
        $HTML.='<tr>';
        $HTML.='<td width="50">';
        $HTML.=$name;
        $HTML.='</td>';
        $HTML.='<td width="150">';
        $HTML.=$brand;
        $HTML.='</td>';
        $HTML.='<td width="150">';
        $HTML.=$descrip;
        $HTML.='</td>';
        $HTML.='<td width="150">';
        $HTML.=$colour;
        $HTML.='</td>';
        $HTML.='<td width="150">';
        $HTML.=$rem1;
        $HTML.='</td>';
        $HTML.='<td width="150">';
        $HTML.=$remark;
        $HTML.='</td>';
        $HTML.='<td width="150">';
        $HTML.="<img src='../kiwi/".$imgpath."' style='width:50px;height:auto;'>";
        $HTML.='</td>';
        $HTML.='</tr>';
        $HTML.='</table>';
        /*
        $HTML.='<div>';
        $HTML.='<a href="'.$link.'" target="_blank">'.$post.'</a>';
        $HTML.='</div><br/>';*/
    }
}
else
{
    $HTML='No Data Found';
}
echo $HTML;
echo $pagination;
?>