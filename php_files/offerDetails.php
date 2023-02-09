<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Details</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">
    <link rel ="stylesheet" type="text/css" href = "../css_files/TutorsOffers.css">
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

</head>
<body>
<?php include ("../php_files/parentHeader.php"); ?>
 

    
    <?php
include ("../php_files/connectDB.php"); 
if(isset($_GET['id'])){
    $id = $_GET['id'];
   $sql1 = "SELECT `tutorName`,`price` ,`tutorEmail` 
    FROM `requests` INNER JOIN `offer` WHERE `offer`.`RequestID` = $id 
    AND `requests`.`ID` = $id AND `offer`.`offerstatus` != 'rejected' ";

$sql2 = "SELECT `TypeOfClass`,`startDate`,`startTime`,`endTime`,`comments`
FROM `requests` 
WHERE `requests`.`ID` = $id ";

$Offresult = mysqli_query($connection,  $sql1);
$Reqresult = mysqli_query($connection,  $sql2);
$valu = mysqli_num_rows($Offresult);
 }// end if set

  ?>

<h2>Request Offers</h2><br><br>

 <?php 

$kidss = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $id";
$res = mysqli_query($connection, $kidss);

 $requ = mysqli_fetch_row($Reqresult);
 $serv = key($requ);
   next($requ);

   $stdate = key($requ);
   next($requ);

   $sttime = key($requ);
   next($requ);

   $etime = key($requ);
   next($requ);

   $com = key($requ);
   next($requ);
?>
<div class="req" style="  
  
    position: relative;
    border-style: solid;
    border-radius: 30px;
    width: 75%;
    margin: auto;
    margin-top: 10px;
    padding: 20px;
    hight= 50px;"
    >
    <label class="serviceLabel">Your Request: </label><br><br>
    <label class="commentsLabel">Kid/s: </label>
<?php while($kidrow = mysqli_fetch_row($res)){
    $kname = key($kidrow);
    next($kidrow);

    $kAge = key($kidrow);
    next($kidrow);
    echo $kidrow[$kname].": ".$kidrow[$kAge]." Years. "; }?>
    <label class="classLabel" >Type Of Class: </label>
<label class="class"><?php echo(($requ[$serv]))?></label>

<label class="dayLabel">, Day: </label>
<label class="day"><?php echo(($requ[$stdate]))?> </label>

<label class="timeLabel">, Time: </label>
<label class="time"><?php echo(($requ[$sttime])) ?> - <?php echo(($requ[$etime]))?></label>

<label class="commentsLabel">, Comments: </label>
<label class="comments"><?php echo(($requ[$com]))?> </label>

       
</div>

<?php
 if($valu > 0 ){

$x = 0;
while($x< $valu  ){
$x++;
 $row = mysqli_fetch_row($Offresult);

  $tutorname = key($row);
   next($row);

   $price = key($row);
   next($row);

 $tutorEm = key($row);
 next($row);
 
 $sql3 = "SELECT `img` FROM `tutor` WHERE `email` = '$row[$tutorEm]' ";
 $result2 = mysqli_query($connection,  $sql3);
 $row2 = mysqli_fetch_row($result2);
 $tutorPic = key($row2);

?> 

</div>

<div> 
<p class="offer">
    <img src="../images/<?php echo(($row2[$tutorPic])); ?>" class="pic" height="190" alt = "Tutor Picture"><br>
<label class="nameLabel">Tutor Name: </label><br>
<label class="Name"><?php echo(($row[$tutorname])); ?></label><br>



<label class="priceLabel">Offerd Price: </label><br>
<label class="Price"><?php echo(($row[$price]))?> SAR</label>
<br><br>

<button  onclick="return checkAcce()" style = "border=none; background-color= #F5FBFF;">
<a class = "accept" href ='http://localhost/Tutorly_/php_files/setAccepted.php?id=<?php echo($id)?>&name=<?php echo($row[$tutorName]) ?>'>Accept </a> </button>
  <button onclick ="return checkDelet()"> 
  <a class = "reject" href='http://localhost/Tutorly_/php_files/setRejected.php?id=<?php echo($id)?>&name=<?php echo($row[$tutorName]) ?>'>Reject</a></button><br><br>
<br>


<script>

function checkDelet(){
   return confirm("Are you sure you want to Reject offer?");
}

function checkAcce(){
  
   return confirm("Are you sure you want to Accept offer?");
}

</script>
<a class="profile"href="http://localhost/Tutorly_/php_files/ShowTutorProfile.php?id=<?php echo($id) ?>&em=<?php echo( $row[$tutorEm]) ?>">Show Tutor Profile</a>  

<br>
<!-- 
<a class ="accept" href="#">Accept</a>
<a class="reject" href="#"> Reject </a>
<br> -->
</p>

</div>

<?php

}//end while loop 
}//end if
else{
?>

<div>
    <br><br>
    <h1 class = "msg1" style="text-align: center; color: #293241; padding: 8px;">We're Sorry</h1><hr><br>
    <h4 class = "msg2" style="text-align: center; color: #293241;">all of our tutors are busy right now, please try again later</h4>

    <a class= "button1" style="display: inline-table; margin-top: 2%; margin-left: 42%;" 
    href="http://localhost/Tutorly_/php_files/RequestOffers.php?id=<?php echo($row[$id])?>">Back To Requests</a>



</div> 
<?php }//close else
  
     include("../php_files/footer.php");
?>

</body>
</html>