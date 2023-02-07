<!DOCTYPE html>

<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Tutor</title>
<link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
<link rel ="stylesheet" type= "text/css" href="../css_files/review&rate.css">
<style> label,p,b{
  background-color:#98C1D9;
}
  t {background-color:#98C1D9;
  text-decoration: underline;}
  </style>
    </head>

    <body>
    <h2>Login</h2>
    <div class="containers"style="width:70% ; height:80% ; ">
    <div style="width:40%;float:left; margin:0 36px ;background-color:#C4DCEA;border-radius:20px;" >
    <img src = "../images/logo4.png" class ="logo"  alt="logo"style="width:100%;float:left;background-color:#C4DCEA;border-radius:20px;"  >
    </div>
    <div style="width:30%; margin-left:50%; ">
    <form action="loginprosses.php" method="post">
                        <?php
if(isset($_GET['error'])){

if($_GET['error'] == 'failToLogIn'){
    ?>
    <div class="alert alert-danger" role="alert">
    Wrong email/password, please enter a correct one!
</div>
    <!--<small class="in-log-in">Please Enter correct email and password</small>-->
    
<?php
}}

?>
         
          <label for="email">E-mail: </label><br>
          <input type="text" id="email" name="email" required><br>
          <label for="pass">Password:</label><br>
          <input type="password" id="pass" name="pass" required>

          <br> <br>
          <input type="submit" name="submit" value="Login" style="width: 40%;">
  
      
          <br>   <br>  <br>  <br> <p> <a href="ForgetPassTuter.html"><t> Forget Password? </t></a></p> <br>
          <p>you don't have an acc? <a href="SignUpTutor.html"> <t>Sign up </t></a></p>
        </form></div>
        </div>

           <hr> 
        
           <?php include("footer.php");?>
  
        </body>

</html>