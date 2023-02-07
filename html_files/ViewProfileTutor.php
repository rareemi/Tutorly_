<?php
session_start();
/* require ("../php_files/query.php");
$requests = get_requests($_SESSION['email']); */

?>

<?php include ("../php_files/tutorHeader.php"); 
if(!isset($_GET['id'])) {
    header('Location:http:Tutorly_/php_Files/OfferDetails.php');
    exit;
} 

include('../PHP_Files/connect_db.php');
 $email = $_GET['em']; 
$sql = "SELECT `img`,`firstName`,`lastName`,`age`,`city`,`bio`,`phone` FROM `babysitter` WHERE `email` = '$email' ";
$result = mysqli_query($connection,  $sql);
$row = mysqli_fetch_row($result);

$image = key($row);
next($row);

$fname = key($row);
next($row);

$lname = key($row);
next($row);

$age = key($row);
next($row);

$city = key($row);
next($row);

$bio = key($row);
next($row);

$phone = key($row);
next($row);
  ?>  
 

<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile Tutor</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">>
     
     <link rel ="stylesheet" type= "text/css" href="../css_files/ViewProfileTutor.css">
     </html>
     
     <body>
       
        <h2>
            View Profile

        </h2>
       
            <!--<div class="holder"> 
                <p class = "detail"> 
                <img class = "pic"src="../images/TutorPic1.png" alt="Tutor Picture" height="250"><br>
                       <label class="nameLabel">First Name: </label><label class="Name"></label>lama </label>
                        <br>
                        <br>
                        
                          <label class="nameLabel">Last Name: </label><label class="Name"></label>ahmed </label><br> <br> 
                          <label class="id">ID: </label><label class="ID">*******</label>
                          <br>
                          <br>
                          <label class="AGE">Age: </label><label class="age">30</label>
<br>
<br>
<label class="gender">Gender: </label><label class="Gender">Female</label>
<br>
<br>
                        <label class="e-mail">E-mail: </label><label class="email">***@gmail.com</label>
                <br>
                <br>
                <label class="phone">Phone: </label><label class="PHONE">+966 5*****</label>
                <br>
                <br>

                <label class="citylabel">City: </label><label class="city">Riyadh</label>
<br>
<br>

<label class="bio">Bio: </label><label class="BIO">***********</label>
<br>
<br>
<a class= "button1" href="/html_files/HomePageTutor.html">back</a>
                </p>
                     </p>  </div> -->
       
                     <?php include ("../php_files/footer.php"); ?>

     </body>
</html>







</html>