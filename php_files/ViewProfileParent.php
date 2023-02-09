<?php
	session_start();
$servername= "localhost";
$username= "root" ;
$password= "";
$dbname= "381" ;
$connection= mysqli_connect($servername,$username,$password,$dbname);
$database= mysqli_select_db($connection, $dbname);
               
if (!$connection) 
die("Connection failed: " . mysqli_connect_error());?>
<?php
 include ("../php_files/parentHeader.php"); ?>

<!DOCTYPE html>
<html lang ="en">
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile Parent</title>
    <link rel ="stylesheet" type= "text/css"
     href="../css_files/common.css">
     <link rel ="stylesheet" type= "text/css"
     href="../css_files/ViewProfileParent.css">
</head>
<style>
 
 .profile-pic-div{
    height: 200px;
    width: 200px;
    margin-left: 300px;
    margin-bottom: -23px;
padding: 5px;
    bottom: 10px;
    transform: translate(-50%,-1%);
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
                $sql = "SELECT * FROM `parent` WHERE email ='$currentUser'";

                $gotResuslts = mysqli_query($connection,$sql);

                if($gotResuslts){
                    if(mysqli_num_rows($gotResuslts)>0){
                        while($row = mysqli_fetch_array($gotResuslts)){
                            //print_r("ygbyb8yn".$row['email']);
                        ?>

            <div class="holder"> 
                <div class = "detail"> 
                <div class="profile-pic-div">
               <img src="../images/<?php echo $row['img']; ?>" id="photo" alt="Parent Picture" height="250"></div><br>

               <p class="needs-container"> First Name: <span class="par"><?php echo $row['firstName']; ?></span>
                </p>
            <p class="more-space-on-bottom" ></p>
            <p class="needs-container"> 
            Last Name:
            <span class="par"> <?php echo $row['lastName']; ?></span></p>
            <p class="more-space-on-bottom" ></p>

            <p class="needs-container"> Email:
            <span class="par"><?php echo $row['email']; ?></span></p>
            <p class="more-space-on-bottom" ></p>

                <p class="needs-container">City: <span class="par"><?php echo $row['city']; ?></span>
                <p class="more-space-on-bottom" ></p>

                <p class="needs-container">Location: <span class="par"><?php echo $row['Location']; ?></span>
<br>
<br>
<a class= "button1" id="but" href="../php_files/HomePageParent.php">back</a>

</div>
                     </p>  </div>
       <?php
                        }}}
                        ?>
                     <?php include ("../php_files/footer.php"); ?>


     </body>
</html>







