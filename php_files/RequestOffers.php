





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Offers</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">
    <link rel="stylesheet" type="text/css" href="../css_files/RequestOffers.css"> 
    <link rel="stylesheet" type="text/css" href="../css_files/TutorsOffers.css"></head>
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

<body>
<?php include ("../php_files/parentHeader.php"); ?>

 
<h2>Choose a Request to display The offers</h2>

    <br><br>
    
<div class= "RequestOffers"> 
    

 <?php 
 session_start();
include ("../php_files/connectDB.php"); 


$query = "UPDATE requests SET `status` =  'expired' WHERE created_at < (NOW() - INTERVAL 1 HOUR) AND `status` = 'unserved'";
$q3 = $result = mysqli_query($connection, $query);


$pemail =  $_SESSION['email'];
 

$val1 = "SELECT `TypeOfClass`,`startDate`,`startTime` ,`endTime`,`ID`,`status` FROM  `requests` 
WHERE `parentEmail` = '$pemail' 
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

   $day = key($row);
   next($row);

   $stime = key($row);
   next($row);

   $etime = key($row);
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

         <label class='nameLabel'>Type Of Class: </label>
        <label class='Type'><?php echo($row[$class])?></label><br>

<label class='nameLabel'>No. Kid/s : </label>
<label class='Name'><?php
$numOfKids = mysqli_num_rows($result2);
echo($numOfKids );
?></label><br>



<label class="nameLabel">Day: </label>
<label class='Time'><?php echo($row[$day])?></label><br>

<label class='nameLabel'>Time: </label>
<label class='Time'><?php echo($row[$stime])?> - <?php echo($row[$etime])?></label>
<br><br>
     <a class ="Offer1" href="http://localhost/Tutorly_/php_files/OfferDetails.php?id=<?php echo($row[$id])?>">Show Offers</a>
        </p> 
    </div>

    
    <?php 
}//end while
} else {
 ?>

</div>

<div class="noReq" style="   
    position: relative;
    border-radius: 30px;
    width: 500px;
    height: 100px;
    margin: auto;
    margin-top: 100px;
    padding: 10px;" >
    <h2 style="   height: 30px;
    color: black;
    text-align: center;
    margin-top: 35px; ">YOU DO NOT HAVE ANY REQUESTS!</h2>
</div>

<?php } ?>

</div>
<?php include ("../php_files/footer.php"); //تحت// ?>

</body>

</html>

