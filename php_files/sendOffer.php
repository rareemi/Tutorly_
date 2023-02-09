<?php
session_start();
//
print_r($_GET);



if(isset($_GET['offer_submit'])){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "381";
    
    if (!$connection= mysqli_connect($servername,$username,$password)) 
    die("Connection failed: " . mysqli_connect_error());
    
    if(!$database= mysqli_select_db($connection, $dbname))
    die("Could not open database failed: " . mysqli_connect_error());

   if(isset($_GET['OfferPrice']) && isset($_GET['id']) && isset($_GET['day'])&& isset($_GET['fromTime'])&& isset($_GET['toTime'])){

        $OfferPrice = $_GET['OfferPrice'];;
        $id =  $_GET['id'];
        $oDay = $_GET['day'];
        $oTime1 = $_GET['fromTime'];
        $oTime2 = $_GET['toTime']; 
        //echo $oTime1;
        $tutoremail =  $_SESSION['email'] ;

        //chech conflect

        $conflect = false;
        $error_m = '';
        //add constrain same day
       $sql = "SELECT `startTime` , `endTime` FROM `offer` WHERE `tutorEmail` = '$tutoremail' AND NOT `offerstatus` = 'rejected' AND `startDate` = '$oDay'";
        $query = mysqli_query($connection,$sql);
        if( $query ){
        while($row = mysqli_fetch_row($query)){
    $sTime = key($row);
    next($row);

    $eTime = key($row);
    next($row);

     //echo $row[$eTime].": ".$row[$sTime]."<br>";

     if( (strtotime($oTime1) >= strtotime($row[$sTime]) && strtotime($oTime1) <= strtotime($row[$eTime])) ||
         (strtotime($oTime2) >= strtotime($row[$sTime]) && strtotime($oTime2) <= strtotime($row[$eTime])) ||
         (strtotime($row[$sTime]) >= strtotime($oTime1) && strtotime($row[$sTime]) <= strtotime($oTime2)) ||
         (strtotime($row[$eTime]) >= strtotime($oTime1) && strtotime($row[$eTime]) <= strtotime($oTime2))) {
     $conflect = true; 
     $_SESSION['ERROR2'] = "it is error";

     header("Location:../php_files/RequestList.php");
      exit;
      
     } 
        }
//if no conflect 
$tutorname = $_SESSION['firstName'];

$sql = "INSERT INTO `offer`(`id`, `price`, `tutorName`, `RequestID`, `offerstatus`, `tutorEmail`, `startDate` `startTime`, `endTime`) VALUES ( NULL ,'$OfferPrice','$tutorname','$id','pending','$tutoremail','$oDay','$oTime1' , '$oTime2' )";
$query = mysqli_query($connection,$sql);
if( $query ){
    $_SESSION['Correct'] = "it is correct";  
    header("Location:../php_files/RequestList.php");
}
else{
    echo 'fail';
    
    }

    }
}
}
?>
