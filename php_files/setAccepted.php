<?php 
 include('../php_files/connectDB.php');

if(isset($_GET['id'])){
   $id=  $_GET['id'];
   $name = $_GET['name'];

   $sql = "UPDATE `requests` SET `status`= 'served' WHERE `ID` = $id ";
   $sq2 = "UPDATE `offer` SET `offerstatus`='accepted' WHERE `RequestID` = $id AND `tutorName` = '$name'";
   $result1 = mysqli_query($connection,$sql);
   $result1 = mysqli_query($connection,$sq2);

   //header("Location: http://localhost/Tutorly_/php_files/RejectOthers.php?id=$id&name=$name");
   header("Location: http://localhost/Tutorly_/php_files/RequestOffers.php");

   
}
