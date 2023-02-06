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
  
 
    <h2>Tutor Profile</h2><br><br>
    
<div> 
<p class="offer">
    <img src="../images/TutorPic1.png" class="pic" height="190" alt = "Tutor Picture"><br>
<label class="nameLabel">Tutor Name: </label><br><label class="Name">Sara Mohammed</label><br>
<label class="ratingLabel">Rating: </label><br><label class="Rate">4.91</label>
<br>
<label class="priceLabel">Offerd Price: </label><br><label class="Price">200SR</label>
<br><br>
<a class ="profile" href="../html_files/ShowTutorProfile.html">Show Profile</a><br><br>
<br>

</p>

</div>
<?php include ("../php_files/footer.php"); ?>

</body>
</html>