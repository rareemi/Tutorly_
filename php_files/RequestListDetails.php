<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">
    <link rel="stylesheet" type="text/css" href="../css_files/RequestOffers.css"> 
    <link rel="stylesheet" type="text/css" href="../css_files/TutorsOffers.css"></head>
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

    <style>
        html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    display: inline-block;
}

footer {
    
    display: table;
}
        </style>
</head>

<body>

      <!--menu-->
      <?php include("tutorHeader.php");?>
    <!--end menu-->

 <!--Page Content-->
 <?php
 include('../php_files/connectDB.php');
if(isset($_GET['id'])){
// echo("set");
   $id = mysqli_real_escape_string($connection,$_GET['id']);
   //$val1 = "SELECT `TypeOfServese`, `startTime`, `endTime`, `startDate`, `comments`, `parentName`, `ID`, `status`, `expireDate`, `city`, `District` FROM  `requests` WHERE
    $sql = "SELECT `TypeOfClass`,  `ID`,`parentEmail`,`startDate`,`startTime`, `endTime`, `comments` FROM `requests` WHERE `requests`.`ID` = $id";
    $result = mysqli_query($connection,  $sql);
 //  $jobReq = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $valu = mysqli_num_rows($result);
}

 ?>


<h2 id="offerH2"> Request Details</h2>

<!--<?php print_r($jobReq);?>-->


<?php 
if($valu > 0 ){

//$x = 0;
//while($x< $valu  ){

$row = mysqli_fetch_row($result);

$TypeOfClass = key($row);
next($row);

$id = key($row);
next($row);

$parentEmail = key($row);
next($row);

$startDate = key($row);
next($row);

$startTime = key($row);
next($row);

$endTime = key($row);
next($row);

$comments = key($row);
next($row);


$kids = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $row[$id]";
$result2 = mysqli_query($connection, $kids);
?> 
<div class="holder"style="background-color: #F5FBFF;margin:4px;margin-left:30%;">

<p class="req1" style=" height:auto; width:50%; margin-right:8px;">
   <label class="nameLabel">Parent Email: </label>
   <label class="Name"><?php echo(($row[$parentEmail]))?></label><br>

<label class="nameLabel">Kid/s : </label><br>
<label class="Name"><?php 
while($kidrow = mysqli_fetch_row($result2)){
    $kname = key($kidrow);
    next($kidrow);

    $kAge = key($kidrow);
    next($kidrow);

    //$ages[] = $kidrow[$kAge];

     echo $kidrow[$kname].": ".$kidrow[$kAge]." Years<br>";
}
?></label>

<!--<label class="ageLabel">Kid/s Ages: </label>
<label class="age"><?php echo(($row[$age]))?></label><br><br> -->

<label class="nameLabel">Type Of Class: </label>
<label class="Name"><?php echo(($row[$TypeOfClass]))?></label>
<br>
<label class="nameLabel">Date: </label>
<label class="Name"><?php echo(($row[$startDate]))?></label>
<br>
<label class="nameLabel">Time: </label>
<label class="Name"><?php echo(($row[$startTime]))?> - <?php echo(($row[$endTime])); ?></label><br>

<label class="nameLabel">Comments: </label>
<label class="Name"><?php echo(($row[$comments]))?> </label><br>
<input type="submit" class="goBack" onclick="location.href ='../php_files/RequestList.php';" value="Go Back"/>
<!--<form action="../PHP_Files/sendOffer.php" method="POST">
<label class="OfferPriceDetails">Set Offer: 
                <input  name="OfferPrice" type="number" min="0" max="99999"> <span>SAR/hr</span>
            </label> <br>

            <input type="submit" class="sendOfferDetails" name="offer_submit" value="Send Offer"/>
            <input type="button" class="goBack" onclick="location.href ='viewJobRequestList.php';" value="Go Back"/>
</form> -->


<!--
<label class="OfferPriceDetails" >Set Offer: 
   <input name="OfferPrice" type="number" min="0" max="99999"><span>SAR/hr</span>
</label> <br>

<div>
<br>
   <input type="button" class="sendOfferDetails" onclick="location.href ='#';" value="Send Offer"/>
   <input type="button" class="goBack" onclick="location.href ='viewJobRequestList.php';" value="Go Back"/>

   <form action="../PHP_Files/sendOffer.php" method="POST">
<label class="OfferPriceDetails">Set Offer: 
                <input  name="OfferPrice" type="number" min="0" max="99999"> <span>SAR/hr</span>
            </label> <br>

            <input type="submit" class="sendOfferDetails" name="offerL_submit" value="Send Offer"/>
            <input type="button" class="goBack" onclick="location.href ='viewJobRequestList.php';" value="Go Back"/>
</form>
</div> -->
</p>
</div>





<!-- end copy-->

<!-- <div class="container">

         <img src="female.png" id="sitterPic" alt="parent profile picture">
         <p class="SitterInfo">
            <label class="nameLabel">Parent Name: </label>
            <label class="Name">Mona</label><br>
 
            <label class="cityLabel">City: </label>
            <label class="city">Riyadh</label> <br>

            <label class="neighborhoodLabel">District: </label>
            <label class="neighborhood">Alhamra</label> <br>
             <hr>
         </p>
    
     <p class="RequestInfo"> 

        <label class="nameLabel">Kid/s Name: </label>
        <label class="Name"><?php echo(($row[$kidsName]))?></label><br><br>
        
        <label class="ageLabel">Kid/s Ages: </label>
        <label class="age"><?php echo(($row[$age]))?></label><br><br>

        <label class="serviceLabel">Type Of Service: </label>
        <label class="service"><?php echo(($row[$TypeOfServese]))?></label><br><br>

        <label class="dayLabel">Date: </label>
        <label class="day"><?php echo(($row[$startDate]) . ($row[$endDate]))?></label><br><br>

        <label class="timeLabel">Time: </label>
        <label class="time"><?php echo(($row[$startTime]) . ($row[$endTime]))?> </label>
        <br><br>
    
        <label class="commentsLabel">Comments: </label>
        <label class="comments"><?php echo(($row[$comments]))?></label>
        <br><br><br>
       

        <label class="OfferPriceDetails" >Set Offer: 
            <input name="OfferPrice" type="number" min="0" max="99999"><span>SAR/hr</span>
        </label> <br>
        
        <div>
        <br>
            <input type="button" class="sendOfferDetails" onclick="location.href ='#';" value="Send Offer"/>
            <input type="button" class="goBack" onclick="location.href ='viewJobRequestList.html';" value="Go Back"/>
    

        </div>
     </p>
 </div> -->
 
<?php 
} //end if
?>
<?php include("../php_files/footer.php");?>
</body>
</html>