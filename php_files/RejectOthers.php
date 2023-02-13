<?php 
 include('../php_files/connectDB.php');

if(isset($_GET['id'])){
   $id=  $_GET['id'];
   


   $sql = "UPDATE `offer` SET `offerstatus`= 'rejected' WHERE `RequestID` = $id ";
   $result = mysqli_query($connection,$sql);
   header("Location: http://localhost/Tutorly_/php_files/RequestOffers.php");
   
}