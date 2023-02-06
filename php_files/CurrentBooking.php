<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Booking</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
    <link rel ="stylesheet" type= "text/css" href="../css_files/TutorsOffers.css">
    </head>
     
     <body>
     <?php include("../php_files/parentHeader.php");?>
     

        <h2> Current Booking</h2>
                
            <div class="CurrentBooking">
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
           if ($row['data'] >= date('Y-m-d')) {
          ?>

                <p class="container" style="width: 320px; height: 540px;">
                 <img src="../public/userImages/<?php echo $row['img']; ?>"  class="pic" height="190" alt="Tutor picture"><br>
                 
                  <label class="nameLabel">Tutor Name: </label><br>
                  <label class="Name"><?php echo $row['tutorName']; ?></label><br>
        
                  <label class="priceLabel"> Price: </label><br>
                  <label class="Price"> <?php echo $row['price']; ?> SR</label><br>
    
                  <label class="DateLabel">Date: </label><br>
                  <label class="Date"><?php echo $row['date']; ?></label><br>
        
                  <label class="DurationLabel"> Duration: </label><br>
                  <label class="Duration"><?php echo $row['Duration']; ?></label> <br><br>
                 
                 <a class ="email" href="mailto:<?php echo($row['tutorEmail']);?>; ?>">Send email</a>
                 
                 </p>
                 <?php }
            }
        }
   } ?>
            </div>
                
            <p><a class= "button1" href="../html_files/HomePageParent.html">Back</a></p> <!-- This for back -->
            <br>
           <footer > 
        
        <p class = "p">
            <table>
                <tr>
             <th><a href="#" class = "con">ContactUs</a>  </th>
             <th><a href="aboutUs.html " class ="con">aboutUs</a>  </th>
             <th> <a href="/html_files/FAQ.html" class = "con">FAQs</a> </th> 
                </tr> 
                </table> <br>
        
                 <center> 
        
                  
                    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                               
                    
                    <a href="https://twitter.com" target="_blank" class = "ionicons">
                                
                        <ion-icon name="logo-twitter"></ion-icon> </a>
                            
                                <a href = "https://whatsapp.com" target="_blank" class = "ionicons">
                                    <ion-icon name="logo-whatsapp"></ion-icon>
                                </a>
                                <a href="https://instagram.com" target="_blank" class = "ionicons">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>
                    
                                <a href="https://snapchat.com" target="_blank" class = "ionicons">
                                    <ion-icon name="logo-snapchat"></ion-icon> <br> <br>
                                </a>
                    
                                &copy; A  Tutorly, 2022
                                </center>
                                
                                 
                       
                            </p>
                    
                        </footer>
     </body>
</html>