



<?php include ("../php_files/parentHeader.php")?>
<!DOCTYPE html>
<html> <!-- comment -->
<head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Requests</title>
<link rel="stylesheet" type= "text/css" href="/css_files/sendoffer.css">
<link rel="stylesheet" type= "text/css" href="/css_files/common.css">
<link rel="stylesheet" type="text/css" href="/css_files/RequestOffers.css">
</head>










<body>

    <h2> Posting Requests</h2>
    <div class = "holder2"> 
        <p class ="req3">
         <label class = "titleLabell" > Fill this Info :</label><br> 
     <label for="name" class="nameLabel">Kid/s name/s: </label>
        <input id="name" type="text" placeholder = "add , between each name" required>
    
     <label for="age" class="ageLabel">Age/s: </label>
        <input id= "age" type="text" required>
     <br>
     <label for="type" class="classLabel">Type Of Class:</label>
        <input id="type" type="text" required> 
     <label for= "duration" class="durationLabel">Duration: </label><br>
     <input id="duration" type="text" placeholder="in format (hours/days)" required>
     <!--<input id="duration" type="date" required>
        <input id="duration" type="date" required>-->
     <br>
     
     <a class= "post" href="#">Post</a> 
        </p>
     
     
         </div>


         <?php include ("../php_files/footer.php")?>
</div>
</body>

</html>