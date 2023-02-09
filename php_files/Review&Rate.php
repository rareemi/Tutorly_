<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Review &amp; Rate </title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
	<link rel ="stylesheet" type= "text/css" href="../css_files/review&rate.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
    function validateform(){
        var feedBack=document.myform.feedBack.value;
        if(feedBack == null || feedBack == ""){
            $('#feedabk_val').show();
            return false;
        } else {
            $('#feedabk_val').hide();
        }
    }
    </script>
    </head>

     <body>
     <?php include("../php_files/parentHeader.php");?>
		

        <h2> Review &amp; Rate </h2>

        <div class="review" style="height:400px; ">
            
        <?php
         $servername= "localhost";
         $username= "root" ;
         $password= "";
         $dbname= "381" ;
         $connection= mysqli_connect($servername,$username,$password,$dbname);
         $database= mysqli_select_db($connection, $dbname);
         if (!$connection)
         die("Connection failed: " . mysqli_connect_error());

         $id_offer = $_GET['id_offer'];
         $parentEmail = $_SESSION['email'];
         
         $sql_email = "select count(*) as cunt from review where parentEmail ='$parentEmail' and offerID ='$id_offer'";
         //$result = $userFound = mysqli_query($connection,$sql_email );
         
         $result = $connection->query($sql_email);
         while ($row = $result->fetch_assoc()) {
            if ($row['cunt'] > 0) {?>
            <div style=" text-align:center; color:red;background-color: #98C1D9; font-size: 17px"> <?php echo "Tutor already Reviewed\n"; ?> </div>
            
            <?php } else {
                
                if (isset($_POST['add'])) {
                    $feedBack = addslashes($_POST['feedBack']);
                    $Rate = addslashes($_POST['star']);
                    $Date_ = date('Y-m-d');
                    $time_ = date('H:i');
                    $tutorEmail = $_GET['tutorEmail'];
                    $id_offer = $_GET['id_offer'];
                    $parentEmail = $_SESSION['email'];
                    
                    $sql = "INSERT INTO review " . "(feedBack, Rate, Date,time ,tutorEmail,parentEmail,offerID
                    ) " . "VALUES('$feedBack','$Rate','$Date_','$time_','$tutorEmail','$parentEmail','$id_offer')";
                    
                    if ($connection->query($sql) === TRUE) { ?>
                    
                    <div style="text-align: center;color: green;background-color: #98C1D9;font-size: 20px !important;"> <?php echo "Entered data successfully\n"; ?> </div>
                    
                    <?php } else {
                        echo "Error: " . $sql . "<br>" . $connection->error;}
                        ?>
                    <?php
                }
             }
        }?>

	     <form method = "post"  action = "<?php $_PHP_SELF ?>" name="myform" id="myform" onsubmit="return validateform()">
         <?php

                $id=$_GET['tutorEmail'];
                $sql_view = "SELECT * FROM `offer`   INNER JOIN tutor
                ON tutor.email = offer.tutorEmail  where offer.id='$id'";
                
                $userFound = mysqli_query($connection,$sql_view);
                if($userFound) {
                    if (mysqli_num_rows($userFound) > 0) {
                        while ($row1 = mysqli_fetch_assoc($userFound)) {
              ?>

                <img src="../public/userImages/<?php echo $row['img']; ?>" class="pic"  alt="Tutor picture">

            <?php }
            }
        } ?>

        <br>
        
          <label>Rate:</label>
          <div class="stars">
            <input required class="star star-5" id="star-5-2" type="radio" name="star" value="5"<?php if (isset($_POST["star"]) && $_POST["star"] == "5") echo "checked"; ?>>
            <label class="star star-5" for="star-5-2"><span class="tooltip" style="top: 12%;right: 45%; ">Excellent</span></label>
            
            <input required class="star star-4" id="star-4-2" type="radio" name="star" value="4"<?php if (isset($_POST["star"]) && $_POST["star"] == "4") echo "checked"; ?>>
            <label class="star star-4" for="star-4-2"><span class="tooltip" style="top: 12%;right: 45%; ">Very Good</span></label>
            
            <input required class="star star-3" id="star-3-2" type="radio" name="star" value="3"<?php if (isset($_POST["star"]) && $_POST["star"] == "3") echo "checked"; ?>>
            <label class="star star-3" for="star-3-2"><span class="tooltip" style="top: 12%;right: 45%; ">Average</span></label>
            
            <input required class="star star-2" id="star-2-2" type="radio" name="star" value="2"<?php if (isset($_POST["star"]) && $_POST["star"] == "2") echo "checked"; ?>>
            <label class="star star-2" for="star-2-2"><span class="tooltip" style="top: 12%;right: 45%; ">Poor</span></label>
            
            <input required class="star star-1" id="star-1-2" type="radio" name="star" value="1"<?php if (isset($_POST["star"]) && $_POST["star"] == "1") echo "checked"; ?>>
            <label class="star star-1" for="star-1-2"><span class="tooltip" style="top: 12%;right: 45%; ">Terrible</span></label>
            
            </div>
    
          <br><br>
  
          <label >give feedback:</label><br><br>
          <textarea  placeholder="Write .." name="feedBack"> </textarea>
          <br><br>
	      <input type="submit" value="Submit" name="add">
    
         </form>
        </div>
        <p><a class= "button1" style="margin-left:46%;" href="../php_files/PreviousBooking.php">Back</a></p>
        <br><br>

        <?php include("../php_files/footer.php");?>
     </body>
</html>