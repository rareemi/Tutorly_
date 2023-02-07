<?php
session_start();
/* require ("../php_files/query.php");
$requests = get_requests($_SESSION['email']); */

?>

<?php include ("../php_files/tutorHeader.php"); ?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Change Photo</title>
<link rel ="stylesheet" type= "text/css"
 href="/css_files/common.css">
 
 <style>
    .Submit{
background-color: #98C1D9;}
#upload,#uploadlabel{
    background-color: #98C1D9;
}
 </style>
    </head>
 <body>

    
<h2>
 
    Change Profile Photo
</h2>
<div class="container">
Uploud Photo
<img class = "pic" src="../images/TutorPic1.png"  alt="Profile Picture" height="250"><br>
<label for="upload" id="uploadlabel">chose Photo</label>
<input type="file" id="upload">

<input type="submit" value="Submit">
<a class= "button1" href="/html_files/EditProfileTutor.html">Back</a>




</div>









<?php include ("../php_files/footer.php"); ?>



</html>
