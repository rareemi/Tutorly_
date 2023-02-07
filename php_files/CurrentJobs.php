<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Jobs</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
    <link rel ="stylesheet" type= "text/css" href="../css_files/TutorsOffers.css">
    

    </head>

     <body>
     <?php include("../php_files/tutorHeader.php");?>

            <h2> Current Jobs</h2>
            
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
             if($userFound){
                if (mysqli_num_rows($userFound) > 0) {
                    while ($row = mysqli_fetch_assoc($userFound)) {
                        if ($row['startDate'] >= date('Y-m-d')) {
            ?>
                
        <div class="CurrentJobs">
            <p class="container" style="width: 340px; height: 630px;">
             <img src="../images/<?php echo $row['img']; ?>" class="pic"  height="190" style="padding:20px;" alt="Tutor picture"><br>
             <?php $id= $row['ID'];
                    $sql_kids = "SELECT * FROM `kids`   where ID ='$id' ";
                    $userFound_kids = mysqli_query($connection,$sql_kids);
                    if($userFound_kids) {
                       if (mysqli_num_rows($userFound_kids) > 0) {

                       while($row_kids= mysqli_fetch_assoc($userFound_kids)){
                        if($id==$row_kids['ID']){
                            $name= $row_kids['kidName'];
                        }?>

                       <label class="nameLabel">Kids Name:</label><br>
                       <label class="Name"><?php echo $name; ?></label><br>
                   <?php 
               }
           }} ?>
           
              <label class="PriceLabel"> Type Of Class: </label><br>
              <label class="Price"><?php echo $row['TypeOfClass']; ?> </label><br>

              <label class="priceLabel"> Price: </label><br>
              <label class="Price"><?php echo $row['price'];?>SR</label><br>

              <label class="DateLabel">Date</label><br>
              <label class="Date"><?php echo $row['date'];?></label><br>
    
              <label class="DateLabel"> Date: </label>
              <label class="Date"><?php echo $row['startDate']; ?> </label>

              <label class="TimeLabel"> From: </label>
              <label class="Time"> <?php echo $row['startTime']; ?></label>

              <label class="TimeLabel"> To: </label>
              <label class="Time"> <?php echo $row['endTime']; ?></label><br>

             
             <a class ="email" href="mailto:<?php echo($row['parentEmail']);?>; ?>">Contact with parent</a>
             </p>
             <?php }
}
}
} ?>
        </div>
        <br>
        <p><a class= "button1" href="../html_files/HomePageTutor.php">Back</a></p> <!-- This for back -->
            <br>
            <?php include("../php_files/footer.php");?>
             
            
         </body>
    </html>