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
$fname_err = $lname_err = $email_err = $password_err = $city_err  = "";

if(isset($_POST['submit'])){
    
    $loggedInUser = $_SESSION['email'];
    $firstname  =    $_POST['firstname'];
    $lastname =    $_POST['lastname'];
    $City =    $_POST['city'];
    $eMail =    $_POST['eMail'];
   
    $userPassword =mysqli_real_escape_string($connection,$_POST['password']);

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['eMail'];
    $password = $_POST["password"];
    //$confirmpassword= validate($_POST["confirmpassword"]);
    $city = $_POST['city'];
    if (isset($_POST["Location"]))
        $location = $_POST['Location'];
    

    $valid = true;
    if ($fname == "" || !ctype_alpha(str_replace(" ", "", $fname))) {
        $fname_err = " please enter a valid name!";
        $valid = false;
    }
    if ($lname == "" || !ctype_alpha(str_replace(" ", "", $lname))) {
        $lname_err = " please enter a valid name!";
        $valid = false;
    }
    if ($email == ""|| !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $email_err = " please enter a valid email!";
        $valid = false;
    }
   
   
    if ($password!=""&&strlen($password) < 6) {
        $password_err = " password needs to be at least 6 characters! ";
        $valid = false;
    }
    if ($city == "" || !ctype_alpha(str_replace(" ", "", $city))) {
        $city_err = " please enter a valid city!";
        $valid = false;
    }
    

    
    
    if($email!=$_SESSION['email']){
        $sql = "SELECT email FROM `parent` WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);
        $nummy=mysqli_num_rows($result);
        
        if ($nummy > 0) {
            $email_err = " this email is already registered, please enter a different email!";
            $valid = false;
        }}
    
     
    
    
    //if(isset($_POST['password']) && $_POST['password']!= "")
    //$userPassword = password_hash(mysqli_real_escape_string($connection,$_POST['password']), PASSWORD_DEFAULT,array("cost" => 10)); 
    
    
    if ($valid){
        $_SESSION['email']=$eMail;
        $_SESSION['firstName']=$fname;
        if($_FILES['img']['name']!=""){
            //print_r($_FILES['img']);
            $userImage    =   $_FILES['img'];   
            $imageName = $userImage ['name'];
            $fileType  = $userImage['type'];
            $fileSize  = $userImage['size'];
            $fileTmpName = $userImage['tmp_name'];
            $fileError = $userImage['error'];
            
            $fileImageData = explode('/',$fileType);
            $fileExtension = $fileImageData[count($fileImageData)-1];
            
            //echo  $fileExtension;
            if($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg'){
                //Process Image
                
                if($fileSize < 6161400){
                    //var_dump(basename($imageName));
            
                    $fileNewName = "../images/".$imageName;
                    
                    $uploaded = move_uploaded_file($fileTmpName,$fileNewName);
                    
                    if($uploaded){
                        
        
        if(isset($_POST['password']) && $_POST['password']!= ""){
        //$userPassword = password_hash(mysqli_real_escape_string($connection,$_POST['password']), PASSWORD_DEFAULT);
        $userPassword =mysqli_real_escape_string($connection,$_POST['password']);
        $sql = "UPDATE `parent` SET `email` = '$eMail', `firstName` = '$firstname', `lastName` = '$lastname',
         `city` = '$City', `Location` = '$location',`img` = '$imageName',password ='$userPassword' WHERE email = '$loggedInUser'";
        
        }else{
            $sql = "UPDATE `parent` SET `email` = '$eMail', `firstName` = '$firstname', `lastName` = '$lastname',
         `city` = '$City', `Location` = '$location',`img` = '$imageName',password ='$userPassword' WHERE email = '$loggedInUser'";
        }
                        $results = mysqli_query($connection,$sql);
                        echo '<script>alert("Your edits has been sent successfully!");window.location.href="EditProfileParent.php";</script>';
                    exit;
                    }
            
            
                }}}
        
                if(isset($_POST['password']) && $_POST['password']!= ""){
                    $sql = "UPDATE `parent` SET `email` = '$eMail', `firstName` = '$firstname', `lastName` = '$lastname',
         `city` = '$City', `Location` = '$location',password ='$userPassword' WHERE email = '$loggedInUser'";
                    $results = mysqli_query($connection,$sql);
                    echo '<script>alert("Your edits has been sent successfully!");window.location.href="EditProfileParent.php";</script>';
                    exit;
                    }else{
                        $sql = "UPDATE `parent` SET `email` = '$eMail', `firstName` = '$firstname', `lastName` = '$lastname',
         `city` = '$City', `Location` = '$location' WHERE email = '$loggedInUser'";
                       $results = mysqli_query($connection,$sql);
                       echo '<script>alert("Your edits has been sent successfully!");window.location.href="EditProfileParent.php";</script>';
                    exit; 
                    }
                    
                    $sql = "UPDATE `parent` SET `email` = '$eMail', `firstName` = '$firstname', `lastName` = '$lastname',
                    `City` = '$City', `location` = '$location' WHERE email = '$loggedInUser'";
                                   
                               
                    $results = mysqli_query($connection,$sql);
                    echo '<script>alert("Your edits has been sent successfully!");window.location.href="EditProfileParent.php";</script>';
                    exit;}}
     ?>


