<?php
session_start();
$class_err = $form_day_err = $to_time_err = $kidName_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "381";
if (!$conn = mysqli_connect($servername, $username, $password, $dbname)) 
die("Connection failed: " . mysqli_connect_error());
if( isset($_POST['class']) && isset($_POST['form_day']) && isset($_POST['from_time']) && isset($_POST['to_time'])){
    $class = $_POST['class'];
    $form_day = $_POST['form_day'];
    $from_time = $_POST['from_time'];
    $to_time = $_POST['to_time'];


    $valid = true;
    if($class == " "){
        $class_err = " please enter the type of class!" ;
        $valid = false;
    }

    if(strtotime($to_time) <= strtotime($from_time)){
        $to_time_err = " please enter a valid time , second time must be greater than the first!" ;
        $valid = false;
    }

    $count = count($_POST["kidsname"]);
    for($x =0 ; $x < $count ; $x++) {
       $kidName = $_POST["kidsname"]["$x"];
       if($kidName == "" || !ctype_alpha(str_replace(" ", "", $kidName))){
       $kidName_err =" please enter a valid name!";
       $valid = false;}
    } 

    if ($valid) {
        if(!empty($_POST['comments']))
        $comments = $_POST['comments'];
        else
        $comments = "no comment added";

//not sure yet ! 
$name = $_SESSION['firstName'];
       // $city = $_SESSION['City'];
       // $district = $_SESSION['District'];
        $pemail =  $_SESSION['email'];

        $createdAt = $date = date('m/d/Y h:i:s', time());
//until here !

echo "$createdAt";
        $sql = "INSERT INTO `request` (`TypeOfClass`, `ID`, `status`,  `parentEmail`, `startDate`, `startTime`, `endTime`, `comments`, `created_at`) VALUES ('$class', NULL, 'unserved', '$pemail' ,  '$form_day', '$from_time', '$to_time', '$comments', now() )";

        $query = mysqli_query($conn,$sql);

        if( $query ){
            echo 'done1';
            
            //Insert ID
           $id = mysqli_insert_id($conn);
           print("Insert ID: ".$id ."\n");
            $count = count($_POST["kidsname"]);
            print("count: ". $count ."\n");
            for($x =0 ; $x < $count ; $x++) {
               $kidName = $_POST["kidsname"]["$x"];
               $kidAge = $_POST["kidsage"]["$x"];
                $sql = "INSERT INTO `kids` (`ID`, `kidName`, `kidAge`) VALUES ('$id', '$kidName', '$kidAge')";
                $query = mysqli_query($conn,$sql);
              }
              echo '<script>alert("Posted successful!");window.location.href="jobRequest.php";</script>';
    
        
        }
        else{
            echo 'fail';
            }  

}









}
}
?>



<!DOCTYPE html>
<html>

    <head>
        <title>Post Job Request</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="jobRequestStyle.css">
        <link rel="stylesheet" href="common.css">
        <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1"> 

    </head>
    
    <body>
        <header>
            <img src = "../images/logo.png" class ="logo" width = "140"  height= "140" alt="logo"  >
                <nav>
                    <ul class = "nav_links">
                        <li><a href = "../php_files/HomePageParent.php"> Home</a></li>
                        <li><a href = "#"> Profile</a>
                            <ul>
                                <li><a href = "../php_files/ViewProfileParent.php"> View</a></li>
                                <li><a href = "../php_files/EditProfileParent.php"> Edit</a></li>
                            </ul>
                        </li>
                        <li><a href = "#"> Requests</a>
                            <ul> 
                                <li><a href = "/html_files/jobRequest.php"> Post</a></li>
                                <li><a href = "/html_files/EditRequest.html"> Edit</a></li>
                            </ul>
                        </li> 
                        <li><a href = "../php_files/RequestOffers.php"> Offers</a></li>
                        <li><a href = "#"> Booking</a>
                            <ul>
                                <li><a href = "../php_files/CurrentBooking.php"> Current</a></li>
                                <li><a href = "../php_files/PreviousBooking.php"> Previous</a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
                <p><a class= "out" href="../php_files/logout.php">Logout</a></p>
        </header>
       
    
    

        <div class="postingPage">
            <h2>Post Job Request</h2>
        
            <div class="containerr">

           <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <p id="formInfo">

                <div id="kids_info">
                    <label class="nameLabel"> Kid Name: <span class="errspan" style="color:red;font-size: 15px;"> <?php echo $kidName_err; ?></span>
                        <input class="inputName" name="kidsname[]" type="text" placeholder="Enter Kid Name" required> 
                    </label>
                    
                    <label class="ageLabel"> Kid Age: 
                        <input class="inputAge" name="kidsage[]" type="number" min="0" max="17" placeholder="Enter Kid Age" required>
                    </label>
                </div>
                    
                        <div class="controls">
                          <a href="#" id="add_more_fields" size="50"><i class="fa fa-plus"></i></a>
                          <a href="#" id="remove_fields" style="float: right; margin-right: 13px"><i class="fa fa-minus"></i></a>
                          <p style="margin-left: 140px;">Select + to add child, - to remove child</p>
                        </div>
                
                <label class="serviceLabel"> Type Of Class: <span class="errspan" style="color:red;font-size: 15px;"><?php echo $class_err; ?></span>
                    <input class="inptService" name="service" type="text" placeholder="Enter type of class your Kid need " required> 
                </label>
                
                <label class="durationLabel"> Duration: <br> <span class="errspan" style="color:red;font-size: 15px;"><?php echo $to_time_err; ?></span><br>
                Date:<input class="inputDay" name="form_day" type="date" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required > </label>
                <label class="durationLabel"> From: <input class="inputFromTime" name="from_time" type="time" required > </label>
                <label class="durationLabel"> To: <input class="inpuToTime" name="to_time" type="time"  required> </label>
                <br><br>
                <label class="commentsLabel"> Add Comments: (optional)
                    <textarea class="commentsArea" name="comments" cols="72" rows="6" placeholder="  Add any comment if you have"></textarea>
                </label>
                <br>
                 
                <input type="submit" class="Bottons postBotton"  value="Post" name="post_submit"/>
            </p>
            </form>
            </div> <!-- end container -->
        </div> <!-- end postingPage -->
        <footer> 
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
                  
                <p class = "p" >
                <table >
                  <tr>
                     <th colspan="2"><a href="mailto:#" class = "con">ContactUs</a>  </th>
                     <th colspan="2"><a href="aboutUs.html " class ="con">aboutUs</a>  </th>
                     <th colspan="2"> <a href="FAQ.html" class = "con">FAQs</a> </th> 
                  </tr>
                  <tr style="text-align: center;">
                    <td colspan="2"><a href="https://twitter.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-twitter"></ion-icon> </a></td>
                    <td><a href = "https://whatsapp.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-whatsapp"></ion-icon></a></td>
                    <td><a href="https://instagram.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-instagram"></ion-icon></a></td>
                    <td><a href="https://snapchat.com" target="_blank" class = "ionicons">
                        <ion-icon name="logo-snapchat"></ion-icon></a></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="text-align: center;">&copy; A  Tutorly, 2022</td>
                  </tr>
                     
                </table> <br>
            </footer>
    </body>
</html>