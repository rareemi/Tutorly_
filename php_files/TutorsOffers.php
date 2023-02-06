<?php
session_start();
/* require ("../php_files/query.php");
$requests = get_requests($_SESSION['email']); */

?>

<?php include ("../php_files/parentHeader.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutors Offers</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">
    <link rel ="stylesheet" type="text/css" href = "../css_files/TutorsOffers.css">
</head>
<body>
  
 
    <h2>Tutors Offers</h2><br><br>
    
<div class= "TutorsOffers"> 
    

<?php

$servername= "localhost";
$username= "root" ;
$password= "";
$dbname= "381" ;
$connection= mysqli_connect($servername,$username,$password,$dbname);
$database= mysqli_select_db($connection, $dbname);
if (!$connection)
die("Connection failed: " . mysqli_connect_error());
$session_email= $_SESSION['email'];
$sql = "SELECT * FROM `offer`  INNER JOIN requests
ON requests.ID = offer.RequestID  INNER JOIN tutor
ON tutor.email  = offer.tutorEmail   where requests.parentEmail='$session_email' and offer.offerstatus='accepted'";

$userFound = mysqli_query($connection,$sql);
if($userFound){

if(mysqli_num_rows($userFound) > 0) {

while ($row = mysqli_fetch_assoc($userFound)) {
  if ($row['data'] >= date('Y-m-d')) {
 ?>

<p class="offer">
<img src="../public/userImages/<?php echo $row['img']; ?>"  class="pic" height="190" alt="Tutor picture"><br>

    <label class="nameLabel">Tutor Name: </label><br>
    <label class="Name"><?php echo $row['tutorName']; ?></label><br>
        
<br>
<label class="priceLabel"> Price: </label><br>
<label class="Price"> <?php echo $row['price']; ?> SR</label><br>
    <br><br>
<a class ="profile" href="../html_files/ShowTutorProfile.html">Show Profile</a><br><br>
<br>

</p>
<?php }
            }
        }
   } ?>
</div>

<?php include ("../php_files/footer.php"); ?>

</body>
</html>