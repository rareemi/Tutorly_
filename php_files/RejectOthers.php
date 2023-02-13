
<?php /* 
 include('../php_files/connectDB.php');

if(isset($_GET['id'])){
   $id=  $_GET['id'];
   


<<<<<<< Updated upstream
   $sql = "UPDATE `offer` SET `offerstatus`= 'rejected' WHERE `RequestID` = $id ";
=======
   $sql = "UPDATE `offer` SET `offerstatus`= 'rejected' WHERE `RequestID` = $id  AND `tutorName` <> 'name'";
>>>>>>> Stashed changes
   $result = mysqli_query($connection,$sql);
   
}