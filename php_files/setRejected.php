<?php 
 include('../php_files/connectDB.php');

if(isset($_GET['id'])){
   $id=  $_GET['id'];
   $name = $_GET['name'];
   
   // $sql = "DELETE FROM `offers` WHERE `RequestID` = $id AND `babySitterName` = '$name'";
   // $result = mysqli_query($connection,$sql);
   // header("Location: http://localhost/BabySitterProject/HTML_Files/OfferDetails.php?id=$id");

   $sql = "UPDATE `offer` SET `offerstatus` = 'rejected' WHERE `RequestID` = $id AND `tutorName` = '$name'";
   $result = mysqli_query($connection,$sql);
   header("Location: http://localhost/Tutorly_/php_files/RequestOffers.php");
}
