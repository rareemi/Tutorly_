<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous jobs</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
    <link rel ="stylesheet" type= "text/css" href="/css_files/TutorsOffers.css">
 
    </head>
     
     <body>
     <?php include("../php_files/tutorHeader.php");?>

        
            <h2>Previous jobs</h2>
              
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
         ON requests.ID = offer.RequestID INNER JOIN parent
         ON parent.email  = requests.parentEmail   where offer.tutorEmail ='$session_email' and offer.offerstatus='accepted'";
         
         $userFound = mysqli_query($connection,$sql);
         if($userFound) {
            if (mysqli_num_rows($userFound) > 0) {
                while ($row = mysqli_fetch_assoc($userFound)) {
                    if (date('Y-m-d') > $row['date']) {
        ?>  


                <div class="Previousjobs">
                    <p class="container" style="width: 320px; height: 540px;">
                     <img src="../public/userImages/<?php echo $row['img']; ?>" class="pic" height="190" alt="Tutor picture"><br>

                     <?php $id= $row['ID'];
                     $sql_kids = "SELECT * FROM `kids`   where ID ='$id' ";

                     $userFound_kids = mysqli_query($connection,$sql_kids);
                     if($userFound_kids) {
                        if (mysqli_num_rows($userFound_kids) > 0) {

                     // while ($row_kids = mysqli_fetch_assoc($userFound_kids)) {
                        ?>

                        <label class="nameLabel">Kids Name: </label><br>
                        <label class="Name"><?php echo mysqli_num_rows($userFound_kids); ?></label><br>

              
                    <?php //}
                }
            } ?>
                      
            
                     <label class="PriceLabel"> Type Of Class: </label><br>
                     <label class="Price"><?php echo $row['TypeOfClass']; ?> </label><br>

                     <label class="priceLabel"> Price: </label><br>
                     <label class="Price"><?php echo $row['price'];?>SR</label><br>

                     <label class="DateLabel">Date</label><br>
                     <label class="Date"><?php echo $row['date'];?></label><br>
    
                     <label class="DurationLabel"> Duration: </label><br>
                     <label class="Duration"><?php echo $row['Duration']; ?></label> <br><br>

                     <a class ="email" href="mailto:<?php echo($row['parentEmail']);?>; ?>">Contact with parent</a>
                     </p>
                     <?php }
}
}
}?>
                </div>
                <br>
                <p><a class= "button1" href="/html_files/HomePageTutor.html">Back</a></p>
                <br>

                <?php include("../php_files/footer.php");?>
         </body>
    </html>