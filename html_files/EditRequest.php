<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Requests</title>
    <link rel = "stylesheet" href="../css_files/common.css">
    <link rel="stylesheet" type= "text/css" href="/css_files/RequestOffers.css">
<link rel="stylesheet" type= "text/css" href="/css_files/sendoffer.css">

</head>








<body>


    <?php include ("../php_files/parentHeader.php")?>
    <h2> Edit Requests</h2>  

    

    <div class = "holder2"> 
        <p class ="req3" style="height: 540px;">
       <!---  <label class = "titleLabell" > </label><br> -->
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
     <a class ="Offer1" href="#">Edit</a>
     <a class ="Offer1" href="#">Delete</a>
        </p>
     
     
         </div>

         <?php include ("../php_files/footer.php")?>

</body>






</html>