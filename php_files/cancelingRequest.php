<?php 
  include('../PHP_Files/connectDB.php');

 if(isset($_GET['id'])){
    $id=  $_GET['id'];
    $sql = "DELETE FROM `offer` WHERE `RequestID` = $id";
    $query = mysqli_query($connection,$sql);
    if( $query ){
    $sql = "DELETE FROM `kids` WHERE `ID` = $id";
    $query = mysqli_query($connection,$sql);
    if( $query ){

      $sql = "DELETE FROM `requests` WHERE `ID` = $id";
      $query = mysqli_query($connection,$sql); 
      
  }}
  else{
      echo 'fail';
      }
    $Message = urlencode("Delete done");
   // header("Location:index.php?Message={$Message}");
    header("Location:../php_files/cancelRequest.php?Message=".$Message);

 }