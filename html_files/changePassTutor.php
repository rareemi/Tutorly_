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
<title> Change Password</title>
<link rel ="stylesheet" type= "text/css"
 href="/css_files/common.css">

 </head>
 <style>
    .holder{
    width: 700px;}
    
 </style>
 <body>
    
    
<h2>
            Change Password
                    </h2>
                   
                    <div class="holder"> 
                        <p>
                        <label for="cpass"> Enter your Current Password:</label><br>
                        <input type="text" id="cpass" name="cpass" value="******"><br>

                            <label for="npass"> Enter Your New Password:</label><br>
                            <input type="text" id="npass" name="npass" value="******"><br>
                            <input type="submit" value="Submit">
                            <a class= "button1" href="/html_files/EditProfileTutor.html">Back</a> </p>
    
                   </div>


</div>

<?php include ("../php_files/footer.php"); ?>

                
             </body>
        </html>