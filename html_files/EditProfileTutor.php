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
    <title>Edit Profile Tutor</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">

    
     </html>
     </head>
     <style>
     .holder{

     width: 800px;
     height: 1150px;
     } 
     .change{text-decoration: underline;
     }
     .detail{
        height: 1110px;
       
        text-align: center;
        width: 750px;
        margin: 1%;
     }</style>
     <body>
        
        <h2>
            Edit Profile
        </h2>

      
            <div class="holder"> 
                <p class = "detail"> 
                <img class = "pic"src="../images/TutorPic1.png" class="TutorPic" alt="Tutor Picture" height="250"><br>
                     <a class= "changephoto" href="/html_files/changePhotoTutor.html" id="7" style="margin-left:0;" >Change Photo</a>
                   

                 <br>  
            <label for="FName">First Name:</label><br>
            <input type="text" id="FName" name="FName" value="Lama"><br>
        
            <label for="LName">Last Name:</label><br>
            <input type="text" id="LName" name="LName" value="Ahmed"><br>

            <label for="id">ID: </label><br>
            <input type="text" id="id" name="idd" value="******"><br>

            <label for="Age">Age: </label><br>
            <input type="text" id="Age" name="age" value="30"><br>

            <label for="Gender">Gender: </label><br>
            <input type="text" id="Gender" name="gender" value="Female"><br>

            <br> <label for="email">E-mail:</label><br>
            <input type="text" id="email" name="email" value="****@gmail.com"><br>
        
            <br> <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="email" value="+966 5*****"><br>
        

            <label for="pass">Password:</label><br>
            <input type="text" id="pass" name="pass" value="******">
            <br>
            <a class ="change" href ="/html_files/changePassTutor.html">Change password</a>
            <br> <label for="city">City:</label><br>
            <input type="text" id="city" name="city" value="Riyadh">

            <br> <label for="bio">Bio:</label><br>
            <input type="text" id="bio" name="Bio" value="******"><br>

           
        
            <input type="submit" value="Submit">
<a class= "button1" href="/html_files/HomePageTutor.html">Back</a>

                     </p>  </div>
                    

        <h5>
            <a class= "button1" href="/html_files/DeletProfileTutor.html" style="margin-left: 43%;">Delete Profile</a>
                <br><br>
           
        </h5>

        <?php include ("../php_files/footer.php"); ?>

     </body>

</html>







