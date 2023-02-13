<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Booking</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
    <link rel ="stylesheet" type= "text/css" href="../css_files/TutorsOffers.css">
    <style>
       
	 html, body{
    display:inline-block;
     }
    footer{
    display:table;
     }
     </style>
    </head>
     
     <body>
     <?php include("../php_files/parentHeader.php");?>
     

        <h2> Current Booking</h2>
                
           
        <?php

         $servername= "localhost";
         $username= "root" ;
         $password= "";
         $dbname= "381" ;
         $connection= mysqli_connect($servername,$username,$password,$dbname);
         $database= mysqli_select_db($connection, $dbname);
         if (!$connection)
         die("Connection failed: " . mysqli_connect_error());
         $session_email= $_SESSION['email'];
         $sql = "SELECT * FROM `offer`  INNER JOIN requests
         ON requests.ID = offer.RequestID  INNER JOIN tutor
         ON tutor.email  = offer.tutorEmail   where requests.parentEmail='$session_email' and offer.offerstatus='accepted'";

         $userFound = mysqli_query($connection,$sql);
         if($userFound){

         if(mysqli_num_rows($userFound) > 0) {

         while ($row = mysqli_fetch_assoc($userFound)) {
           if ($row['startDate'] >= date('Y-m-d')) {
          ?>
             <div class="CurrentBooking"> 
                <p class="container" style="width:340px; height: auto;">
                 <img src="../images/<?php echo $row['img']; ?>" class="pic"  height="190" style="padding:20px;" alt="Tutor picture"><br>
                 
                  <label class="nameLabel">Tutor Name: </label><br>
                  <label class="Name"><?php echo $row['tutorName']; ?></label><br>
        
                  <label class="priceLabel"> Price: </label><br>
                  <label class="Price"> <?php echo $row['price']; ?> SR</label><br>
    
                  <label class="DateLabel"> Date: </label><br>
                  <label class="Date"><?php echo $row['startDate']; ?> </label><br>

                  <label class="TimeLabel"> Time: </label><br>
                  <label class="TimeLabel"> From: </label>
                  <label class="Time"> <?php echo $row['startTime']; ?></label><br>

                  <label class="TimeLabel"> To: </label>
                  <label class="Time"> <?php echo $row['endTime']; ?></label> <br><br>
                 
                 <a class ="email" href="mailto:<?php echo($row['tutorEmail']);?>; ?>">Send email</a>
                 
                 </p>
                 </div>
                 <?php }
            }
        }
   } ?>
   <br>
                
            <p><a class= "button1" style="margin-left:46%;" href="../php_files/HomePageParent.php">Back</a></p> <!-- This for back -->
            <br>
            <?php include("../php_files/footer.php");?>
     </body>
</html>