

<?php include ("../php_files/parentHeader.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Offers</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">
    <link rel="stylesheet" type="text/css" href="../css_files/RequestOffers.css"> 
    <link rel="stylesheet" type="text/css" href="../css_files/TutorsOffers.css"></head>
<body>
  
 
<h2>Choose a Request to display The offers</h2>

    <br><br>
    
<div class= "RequestOffers"> 
    

<?php
session_start();
include ("../php_files/connectDB.php");

$query = "UPDATE requests SET `status` =  'expired' WHERE created_at < (NOW() - INTERVAL 1 HOUR) AND `status` = 'unserved'";
$q3 = $result = mysqli_query($connection, $query);


$pemail =  $_SESSION['email'];
 

$val1 = "SELECT `TypeOfClass`,`Duration`,`ID` ,`status` FROM  `requests` 
WHERE `ParentEmail` = '$pemail' 
 AND `status`  = 'unserved' " ;
$result1 = mysqli_query($connection, $val1);
$valu = mysqli_num_rows($result1);
?>


<?php

$x = 0;
$y=0;

if($valu > 0 ) {
while($x< $valu  ){

 $x++;  
 $row = mysqli_fetch_row($result1);

  $class = key($row);
   next($row);

   $id = key($row);
   next($row);

   $status = key($row);
   next($row);


$kidss = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $row[$id]";
$result2 = mysqli_query($connection, $kidss);
?>

    <div class = "holder" style="background-color: #F5FBFF;"> 
<p class ="req1" >
         <label class = "titleLabel">Request</label><br> 
     <label class="nameLabel">Kid name: </label>
    <label class="Name"><?php
        $kidn = mysqli_num_rows($result2);
        echo($numOfKids );
        ?></label><br>

     <label class="ageLabel">Age: </label>
     <label class="Age">8 Years</label><br>

     <label class="classLabel">Type Of Class: </label>
     <label class = "class"><?php echo($row[$class])?></label><br>

     <label class="durationLabel">Duration: </label> <label class="duration">3 Hours</label>
     <br>
     <a class ="Offer1" href="../html_files/TutorsOffers.html">Show Offers</a>
        </p>

    </div>
    <?php 
}//end while
}else{
    ?>
}


<?php include ("../php_files/footer.php"); ?>

</body>
</html>