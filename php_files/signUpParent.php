<?php
require("query.php");
$fname_err = $lname_err = $email_err = $password_err = $city_err = $Location_Err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname_err = $lemail_err = $email_err = $password_err = $city_err = $Location_Err= "";

    $fname = validate($_POST["FName"]);
    $lname = validate($_POST["LName"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["pass"]);
    $city = validate($_POST["city"]);
    $Location = validate($_POST["Location"]);

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
    if ($password == "") {
        $password_err = " please enter a valid password!";
        $valid = false;
    }
    if($confirmpassword!==$password){
        $password_err = " please enter the same password!";
        $valid = false;
    }
    if (strlen($password) < 6) {
        $password_err = " password needs to be at least 6 characters! ";
        $valid = false;
    }
    if ($city == "" || !ctype_alpha(str_replace(" ", "", $city))) {
        $city_err = " please enter a valid city!";
        $valid = false;
    }
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$Location)) {
          $Location_Err = "Invalid URL";
        }
      
    if (get_parent_email($email) > 0) {
        $email_err = " this email is already registered, please enter a different email!";
        $valid = false;
    }
    
     if (get_tutor_email($email) > 0) {
        $email_err = " this email is already registered, please enter a different email!";
        $valid = false;
    }
    
    // dd($_FILES["img"]);
    if ($valid) {
        $userImage = $_FILES['img'];
        $imageName = $userImage['name'];
        if ($imageName == "")
            $imageName = "defultpico.jpg";

        if (parent_signup_handler($fname, $lname, $email, $password, $city, $Location,$imageName)) {
//            $notification = 'Registration successful!';
            $_POST["FName"] = $_POST["LName"] = $_POST["email"] = $_POST["pass"] = $_POST["city"] =$_POST["Location"]= "";

            $target_dir = "../public/userImages/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

            echo '<script>alert("Registration successful!");window.location.href="LoginPage.php";</script>';

        }
    }
}
?>
<!DOCTYPE html>
<html> 
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Sign Up Parent</title>
   <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
   <link rel ="stylesheet" type= "text/css" href="../css_files/review&rate.css">
</head>
<body>
  <header>
    <img src = "../images/logo.png" class ="logo" width = "400px"  height= "400px" alt="logo" style="margin: 2px 34%;" >
    <style> 
    label,p,b,span{
      background-color:#98C1D9;}
      t {background-color:#98C1D9;
      text-decoration: underline;}
</style>  
</header>
<h2>Sign up as a Parent</h2><br><br>
<div class="containers" style="width: 650px ; height:800px ;">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
<p style="font-size:18px"><span style="color:red"> * </span>Mandatory field</p>
<!--Labels-->
    <label for="FName">First Name:</label><span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $fname_err; ?></span><br>
    <input type="text" id="FName" name="FName"><br>

    <label for="LName">Last Name:</label><span style="color:red"> * </span><span style="color:red;font-size: 15px;"><?php echo $lname_err; ?></span><br>
    <input type="text" id="LName" name="LName">

    <br> <label for="email">E-mail:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $email_err; ?></span></label><br>
    <input type="text" id="email" name="email"><br>

    <label for="pass">Password:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $password_err; ?></span></label><br>
    <input type="text" id="pass" name="pass">

    <br> <label for="city">City:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $city_err; ?></span></label><br>
    <input type="text" id="city" name="city"><br>

<!--Location-->
<label>Enter  URL loaction:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $Location_Err; ?></span></label>
<input type="text" id="city" name="Loaction"><br><!--Photo--> 
<br>
<img src="../images/TutorPic1.png" class="pic" style="height:90px; margin-left: 100px;"  alt="defult picture"><br>
                    <p>upload picture: (optional)</p>
                    <input type="file" accept="image/*" name="img">
<!--Buttons-->
<br> <br> <br>
<input type="Reset" value="Clear" style="width: 40%; margin:8px 6%; background-color: #7290a2 ; font-size: 19px;">
                    <input type="submit" value="Sign Up" style="width: 40%;">

  </form> </div>
  
  <?php include("../php_files/footer.php");?>
</body>

</html>