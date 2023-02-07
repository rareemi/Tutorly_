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
    <title>Home Page Tutor</title>
    
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">

     
     </html>
     <style>
        h1{
color: #293241;;
text-align: center;
padding: 16px;
font-size: 90px; 
font-weight: bolder;
margin: 2px;
 cursor: pointer; }
    </style>
     
     <body>
       
     <h1>
      <br>  Welcome to Tutorly
     </h1>
    

     <?php include ("../php_files/footer.php"); ?>
        </body>
</html>


