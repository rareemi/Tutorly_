<?php include ("../php_files/parentHeader.php"); ?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Change Photo</title>
<link rel ="stylesheet" type= "text/css"
 href="../css_files/common.css">
 
 <style>
    .Submit,.bac{
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
<div class = "pic">
<img  src="../images/TutorPic1.png" id="photo" alt="Profile Picture" height="250"><br>
<label for="file" id="uploadlabel">chose Photo</label>
<input type="file" id="upload" >
<br>
    <input type="submit" value="Submit">
    <br><br>
    <a class= "button1" href="/html_files/EditProfileParent.html" style="margin-left: 0;">Back</a>


</div>

</div>

<script src ="ChangePhoto.js" ></script>






    
<?php include ("../php_files/footer.php"); ?>



</html>
 