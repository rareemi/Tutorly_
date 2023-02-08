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
  .more-space-on-bottom {
    display: block;
    margin-bottom: 20px;
    margin-top: 20px;
}
.needs-container {
    font-size: larger;
    height: 30px;
width: 580px;
display: block;
margin-top: 10px;
margin-bottom: 10px;
background-clip: padding-box;
border-radius: 0.25rem;
padding: .375rem .75rem;
font-weight: 650;
}
.bio-par {
    font-size:  larger;
    height:  100px;
width:  580px;
display: block;
margin-top:  10px;
margin-bottom:  10px;
background-clip:  padding-box;
border-radius:  0.25rem;
padding:  .375rem .75rem;
overflow:  auto;
font-weight: 650;
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
                <div class="forthepic">
               <img class = "pic"src="../images/<?php echo $row['img']; ?> ?>"alt="Parent Picture" height="250"></div><br>

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
<a class= "button1" href="../php_files/HomePageParent.php">back</a>

</div>
                     </p>  </div>
       <?php
                        }}}
                        ?>
                     <?php include ("../php_files/footer.php"); ?>


     </body>
</html>






