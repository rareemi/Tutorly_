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
    <script> add_more_fields() </script>
         <!--Upper Menue-->
    <?php include("parentHeader.php"); ?>


<?php
session_start();
        include('../php_files/connectDB.php');
        $pemail =  $_SESSION['email'];
        if(isset($_GET['id'])){
            // echo("set");
               $id2 = mysqli_real_escape_string($connection,$_GET['id']);
           $sql = "SELECT `TypeOfClass`, `ID`, `startTime`, `endTime`, `startDate`, `comments` FROM  `requests` WHERE `ID` = '$id2'";

           $result = mysqli_query($connection,  $sql);
        //  $offers = mysqli_fetch_all($result, MYSQLI_ASSOC);
           $valu = mysqli_num_rows($result);
        }

           //$sql2 = "SELECT `ID`, `kidName`, `kidAge` FROM `kids` WHERE `requests`.`ID` = `kids`.`ID`";
           //$result2 = mysqli_query($connection,  $sql2);
           //$valu2 = mysqli_num_rows($result2);
        ?>
                <div class="editingPage">
            <h2>Edit Job Request</h2>

     <?php 
    
     if($valu > 0 ){
    
    //$x = 0;
    //while($x< $valu  ){
    
     $row = mysqli_fetch_row($result);
     
     $TypeOfClass = key($row);
     next($row);

     $id = key($row);
     next($row);

     $startDate = key($row);
     next($row);

     $startTime = key($row);
     next($row);
     
     $endTime = key($row);
     next($row);
     
     $comments = key($row);
     next($row);
     
     $kids2 = "SELECT `kidName`,`kidAge` FROM `kids` WHERE `kids`.`ID` = $row[$id]";
     $result2 = mysqli_query($connection, $kids2);
    ?> 

        <div class="container" style="height:auto; width:40%; margin-left:30%;">

        <form action="../php_files/editingRequestprosses.php" method="post">
    <p class="canceledInfo">

    <div id="kids_info">
                    <label class="nameLabel"> Kid/s Name: <span class="errspan" style="color:red;font-size: 15px;"><?php  if(isset($_SESSION['nameErr'])) echo $_SESSION['nameErr']; ?></span>
                    </label>
                    
                    <label class="ageLabel" style="float: right; margin-right: 190px" > Kid/s Age: 
                    </label>
                    
                    <script type="text/javascript">
function add_more_fields (kidName , kidAge){
  var nameField = document.createElement('input');
  var ageField = document.createElement('input');

  nameField.setAttribute('type','text');
  nameField.setAttribute('name','kidsname[]');
  nameField.setAttribute('class','inputExtraName');
  nameField.setAttribute('size',50);
  nameField.setAttribute('placeholder','Enter Kid/s name');
  nameField.setAttribute('value',kidName);
  kids_info.appendChild(nameField);


  ageField.setAttribute('type','number');
  ageField.setAttribute('name','kidsage[]');
  ageField.setAttribute('class','inputExtraAge');
  ageField.setAttribute('size',50);
  ageField.setAttribute('placeholder','Enter Kid/s age');
  ageField.setAttribute('value',kidAge);
  ageField.setAttribute('min',0);
  ageField.setAttribute('max',17);
  kids_info.appendChild(ageField);
}
</script>



<label class="Name"> <br><?php 
while($kidrow = mysqli_fetch_row($result2)){
    $kname = key($kidrow);
    next($kidrow);

    $kAge = key($kidrow);
    next($kidrow);

    //$ages[] = $kidrow[$kAge];
    
    ?>
        <script>
        var n = "<?php echo $kidrow[$kname] ?>" ; 
        var a = "<?php echo $kidrow[$kAge] ?>"; 
</script>
    <?php
echo '<script type="text/javascript">add_more_fields(n, a);</script>';
?>

                       <!-- <input class="inputExtraName" name="kidsname[]" type="text" placeholder="Enter Kid Name" value="<?php echo $kidrow[$kname] ?>" required> 
                        <input class="inputExtraAge" name="kidsage[]" type="number" min="0" max="17" placeholder="Enter Kid Age" value="<?php echo $kidrow[$kAge] ?>" required> -->


   <?php // echo $kidrow[$kname].": ".$kidrow[$kAge]." Years<br>";
}
?></label> <!-- <br><br> --> 
</div>
<!--<label class="ageLabel">Kid/s Ages: </label>
<label class="age"><?php echo(($row[$age]))?></label><br><br> -->

<div class="controls">
                          <a href="#" id="add_more_fields" size="50"><i class="fa fa-plus"></i></a>
                          <a href="#" id="remove_fields" style="float: right; margin-right: 13px"><i class="fa fa-minus"></i></a>
                          <p style="margin-left: 140px;">Select + to add child, - to remove child</p>
                        </div>

                       

                <label class="serviceLabel"> Type Of Class: <span class="errspan" style="color:red;font-size: 15px;"><?php  if(isset($_SESSION['ClassErr'])) echo $_SESSION['ClassErr']; ?></span>
                    <input class="inptService" name="Class" type="text" value="<?php echo(($row[$TypeOfClass]))?>" required> 
                </label>
                
                <label class="durationLabel"> Duration: <br> <span class="errspan" style="color:red;font-size: 15px;"><?php  if(isset($_SESSION['timeErr'])) echo $_SESSION['timeErr']; ?></span> <br>
                    Day:<input class="inputDay" name="day" type="date" value="<?php echo(($row[$startDate]))?>" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required > </label>
                <label class="durationLabel"> From: <input class="inputFromTime" name="from_time" type="time" value="<?php echo(($row[$startTime]))?>" required > </label>
                <label class="durationLabel"> To: <input class="inpuToTime" name="to_time" type="time" value="<?php echo(($row[$endTime]))?>" required> </label>
                <br><br>
                <label class="commentsLabel"> Add Comments: (optional)
                    <textarea class="commentsArea" name="comments" cols="72" rows="6" value="<?php echo(($row[$comments]))?>"><?php if( $row[$comments] != "no comment added" ) echo(($row[$comments]));?></textarea>
                </label>
                <br>
                <input  name="idReq" type="hidden" value="<?php echo($id2)?>"/>
                <input class="Botton resetBotton" type="submit" onclick="location.href ='editRequest.php';" value="go back" style="left: 10px;">

                <input type="submit" class="Botton editingBotton" style="position: relative;
    left: 10px;
    height: 30px;
    width: 265px;
    direction: none;" value="Edit"  name="editsubmit"/>

</p></form>

</div> <!-- end container -->
    
     <?php

    // $x++; } 
    unset($_SESSION['nameErr']);
    unset($_SESSION['servesErr']);
    unset($_SESSION['timeErr']);
  }//end if
    else{
    ?>
    
    <div >
    <div class="container">
        <h2>No posted job request yet </h2></div>
    <?php } ?>
    <!-- end copy -->
       <!-- <div class="cancelPage">
            <h2>Cancel Job Request</h2>

            <div class="container">

            <form action="#" method="post">

                <p class="canceledInfo">
                    <label class="nameLabel">Kid/s Name: </label>
                    <label class="name">Abdullah</label><br><br>
                    
                    <label class="ageLabel">Kid/s Age: </label>
                    <label class="age">5</label><br><br>
            
                    <label class="serviceLabel">Type Of Service: </label>
                    <label class="service">Child care</label><br><br>
            
                    <label class="dayLabel">Day: </label>
                    <label class="day">1/10/2022 </label><br><br>
            
                    <label class="timeLabel">Time: </label>
                    <label class="time">7:00PM - 9:00PM </label>
                    <br><br>
                
                    <label class="commentsLabel">Comments: </label>
                    <label class="comments">No comment added </label> <br><br><br><br>

                <input type="button" class="Bottons cancelBotton" value="Cancel Job Request"/>

                </p>
            </form> -->
            </div> <!-- end container -->
        </div> <!-- end postingPage -->

        <?php include("../php_files/footer.php");?>
         <!-- end footer -->

            <script src="addKids.js"></script>
            <script>
            var kids_info = document.getElementById('kids_info');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');
var input_id = document.getElementById('newInput'); 
remove_fields.onclick = function(){
  var input_tags = kids_info.getElementsByTagName('input');
  if(input_tags.length > 2) {
    kids_info.removeChild(input_tags[(input_tags.length) - 1]);
    kids_info.removeChild(input_tags[(input_tags.length) - 1]);
  }
  // if(input_id.length > 2 ){
    input_id.removeChild(input_id[(input_id.length) - 1]);
    input_id.removeChild(input_id[(input_id.length) - 1]);
 // }
}</script>

    </body>

</html>