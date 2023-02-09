<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Job Request Details</title>
    <link rel="stylesheet" type="text/css" href="../CSS_Files/viewJobRequestListStyle.css"> 
    <link rel="stylesheet" type="text/css" href="../CSS_Files/jobRequestStyle.css">
    <link rel="stylesheet" href="../CSS_Files/common.css">
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>
</head>

<body>

<header>
            <img src = "../images/logo.png" class ="logo" width = "140"  height= "140" alt="logo"  >
                <nav>
                    <ul class = "nav_links">
                        <li><a href = "../php_files/HomePageParent.php"> Home</a></li>
                        <li><a href = "#"> Profile</a>
                            <ul>
                                <li><a href = "../php_files/ViewProfileParent.php"> View</a></li>
                                <li><a href = "../php_files/EditProfileParent.php"> Edit</a></li>
                            </ul>
                        </li>
                        <li><a href = "#"> Requests</a>
                            <ul> 
                                <li><a href = "/php_files/jobRequest.php"> Post</a></li>
                                <li><a href = "/php_files/editRequest.php"> Edit</a></li>
                            </ul>
                        </li> 
                        <li><a href = "../php_files/RequestOffers.php"> Offers</a></li>
                        <li><a href = "#"> Booking</a>
                            <ul>
                                <li><a href = "../php_files/CurrentBooking.php"> Current</a></li>
                                <li><a href = "../php_files/PreviousBooking.php"> Previous</a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
                <p><a class= "out" href="../php_files/logout.php">Logout</a></p>
        </header>


 <!--Page Content-->
 <?php
 include('../PHP_Files/connectDB.php');
if(isset($_GET['id'])){
// echo("set");
   $id = mysqli_real_escape_string($conn,$_GET['id']);
   //$val1 = "SELECT `TypeOfServese`, `startTime`, `endTime`, `startDate`, `comments`, `parentName`, `ID`, `status`, `expireDate`, `city`, `District` FROM  `requests` WHERE
    $sql = "SELECT `TypeOfClass`, `startTime`, `endTime`, `startDate`, `comments`, `parentName`, `ID`, `city`, `District` FROM `request` WHERE `request`.`ID` = $id";

    $result = mysqli_query($conn ,  $sql);
 //  $jobReq = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $valu = mysqli_num_rows($result);
}

 ?>


<h2 id="offerH2">Job Request Details</h2>

 <!--?php print_r($jobReq);?>-->


<?php 

if($valu > 0 ){

//$x = 0;
//while($x< $valu  ){

$row = mysqli_fetch_row($result);

$TypeOfClass = key($row);
next($row);

$startTime = key($row);
next($row);

$endTime = key($row);
next($row);

$startDate = key($row);
next($row);

$comments = key($row);
next($row);

$parentName = key($row);
next($row);

$id = key($row);
next($row);

//$city = key($row);
//next($row);

//$District = key($row);
//next($row);

$kidss = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $row[$id]";
$result2 = mysqli_query($conn, $kidss);
?> 
<div class="container">

<p class="SitterInfo" style="   
                  position: relative;
    margin-top: 30px;
    margin-left: 0px;
    margin-bottom: 30px;">
   <label class="nameLabel">Parent Name: </label>
   <label class="Name"><?php echo(($row[$parentName]))?></label><br>

   <label class="cityLabel">City: </label>
   <label class="city"><?php echo(($row[$city]))?></label> <br>

   <!--<label class="neighborhoodLabel">District: </label>
   <label class="neighborhood"><?php echo(($row[$District]))?></label>
    <hr>-->
</p>

<p class="RequestInfo"> 

<label class="nameLabel">Kid/s : </label> <br>
<label class="Name"><?php 
while($kidrow = mysqli_fetch_row($result2)){
    $kname = key($kidrow);
    next($kidrow);

    $kAge = key($kidrow);
    next($kidrow);

    //$ages[] = $kidrow[$kAge];

     echo $kidrow[$kname].": ".$kidrow[$kAge]." Years<br>";
}
?></label> <!-- <br><br> --> 

<!--<label class="ageLabel">Kid/s Ages: </label>
<label class="age"><?php echo(($row[$age]))?></label><br><br> -->
<br>
<label class="serviceLabel">Type Of Class: </label>
<label class="service"><?php echo(($row[$TypeOfClass]))?></label><br>
<br>
<label class="dayLabel">Date: </label>
<label class="day"><?php echo(($row[$startDate]))?></label><br>
<br>
<label class="timeLabel">Time: </label>
<label class="time"><?php echo(($row[$startTime]))?> - <?php echo(($row[$endTime])); ?></label>
<br>

<br>
<label class="commentsLabel">Comments: </label>
<label class="comments"><?php echo(($row[$comments]))?> </label>
<br><br><br> <br>

<!--<form action="../PHP_Files/sendOffer.php" method="POST">
<label class="OfferPriceDetails">Set Offer: 
                <input  name="OfferPrice" type="number" min="0" max="99999"> <span>SAR/hr</span>
            </label> <br>

            <input type="submit" class="sendOfferDetails" name="offer_submit" value="Send Offer"/>
            <input type="button" class="goBack" onclick="location.href ='viewJobRequestList.php';" value="Go Back"/>
</form> -->
<form action="../PHP_Files/sendOffer.php" method="GET">
<label class="OfferPriceDetails">Set Offer:  
                <input  name="OfferPrice" type="number" min="0" max="99999"> <span>SAR/hr</span>
                </label> <br>
                <label> <input  name="id" type="hidden" value="<?php echo($row[$id])?>"/></label>
                <input  name="day" type="hidden" value="<?php echo($row[$startDate])?>"/>
           <input  name="fromTime" type="hidden" value="<?php echo($row[$startTime])?>"/>
           <input  name="toTime" type="hidden" value="<?php echo($row[$endTime])?>"/>
          
           <input type="submit" class="sendOfferDetails" name="offer_submit" value="Send Offer"/>
            <input type="button" class="goBack" onclick="location.href ='viewJobRequestList.php';" value="Go Back"/>
</form>
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
        <label class="service"><?php echo(($row[$TypeOfClass]))?></label><br><br>

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
 
<!-- footer-->
<footer> 
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
                  
                <p class = "p" >
                <table >
                  <tr>
                     <th colspan="2"><a href="mailto:#" class = "con">ContactUs</a>  </th>
                     <th colspan="2"><a href="aboutUs.html " class ="con">aboutUs</a>  </th>
                     <th colspan="2"> <a href="FAQ.html" class = "con">FAQs</a> </th> 
                  </tr>
                  <tr style="text-align: center;">
                    <td colspan="2"><a href="https://twitter.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-twitter"></ion-icon> </a></td>
                    <td><a href = "https://whatsapp.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-whatsapp"></ion-icon></a></td>
                    <td><a href="https://instagram.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-instagram"></ion-icon></a></td>
                    <td><a href="https://snapchat.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-snapchat"></ion-icon></a></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="text-align: center;">&copy; A  Tutorly, 2022</td>
                  </tr>
                     
                </table> <br>
            </footer>
            <?php ////} 
}//end if
?>
 </body>
 </html>