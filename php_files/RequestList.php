<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
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

html, body{
    display:inline-block;
     }
    
        </style>
</head>

<body>
      <?php include("tutorHeader.php");?>

        <h2>Request List</h2>

<div class="RequestOffers">
<?php
session_start();
include('../php_files/connectDB.php');

//`TypeOfServese`, `startTime`, `endTime`, `startDate`, `comments`, `parentName`, `ID`, `status`, `ParentEmail`, `expireDate`, `city`, `District` 
//SELECT * FROM `requests` WHERE `status` = 'unserved' ;
$val1 = "SELECT `TypeOfClass`, `ID`,`startDate`,`startTime`, `endTime` FROM  `requests` WHERE `status` = 'unserved'";
$result = mysqli_query($connection, $val1);
//`kidsName`, `age`, `TypeOfServese`, `startTime`, `endTime`, `startDate`, `endDate`, `comments`, `parentName`, `ID`, `status`, `ParentEmail`)
// if(! $result )
// echo("wrong");
// else
// echo("correct");
$valu = mysqli_num_rows($result);
// echo($valu);
// echo($row['TypeOfServese']);
// mysql_close($connection);
?>


<?php

$x = 0;
while($x < $valu  ){

$row = mysqli_fetch_row($result);

 $Class = key($row);
  next($row);

  $id = key($row);
  next($row);

  $start_day = key($row);
  next($row);

  $start_time = key($row);
  next($row);

  $end_time = key($row);
  next($row);

$kids = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $row[$id]";
$result2 = mysqli_query($connection, $kids);
?>
<div class="holder" style="background-color: #F5FBFF;margin:4px;"> 
<p class='req1'style=" height:auto; width:40%; margin-right:8px;">
<label class='nameLabel'>Type Of Class: </label>
<label class='Type'><?php echo($row[$Class])?></label><br>
<!--<label class='nameLabel'>Kid/s Name: </label>
<label class='name'><?php echo($row[$kids])?></label><br>
<label class='ageLabel'>Kid/s Age: </label>
<label class='age'><?php echo($row[$ages])?></label><br> -->
<label class='nameLabel'>No. Kid/s : </label>
<label class='Name'><?php
$numOfKids = mysqli_num_rows($result2);
echo($numOfKids );
// while($kidrow = mysqli_fetch_row($result2)){
//     $kname = key($kidrow);
//     next($kidrow);

//     $kAge = key($kidrow);
//     next($kidrow);
//     echo $kidrow[$kname].": ".$kidrow[$kAge]." Years<br>";
       
// }
?></label><br>
<label class='nameLabel'>Date: </label>
<label class='Time'><?php echo($row[$start_day])?></label><br>

<label class='nameLabel'>Time: </label>
<label class='Time'><?php echo($row[$start_time] .' - ' . $row[ $end_time])?></label><br>

<a class='button1' style="margin-left:0;"href='../php_files/RequestListDetails.php?id=<?php echo($row[$id])?>'>Request Details</a>

<form action="../php_files/sendOffer.php" method="GET" style="margin-top:10%;">
<p class="req1"style=" height:auto; width:90%;padding: 25px ;background-color:#C4DCEA;">
<label style="background-color:#C4DCEA;"class="nameLabel">Set Offer:  
<input style=" padding: 6px 20px;border: hidden;
    border-radius: 4px;" id="offerP" name="OfferPrice" type="number" min="0" max="99999"><span style="background-color:#C4DCEA;">SAR/hr</span>
</label>
           <input  name="id" type="hidden" value="<?php echo($row[$id])?>"/>
           <input  name="day" type="hidden" value="<?php echo($row[$start_day])?>"/>
           <input  name="fromTime" type="hidden" value="<?php echo($row[$start_time])?>"/>
           <input  name="toTime" type="hidden" value="<?php echo($row[$end_time])?>"/>
           <input type="submit" class="sendOffer" name="offer_submit" value="Send"/> 


</form>
</p>
</div>
<?php
$x++;  
       }


   ?>

<?php 
if(isset($_SESSION['ERROR2'])){
   
    echo '<script>alert("can\'t send offer because there is a conflect!");</script>';
unset($_SESSION['ERROR2']);
}
?>


<?php 
if(isset($_SESSION['Correct'])){
   
    echo '<script>alert(" done send offer successful!!");</script>';
    unset($_SESSION['Correct']);
}

?>

   
<footer> 
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
      
    <p class = "p" >
    <table >
      <tr>
         <th colspan="2"><a href="mailto:#" class = "con">ContactUs</a>  </th>
         <th colspan="2"><a href="../html_files/AboutUs.html " class ="con">aboutUs</a>  </th>
         <th colspan="2"> <a href="../html_files/FAQ.html" class = "con">FAQs</a> </th> 
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

</div>



</body>
</html>