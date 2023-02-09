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
<html lang ="en">
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile Tutor</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">>
     
     <link rel ="stylesheet" type= "text/css" href="../css_files/ViewProfileTutor.css">
     </html>
</head>
<style>

.profile-pic-div{
    height: 200px;
    width: 200px;
    margin-left: 300px;
    margin-bottom: -23px;
padding: 5px;
    bottom: 10px;
    transform: translate(-35%,-1%);
    border-radius: 50%;
    overflow: hidden;
    border: 1px solid grey;
}

#photo{
    height: 100%;
    width: 100%;
}
#but{
    margin-left: 3px;

}

</style>
     <body>
       
        <h2>
            View Profile 

        </h2>
        <?php
                
                $currentUser = $_SESSION['email'];
                //print($_SESSION['email']);
                $sql = "SELECT * FROM `tutor` WHERE email ='$currentUser'";

                $gotResuslts = mysqli_query($connection,$sql);

                if($gotResuslts){
                    if(mysqli_num_rows($gotResuslts)>0){
                        while($row = mysqli_fetch_array($gotResuslts)){
                            //print_r("ygbyb8yn".$row['email']);
                        ?>
            <div class="holder"> 
                <div class = "detail"> 

                <div class="profile-pic-div">
               <img src="../images/TutorPic1.png"<?php echo $row['img']; ?> id="photo"  alt="Tutor Picture" height="250"></div><br>

                       <p class="needs-container"> First Name: <span class="par"><?php echo $row['firstName']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>
            <p class="needs-container">
                Last Name:
                <span class="par"> <?php echo $row['lastName']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>
            <p class="needs-container"> ID:
                <span class="par"><?php echo $row['ID']; ?></span>
            </p>
            <p class="needs-container"> Age:
                <span class="par"><?php echo $row['age']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>

            <p class="needs-container"> Gender: <span class="par"><?php echo $row['gender']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>
            <p class="needs-container"> Email:
            <span class="par"><?php echo $row['email']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>
            <p class="needs-container"> Phone:
                <span class="par"><?php echo $row['phone']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>

            <p class="needs-container"> City:
                <span class="par"><?php echo $row['city']; ?></span>
            </p>
            <p class="more-space-on-bottom"></p>

            <p class="bio-par"> Bio:
                <span class="par">
                <?php echo $row['bio']; ?>
                </span>
            </p>
<a class= "button1" id="but" href="../php_files/HomePageTutor.php">back</a>
                </p>
                     </p>  </div> 
                     <?php
}}}  ?>
<br><br><br>
                     <?php include ("../php_files/footer.php"); ?>

     </body>
</html>







