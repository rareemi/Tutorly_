<!DOCTYPE html>
<html>

    <head>
        <title>Edit Job Request</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../CSS_Files/jobRequestStyle.css">
        <link rel="stylesheet" href="../CSS_Files/common.css">
        <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

     <style>   html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    display: table;
}

footer {
    
    display: table-row;
    
}</style>
    </head>
    
    <body>
        
         <!--Upper Menue-->
         <?php include("parentHeader.php");
            include('../PHP_Files/connectDB.php');
        
         
            
            $query = "UPDATE requests SET `status` =  'expired' WHERE created_at < (NOW() - INTERVAL 1 HOUR) AND `status` = 'unserved'";
            $q3 = $result = mysqli_query($conn, $query);
            if($q3)
            echo "done3" ;
            ?>

<?php
session_start();
if(isset($_SESSION['editDone'])){
   
    echo '<script>alert("Edited successful!");</script>';
unset($_SESSION['editDone']);
}
        $pemail =  $_SESSION['email'];
        
           $sql = "SELECT `TypeOfClass`, `startTime`, `endTime`, `startDate`, `comments`, `ID` , `created_at` FROM  `requests` WHERE `status` = 'unserved' AND `parentEmail`= '$pemail '";

           $result = mysqli_query($conn,  $sql);
        
           $valu = mysqli_num_rows($result);
    
          
        ?>
                <div class="editingPage">
            <h2>Edit Job Request</h2>

     <?php 
    
     if($valu > 0 ){
    
    $x = 0;
    while($x< $valu  ){
    
     $row = mysqli_fetch_row($result);
     
     $TypeOfClass = key($row);
     next($row);
     
     $startTime = key($row);
     next($row);
     
     $endTime = key($row);
     next($row);
     
     $startDate = key($row);
     next($row);
     
     $comments = key($row);
     next($row);

     $id = key($row);
     next($row);
     
     $created_at = key($row);
     next($row);

     $kidss = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $row[$id]";
     $result2 = mysqli_query($conn, $kidss);
    ?> 

        <div class="container">


    <p class="canceledInfo">
    <label class="nameLabel">Kid/s : </label> <br>
<label class="Name"><?php 
while($kidrow = mysqli_fetch_row($result2)){
    $kname = key($kidrow);
    next($kidrow);

    $kAge = key($kidrow);
    next($kidrow);

    

     echo $kidrow[$kname].": ".$kidrow[$kAge]." Years<br>";
}
?></label> 

<?php echo(($row[$age]))?>
<br>
        <label class="serviceLabel">Type Of Class: </label>
        <label class="service"><?php echo(($row[$TypeOfClass]))?></label><br><br>

        <label class="dayLabel">Date: </label>
        <label class="day"><?php echo(($row[$startDate]))?></label><br><br>

        <label class="timeLabel">Time: </label>
        <label class="time"><?php echo(($row[$startTime])) ?> - <?php echo(($row[$endTime]))?></label>
        <br><br>
    
        <label class="commentsLabel">Comments: </label>
        <label class="comments"><?php echo(($row[$comments]))?></label> <br><br>
        <?php
  
  $date = $row[$created_at];
  $newDate = date('Y-m-d H:i:s', strtotime($date. ' + 1 hours'));

?>
        <label class="commentsLabel" style="color: red;">expier date: </label>
        <label id="demo" ><?php echo($newDate)?></label><br><br>

   
    <button class="Bottons editBotton" ><a href='../HTML_Files/editingJobRequest.php?id=<?php echo($row[$id])?>'>Edit Job Request</a></button>
    </p>

</div> <!-- end container -->
    
     <?php
     $x++; } 
    }//end if
    else{
    ?>
    
    <div >
    <div class="container">
        <h2>No posted job request yet </h2></div>
    <?php } ?>
    <!-- end copy -->
            </div> <!-- end container -->
        </div> <!-- end postingPage -->

        footer> 
       
      
    <p class = "p">
        <table>
            <tr>
         <th><a href="mailto:#" class = "con">ContactUs</a>  </th>
         <th><a href="aboutUs.html " class ="con">aboutUs</a>  </th>
         <th> <a href="FAQ.html" class = "con">FAQs</a> </th> 
            </tr> 
            </table> <br>
    
             <center > 
    
              
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
 <!-- end footer -->
    </body>

</html>