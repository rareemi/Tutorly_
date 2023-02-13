<?php
session_start();
require("../PHP_Files/query.php");
$rates = get_rates($_SESSION["email"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- drop down menu insted of stars-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css_files/common.css">
    <link rel = "stylesheet" type = "text/css" href = "../css_files/ShowTutorProfile.css">
  

    <title>Show Tutor Profile</title>
    <style>
    .checked {
                    content:'\f005';
                    color: yellow;}
                </style>
</head>

<body>
   <?php include ("../php_files/parentHeader.php");
   
 if(!isset($_GET['id'])) {
    header('Location:/BabySitterProject/HTML_Files/offerDetails.php');
    exit;
  }
  include ("../php_files/connectDB.php");
  $email = $_GET['em']; 
$sql = "SELECT `img`,`firstName`,`lastName`,`age`,`city`,`bio`,`phone` FROM `tutor` WHERE `email` = '$email' ";
$result = mysqli_query($connection,  $sql);
$row = mysqli_fetch_row($result);

$image = key($row);
next($row);

$fname = key($row);
next($row);

$lname = key($row);
next($row);

$age = key($row);
next($row);

$city = key($row);
next($row);

$bio = key($row);
next($row);

$phone = key($row);
next($row);
  
  ?>
    <h2> Show Tutor Profile</h2> <br>

    
    <div class="holder" style="background-color: #98C1D9;"> 
<img class = "pic"src="../images/TutorPic1.png<?php echo($row[$image ]);?>" class="TutorPic" alt="Tutor Picture" height="250">
     <p class = "detail" style="background-color: #98C1D9;">  <label class="nameLabel" >Tutor Name: </label><label class="Name" ><?php echo($row[$fname])?>  <?php echo($row[$lname]) ?></label><br>
        <label class="ratingLabel">Age: </label><label class="Rate"><?php echo($row[$age])?> Years Old</label><br>
        <label class="yearLabel">City: </label><label class="year"><?php echo($row[$city])?></label><br>
        <label class="bioLabel">Bio: </label><label class="bio"> <?php echo($row[$bio])?></label>
<br>
     </p>  </div>
    <!--End of image&name-->
    


   
<br><br>

        <h2>Reviews &amp Rating</h2>
     <div>
        <?php 
        $q2 = "SELECT `feedBack`,`Rate`,`Date`,`time`,`parentEmail` FROM `review` WHERE `tutorEmail` = '$email'";

        $result2 = mysqli_query($connection,  $q2);

        $total5s = 0;
        $total4s = 0;
        $total3s = 0;
        $total2s = 0;
        $total1s = 0;
        $totalnumOfRates = 0;
      
        while(  $row2 = mysqli_fetch_row($result2) ){
          $review = key($row2);
          next($row2);
  
          $tutorRate = key($row2);
          next($row2);
  
  
          $Date = key($row2);
          next($row2);
  
  
          $time = key($row2);
          next($row2);
  
          $pEmail = key($row2);
          next($row2);
  
  
        
        
        ?>
  




<div class = "holder2"> 
    <p class = "rev"> 
  
                <?php 
                 $totalnumOfRates++;

                 switch($row2[$tutorRate ]){
                    case 5: $total5s++; break;
                    case 4: $total4s++; break;
                    case 3: $total3s++; break;
                    case 2: $total2s++; break;
                    case 1: $total1s++; break;
                 }
                 $q3 = "SELECT `firstName` FROM `parent` INNER JOIN `review` WHERE `parent`.`email` = '$row2[$pEmail]' ";
                 $result3 = mysqli_query($connection,  $q3);
                 $row3 = mysqli_fetch_row($result3);
                 $em = key($row3);
     
                 echo($row3[$em]); print("  ,  ");
                 echo($row2[$Date]);print("  ,  ");
                 echo($row2[$time]);;echo(" <br>");
                echo($row2[$review]);



                ?>

                </div>

                <?php } // close while loop 
                  if(mysqli_num_rows( $result2) == 0){
                    echo("<h3 style=' margin-left: 15px;'>No Reviews yet </h3>");
                }
                ?>
                <div class = "holder2">
                    <?php 
                $rateSum = (5*$total5s)+(4*$total4s)+(3*$total3s)+(2*$total2s)+(1*$total1s);

        if($totalnumOfRates != 0){
         $finalRate = $rateSum/$totalnumOfRates;
         settype($finalRate ,"integer");
    
        
       

        $count = 0;
        echo("<i class='fa-solid fa-star fa-2x checked'></i>");
        while($count < $finalRate){
            echo("<i class='fa-solid fa-star fa-2x checked'></i>");
            $count++;
        }
    }
    else
    echo("<h3 style=' margin-left: 15px;'>No Rating </h3>");
        
        ?>
           </div>     
       <!-- <label class = "titleLabel">Review</label><br> 
        <label class="Name">She is such an amazing and incredible teacher</label><br>
        <label class="nameLabel">by Aleen</label> -->
        <br>
    </p><br>
    </p>

    
</p>
   

    <!--End of Reviews-->


        <h2>Contact &amp; Interview</h2> <br>

<div class = "holder3">


<?php 

$reqID = $_GET['id'];
$q3 = "SELECT  `price`  FROM  `offer` WHERE `tutorEmail` = '$email' AND `RequestID` =$reqID ";
$result3 = mysqli_query($connection,  $q3);
$row3 = mysqli_fetch_row($result3);
$pr = key($row3);
?>

<!--    <label><?php echo($row3[$pr])?> SAR/hr</label> -->
    <a class = "call" href="tel:<?php echo($row[$phone ]);?>">call <?php echo($row[$fname]) ?><i class="fa-solid fa-phone fa-lg" style="color: white"></i></a>
    <a class= "msg" href="https://api.whatsapp.com/send/?phone=<?php echo($row[$phone ]);?>&text=hi&type=phone_number&app_absent=0'target='_blank">message <?php echo($row[$fname]) ?><i class="fa-brands fa-whatsapp fa-lg" style="color: white;"></i></a>



</div>
<br>

</div>



<?php include("../php_files/footer.php"); ?>

  
   <br>



</body>
</html>