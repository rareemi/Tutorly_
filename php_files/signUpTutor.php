<?php
require("query.php");
$fname_err = $lname_err = $gender_err = $id_err = $age_err = $email_err = $city_err = $phone_err = $password_err =  $msg_err = $notification = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname_err = $lname_err = $gender_err = $id_err = $age_err = $email_err = $city_err = $phone_err = $password_err =  $msg_err = $notification = "";

    $fname = validate($_POST["FName"]);
    $lname = validate($_POST["LName"]);
    if (isset($_POST["gender"]))
        $gender = $_POST["gender"];
    else
        $gender = "";
    $id = validate($_POST["id"]);
    $age = validate($_POST["age"]);
    $email = validate($_POST["email"]);
    $city = validate($_POST["city"]);
    $phone = validate($_POST["phone"]);
    $password = validate($_POST["pass"]);
    $msg = validate($_POST["bio"]);

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
     
    if ($password == "") {
        $password_err = " please enter a valid password!";
        $valid = false;
    }
    if (strlen($password) < 6) {
        $password_err = " password needs to be at least 6 characters!";
        $valid = false;
    }
    if ($city == "" || !ctype_alpha(str_replace(" ", "", $city))) {
        $city_err = " please enter a valid city!";
        $valid = false;
    }
    if ($gender == "") {
        $gender_err = " please select a gender!";
        $valid = false;
    }
    if ($age == "") {
        $age_err = " please enter a valid age number!";
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
    if ($id == "") {
        $id_err = " please enter a valid id!";
        $valid = false;
    }

    if (get_tutor_email($email) > 0) {
        $email_err = " this email is already registered, please enter a different email!";
        $valid = false;
    }
    
    if (get_parent_email($email) > 0) {
        $email_err = " this email is already registered, please enter a different email!";
        $valid = false;
    }
    

    
    // dd();
    if ($valid) {
        $userImage = $_FILES['img'];
        $imageName = $userImage['name'];
        if ($imageName == "")
            $imageName = "defultpico.jpg";

        if (tutor_signup_handler($email, $password, $fname, $lname, $gender, $id, $age, $city, $phone, $msg, $imageName)) {
            $notification = 'Registration successful!';
            $_POST["FName"] == $_POST["LName"] = $_POST["gender"] = $_POST["age"] = $_POST["id"] = $_POST["email"] = $_POST["password"] = $_POST["city"] = $_POST["phone"] = $_POST["bio"] = "";

//            $target_dir = "../public/userImages/";
//            $target_file = $target_dir . basename($_FILES["img"]["name"]);
//            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

            $fileTmpName = $userImage['tmp_name'];
            $fileNewName = "../images/".$imageName;
            $uploaded = move_uploaded_file($fileTmpName,$fileNewName);


            $_POST["FName"] == $_POST["LName"] = $_POST["gender"] = $_POST["age"] = $_POST["id"] = $_POST["email"] = $_POST["pass"] = $_POST["city"] = $_POST["phone"] = $_POST["bio"] = "";
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
   <title> Sign Up Tutor</title>
   <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
   <link rel ="stylesheet" type= "text/css" href="../css_files/review&rate.css">
</head>
<body>
  <header>
    <img src = "../images/logo.png" class ="logo" width = "400px"  height= "400px" alt="logo" style="margin: 2px 34%;" >
    <style> label,p,b,span{
      background-color:#98C1D9;}
      t {background-color:#98C1D9;
      text-decoration: underline;}
</style>
</header>
<h2>Sign up as a Tutor: </h2><br><br>
<div class="containers" style="width: 650px ; height:1200px ;">

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                    <p style="font-size:18px"><span style="color:red"> * </span>Mandatory field</p>
                    <label for="FName">First Name:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $fname_err; ?></span></label><br>
                    <input required type="text" id="FName" name="FName" value="<?php if (isset($_POST["FName"])) echo $_POST["FName"]; ?>"><br><br>

                    <label for="LName">Last Name:<span style="color:red"> * </span><span style="color:red;font-size: 15px;"><?php echo $lname_err; ?></span></label><br>
                    <input required type="text" id="LName" name="LName"value="<?php if (isset($_POST["LName"])) echo $_POST["LName"]; ?>"><br><br>

                    <label>Gender:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $gender_err; ?></span></label><br>

                    <input required type="radio" name="gender" value="male" <?php if (isset($_POST["gender"]) && $_POST["gender"] == "male") echo "checked"; ?>> <label style="margin-right: 15%;">Male</label>
                    <input required type="radio" name="gender" value="female" <?php if (isset($_POST["gender"]) && $_POST["gender"] == "female") echo "checked"; ?>> <label style="margin-right: 15%;">Female</label>
                    
                    <br><br>
                    <label for="Tid">ID :<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $id_err; ?></span></label><br>
                    <input required type="text"  id="id"  pattern="[0-9]{10}" name="id" value="<?php if (isset($_POST["id"])) echo $_POST["id"]; ?>"><br><br>

                    <label for="Tid">Age :<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $age_err; ?></span></label><br>
                    <input required type="text" min="18" max="120" id="age" name="age" value="<?php if (isset($_POST["age"])) echo $_POST["age"]; ?>"><br><br>

                    <label for="email">E-mail:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $email_err; ?></span></label><br>
                    <input required type="text" id="email" name="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>"><br><br>

                    <label for="city">City:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $city_err; ?></span></label><br>
                    <input required type="text" id="city" name="city" value="<?php if (isset($_POST["city"])) echo $_POST["city"]; ?>"><br><br>

                    <label for="phone">Phone number:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $phone_err; ?></span></label><br>
                    <input required type="text" id="phone" pattern="[0-9]{10}" name="phone" value="<?php if (isset($_POST["phone"])) echo $_POST["phone"]; ?>"><br><br>

                    <label for="pass">Password:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $password_err; ?></span></label><br>
                    <input required type="password" id="pass" name="pass" value="<?php if (isset($_POST["password"])) echo $_POST["pass"]; ?>"><br><br>

                    <label for="bio"> Bio:<span style="color:red"> * </span><span class="errspan" style="color:red;font-size: 15px;"><?php echo $msg_err; ?></span></label><br>
                    <input required type="text" id="bio" name="bio" value="<?php if (isset($_POST["bio"])) echo $_POST["bio"]; ?>"><br> <br>

                    <img src="../images/TutorPic1.png" class="pic" style="height:90px; margin-left: 100px;"  alt="defult picture"><br>
                    <p>upload picture: (optional)</p>
                    <input type="file" accept="image/*" name="img"> 

                    <br><br>
                    <input type="Reset" value="Clear" style="width: 40%; margin:8px 6%; background-color: #7290a2 ; font-size: 19px;">
                    <input type="submit" value="Sign Up" style="width: 40%;">
    </form>
</div>
<?php include("../php_files/footer.php");?>
     </body>
     
     </html>