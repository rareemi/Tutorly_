<?php
	session_start();
$servername= "localhost";
$username= "root" ;
$password= "";
$dbname= "381" ;
$connection= mysqli_connect($servername,$username,$password,$dbname);
$database= mysqli_select_db($connection, $dbname);
               
    if (!$connection) 
    die("Connection failed: " . mysqli_connect_error());
     ?>


<?php include ("../php_files/tutorHeader.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Delete Tutor Profile </title>
<link rel ="stylesheet" type="text/css" href = "../css_files/common.css">

 
 </head>
 <body>
   
    
<h2>

      Delete Profile
                </h2>
                
                <div class="holder">
        <form action="../html_files/index.html" method="POST" enctype="multipart/form-data">
            
            <label for="password">Please enter your password to delete your account:</label>
            <?php
if(isset($_GET['error'])){

if($_GET['error'] == 'failToDelete'){
    ?>
    
    <span style="color:red;">
    <br>
    please enter correct password
</span>
    
<?php
}
elseif($_GET['error'] == 'acceptedOffer'){
    ?>
    
    <span style="color:red;">
    <br>
    you have an accepted offer that has not came yet you are unable to delete your account
</span>
    
<?php

}}
?>
            
            <input type="password" class="inputing-text" id="password" name="uPassword" placeholder="Enter your password" required>
            <p id="onlyDelNow"class="more-space-on-bottom"></p>

            <input class="botton-bigger" type="submit" onclick="return confirm('Are you sure you want to delete your account ?')" name="submit" value="delete account" />
        </form>
    </div>
                








<?php include ("../php_files/footer.php"); ?>
          
</body>
</html>


