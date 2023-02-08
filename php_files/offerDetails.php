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
 
    <h2>Request Offers</h2><br><br>
    
    <?php
include ("../php_files/connectDB.php"); 
if(isset($_GET['id'])){
    $id = $_GET['id'];
   $sql1 = "SELECT `babySitterName`,`price` ,`babySitterEmail` 
    FROM `requests` INNER JOIN `offers` WHERE `offers`.`RequestID` = $id 
    AND `requests`.`ID` = $id AND `offers`.`offerstatus` != 'rejected' ";

$sql2 = "SELECT `TypeOfServese`,`startDate`,`startTime`,`endTime`,`comments`
FROM `requests` 
WHERE `requests`.`ID` = $id ";

$Offresult = mysqli_query($connection,  $sql1);
$Reqresult = mysqli_query($connection,  $sql2);
$valu = mysqli_num_rows($Offresult);
 }// end if set

  ?>

<!-- <h2 id="offerH2">Request Offers</h2> -->

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
<div class="Requestcontainer" style="    background-color: white;
    position: relative;
    border-style: solid;
    border-radius: 30px;
    width: 75%;
    margin: auto;
    margin-top: 10px;
    padding: 20px;">
    <label class="serviceLabel">Your Request: </label><br><br>

    <label class="classLabel" >Type Of Class: </label>
<label class="class"><?php echo(($requ[$serv]))?></label>

<label class="dayLabel">, Day: </label>
<label class="day"><?php echo(($requ[$stdate]))?> </label>

<label class="timeLabel">, Time: </label>
<label class="time"><?php echo(($requ[$sttime])) ?> - <?php echo(($requ[$etime]))?></label>

<label class="commentsLabel">, Comments: </label>
<label class="comments"><?php echo(($requ[$com]))?> </label>
<label class="commentsLabel">, Kid/s: </label>
<?php while($kidrow = mysqli_fetch_row($res)){
    $kname = key($kidrow);
    next($kidrow);

    $kAge = key($kidrow);
    next($kidrow);
    echo $kidrow[$kname].": ".$kidrow[$kAge]." Years. "; }?>
       


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
<label lass="Price"><?php echo(($row[$price]))?> SAR</label>
<br><br>

<a class ="profile" href="../html_files/ShowTutorProfile.html">Show Profile</a><br><br>
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

</body>
</html>