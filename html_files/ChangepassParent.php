<?php include ("../php_files/parentHeader.php"); ?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Change Password</title>
<link rel ="stylesheet" type= "text/css"
 href="../css_files/common.css">

 
 <style>
    .holder{
    width: 700px;
}
 .p{
    border-radius: 20px;
 }   
 </style>
 </head>
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
    <a class= "button1" href="/html_files/EditProfileParent.html">Back</a> 
</p>


</div>
<?php include ("../php_files/footer.php"); ?>

   
</html>