<?php include ("../php_files/parentHeader.php"); ?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Parent</title>
    <link rel ="stylesheet" type= "text/css"
     href="../css_files/common.css">
     
     
   
    <style>
        html, body{
    display:inline-block;
     }
    footer{
    display:table;
     }
        .holder{
        
        width: 720px;
        height: 850px;
       }
       
     .detail{
        text-align: center;
        height: 800px;       
        margin: -2% ;
     }
     #button2{
        padding: 15px;


     }
    </style>
     </head>
     <body>
        
        <h2>
                Edit Profile
            </h2>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>"method="POST" enctype="multipart/form-data">
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
                    
                    <div class="forthepic">
                    <img class = "pic"src="../images/<?php echo $row['img']; ?>" class="TutorPic" <?php echo $row['img']; ?> alt="Tutor Picture" height="250"><br>
                    <p>Upload a different photo:</p>

<input type="file" accept="image/*" name="img">                       
    </div>
                     <br>  
                     <label for="firstname">First Name:</label><span style="color:red"><?php echo $fname_err; ?> </span><br>
                <input type="text"  id="firstname" name="firstname" placeholder="Enter your first name"
                value="<?php echo $row['firstName']; ?>"><br>
            
                <label for="lastname">Last Name:</label><span style="color:red"><?php echo $lname_err; ?> </span>
                <br><input type="text" id="lastname" name="lastname" placeholder="Enter your last name"
                value="<?php echo $row['lastName']; ?>">

                <br> <label for="eMail">Email:</label><span style="color:red"> <?php echo $email_err; ?></span><br>
                <input type="email" class="inputing-text" id="eMail" name="eMail"placeholder=" example:a@gmail.com" 
                value="<?php echo $row['email']; ?>"><br>
            
                <label for="password">Password:</label><span style="color:red"> <?php echo $password_err; ?></span><br>
                <input type="password" class="inputing-text" id="password" name="password" placeholder="  at least 6 characters ">
                <p class="more-space-on-bottom"></p>
                <input class="botton-bigger" type="submit" name="submit" value="Update" />

                <br>
                
                <label >City:</label><br><span style="color:red"> <?php echo $city_err; ?></span>
                    <input type="text" class="inputing-text" id="loc" name= "city" placeholder=" example:Riyadh"
                    value="<?php echo $row['city']; ?>">

                <br> <label for="Location">Location:</label><br>
                <input type="text" id="Location" name="Location" placeholder="https://*******"
                value="<?php echo $row['Location']; ?>"><br>

               
            
                <input type="submit" value="Submit">
    <a class= "button1" href="../php_files/HomePageParent.php">Back</a>
    </div>
                        </div>

                       
                        
   
            <h5>
                
                <a class= "button1" href="../php_files/DeletProfileParent.php" style="margin-left: 40%;">Delete Profile</a>
                
 <?php }}}
                       ?>
            </h5>
            <br><br>

            <br>
 <br>
            <?php include ("../php_files/footer.php"); ?>

     </body>
</html>







