<?php
session_start();
error_reporting(E_ALL);
$servername= "localhost"; 
$username= "root" ;
$password= "";
$dbname= "381" ;
$connection= mysqli_connect($servername,$username,$password,$dbname);
$database= mysqli_select_db($connection, $dbname);
               
if (!$connection) 
die("Connection failed: " . mysqli_connect_error());
$fname_err = $lname_err = $gender_err = $id_err = $age_err = $email_err = $city_err = $phone_err = $password_err =  $msg_err = $notification = "";
if(isset($_POST['submit'])){
    
    

$loggedInUser = $_SESSION['email'];
$firstname  =    $_POST['firstname'];
$lastname =    $_POST['lastname'];
$gender =    $_POST['gender'];
$id =    $_POST['id'];
$age =    $_POST['age'];
$eMail =    $_POST['eMail'];
$city =    $_POST['city'];
$phone =    $_POST['phone'];
$bio =    $_POST['biotextbox'];

$userPassword =mysqli_real_escape_string($connection,$_POST['password']);


$fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    if (isset($_POST["gender"]))
        $gender = $_POST["gender"];
    
    $id = $_POST["id"];
    $age = $_POST["age"];
    $email = $_POST["eMail"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $msg = $_POST["biotextbox"];
    
    $valid = true;
    if ($fname == "" || !ctype_alpha(str_replace(" ", "", $fname))) {
        $fname_err = " please enter a valid name!";
        $valid = false;
    }
    if ($lname == "" || !ctype_alpha(str_replace(" ", "", $lname))) {
        $lname_err = " please enter a valid name!";
        $valid = false;
    }
    if ($email == "" || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $email_err = " please enter a valid email!";
        $valid = false;
    }

    if ($password!=""&&strlen($password) < 6) {
        $password_err = " password needs to be at least 6 characters!";
        $valid = false;
    }
    if ($city == "" || !ctype_alpha(str_replace(" ", "", $city))) {
        $city_err = " please enter a valid city!";
        $valid = false;
    }

    if(!preg_match("/[a-zA-Z]/i", $msg)){
        $msg_err = " please enter a valid bio (must contain letters)!";
        $valid = false;
    }
    if (!preg_match("/^05\d{8}$/", $phone)) {
        $phone_err = " please enter a valid phone number (must start with 05)!";
        $valid = false;
    }
    if($email!=$_SESSION['email']){
    $sql = "SELECT email FROM `tutor` WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $nummy=mysqli_num_rows($result);
    
    if ($nummy > 0) {
        $email_err = " this email is already registered, please enter a different email!";
        $valid = false;
    }}
    
    if (!preg_match("/^\\d+$/", $id)) {
        $id_err = " please enter a valid id!";
        $valid = false;
    }
    
    
     
if ($valid) {
    $_SESSION['email']=$eMail;
    $_SESSION['firstName']=$fname;
if($_FILES['img']['name']!=""){
    $userImage    =   $_FILES['img'];   
    $imageName = $userImage ['name'];
    $fileType  = $userImage['type'];
    $fileSize  = $userImage['size'];
    $fileTmpName = $userImage['tmp_name'];
    $fileError = $userImage['error'];
    
    $fileImageData = explode('/',$fileType);
    $fileExtension = $fileImageData[count($fileImageData)-1];
    
    if($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg'){
       
        
        if($fileSize < 6161400){ 
    
            $fileNewName = "../images/".$imageName; //
            
            $uploaded = move_uploaded_file($fileTmpName,$fileNewName);
            
            if($uploaded){
                

if(isset($_POST['password']) && $_POST['password']!= ""){
$userPassword =mysqli_real_escape_string($connection,$_POST['password']);
$sql = "UPDATE `tutor` SET firstName = '$firstname',lastName= '$lastname', email ='$eMail'
,gender='$gender',ID='$id',age='$age',city='$city',phone='$phone',bio='$bio', img='$imageName',password ='$userPassword' WHERE email = '$loggedInUser'";
}else{
    $sql = "UPDATE `tutor` SET firstName = '$firstname',lastName= '$lastname', email ='$eMail'
    ,gender='$gender',ID='$id',age='$age',city='$city',phone='$phone',bio='$bio', img='$imageName' WHERE email = '$loggedInUser'";
}
    
                $results = mysqli_query($connection,$sql);
                echo '<script>alert("Your edits has been sent successfully!");window.location.href="EditProfileTutor.php";</script>';
            exit;
            }
    
    
        }}}

        if(isset($_POST['password']) && $_POST['password']!= ""){
            $sql = "UPDATE `tutor` SET firstName = '$firstname',lastName= '$lastname', email ='$eMail'
            ,gender='$gender',ID='$id',age='$age',city='$city',phone='$phone',bio='$bio',password ='$userPassword' WHERE email = '$loggedInUser'";

            }else{
                $sql = "UPDATE `tutor` SET firstName = '$firstname',lastName= '$lastname', email ='$eMail'
                ,gender='$gender',ID='$id',age='$age',city='$city',phone='$phone',bio='$bio' WHERE email = '$loggedInUser'";
                
            }
            $results = mysqli_query($connection,$sql);
            echo '<script>alert("Your edits has been sent successfully!");window.location.href="EditProfileTutor.php";</script>';
            exit;

}}
?>
<?php include ("../php_files/tutorHeader.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Tutor</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">


    
    
     </head>
     <style>
        html, body{
    display:inline-block;
     }
    footer{
    display:table;
     }
     .holder{
     width: 800px;
     height: 1400px;
     margin:0.5%
     padding: 15px;
     } 
     
     
     .detail{
        height: 1366px;
        width: 800px;
        text-align: center;
        margin: -3.5%;
     }
     #button2{
        padding: 15px;
        margin: 10%;

     }
     
</style>
     <body>
        
        <h2>
            Edit Profile
        </h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <?php $currentUser = $_SESSION['email'];
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
                
                <div class="forthepic">
                    <img class = "pic"src="../images/<?php echo $row['img']; ?>" class="TutorPic" <?php echo $row['img']; ?> alt="Tutor Picture" height="250"><br>
                    <p>Upload a different photo:</p>
    </div>
<input type="file" accept="image/*" name="img">                       
   
                     <br>  
                     <label for="firstname">First Name:</label><span style="color:red"><?php echo $fname_err; ?> </span><br>
                <input type="text"  id="firstname" name="firstname" placeholder="Enter your first name"
                value="<?php echo $row['firstName']; ?>"><br>
            
                <label for="lastname">Last Name:</label><span style="color:red"><?php echo $lname_err; ?> </span>
                <br><input type="text" id="lastname" name="lastname" placeholder="Enter your last name"
                value="<?php echo $row['lastName']; ?>">
                <br>

            <label for="id">ID: </label><span style="color:red;"><?php echo $id_err; ?> </span><br>
            <input type="text" id="id" name="id"  placeholder="example:1126354857"
            value="<?php echo $row['ID']; ?>"><br>

            <label for="age">Age: </label><span style="color:red;">  </span><br>
            <input type="text" id="age" name="age"  placeholder="30"
            value="<?php echo $row['age']; ?>"><br>

            <label>Gender:</label>
           <br>
                <input type="radio" name="gender" value="male"<?php if (isset($row['gender']) && strtolower($row['gender'])=="male") echo "checked";?>> Male
                <input type="radio" name="gender" value="female"<?php if (isset($row['gender']) && strtolower($row['gender'])=="female") echo "checked";?>> Female

                <br> <label for="eMail">Email:</label><span style="color:red"> <?php echo $email_err; ?></span><br>
                <?php
if(isset($_GET['error'])){

if($_GET['error'] == 'emailDup'){
    ?>
    <span style="color:red;">
    
    the email you entered was already registered, please enter a different email!
</span>
    
<?php
}}

?>
                <input type="email" class="inputing-text" id="eMail" name="eMail" placeholder=" example:a@gmail.com" 
                value="<?php echo $row['email']; ?>"><br>
                   

            <br> <label for="phone">Phone:</label><span style="color:red;"> <?php echo $phone_err; ?> </span><br>
            <input type="text" id="phone" name="phone" placeholder="+966 5*****" onblur="myFunction()"
                value="<?php echo $row['phone']; ?>">
                <script>
   var errordet=false;
function myFunction() {
    var phoneno =/^05\d{8}$/;
  if(!document.getElementById("phone").value.match(phoneno))

        {
            alert("gjnkfd");global errordet=true;
            var x = document.getElementById("redfff");
  x.innerHTML="invalid phone number";
        }else{
            global errordet=false;
            var x = document.getElementById("redfff");
  x.innerHTML="";

        }
  
}
fuction geterrdet(){
    c=global errordet;
    return c;
}
</script>
                <br>
        

            <label for="password">Password:</label><span style="color:red"> <?php echo $password_err; ?></span><br>
                <input type="password" class="inputing-text" id="password" name="password" placeholder="  at least 6 characters ">
                <p class="more-space-on-bottom"></p>

                <br>
                
                <label >City:</label><br><span style="color:red"> <?php echo $city_err; ?></span>
                    <input type="text" class="inputing-text" id="city" name= "city" placeholder=" example:Riyadh"
                    value="<?php echo $row['city']; ?>">

            <br> <label for="bio">Bio:</label><span style="color:red;"> <?php echo $msg_err; ?></span> </span><br>
           <textarea name="biotextbox" id="bio" name="bio" rows="10" placeholder=" Enter your bio, such as: years of experience, education, languages spoken, skills, etc">
           <?php echo $row['bio']; ?>
                </textarea>
<br>

        
               <!----> <input class="botton-bigger" type="submit" name="submit" onclick="return geterrdet()" value="Update" />
<a class= "button1" href="../php_files/HomePageTutor.php">Back</a>

</p>                    
</div>
                  
               
     
            <a class= "button1" id="button2" href="../php_files/DeletProfileTutor.php" style="margin-left: 15%;">Delete Profile</a>
                <br><br>
                </div> 
        
                <?php
}}}  ?>
    
    <br><br><?php include ("../php_files/footer.php"); ?>

     </body>

</html>







