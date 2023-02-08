<?php
session_start();


$service_err = $form_day_err = $to_time_err = $kidName_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername= "localhost";
    $username= "root" ;
    $password= "";
    $dbname= "381v2" ;
    
    if (!$connection= mysqli_connect($servername,$username,$password)) 
    die("Connection failed: " . mysqli_connect_error());
    
    if(!$database= mysqli_select_db($connection, $dbname))
    die("Could not open database failed: " . mysqli_connect_error());

    //$ID = mysqli_insert_id($connection);
    //echo "$ID";

    if( isset($_POST['service']) && isset($_POST['form_day']) && isset($_POST['from_time']) && isset($_POST['to_time'])){
        //$kidsname = $_POST['kidsname'];
        //$kidsages = $_POST['kidsages']; 
        $class = $_POST['service'];
        $form_day = $_POST['form_day'];
       // $to_day = $_POST['to_day'];
        $from_time = $_POST['from_time'];
        $to_time = $_POST['to_time'];
       
        //validate
       $valid = true;
        if($class == " "){
            $class_err = " please enter a service!" ;
            $valid = false;
        }
       
       /*  if(strtotime($form_day) <= strtotime(today)){
            $form_day_err = " please enter a valid date , start from tomorrow!" ;
            $valid = false;
        }*/
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

        $name = $_SESSION['firstName'];
        $city = $_SESSION['City'];
        $district = $_SESSION['District'];
        $pemail =  $_SESSION['email'];

        $createdAt = $date = date('m/d/Y h:i:s', time());

        echo "$createdAt";
        $sql = "INSERT INTO `requests` (`TypeOfServese`, `startTime`, `endTime`, `startDate`, `comments`, `parentName`, `ID`, `status`, `ParentEmail`, `created_at`, `city`, `District`) VALUES ('$service', '$from_time', '$to_time', '$form_day', '$comments','$name', NULL, 'unserved', '$pemail', now(), '$city' , '$district' )";
        $query = mysqli_query($connection,$sql);
       if( $query ){
        echo 'done1';
        
       
       $id = mysqli_insert_id($connection);
       print("Insert ID: ".$id ."\n");
        $count = count($_POST["kidsname"]);
        print("count: ". $count ."\n");
        for($x =0 ; $x < $count ; $x++) {
           $kidName = $_POST["kidsname"]["$x"];
           $kidAge = $_POST["kidsage"]["$x"];
            $sql = "INSERT INTO `kids` (`ID`, `kidName`, `kidAge`) VALUES ('$id', '$kidName', '$kidAge')";
            $query = mysqli_query($connection,$sql);
          }
          echo '<script>alert("Posted successful!");window.location.href="postingJobRequest.php";</script>';

    
    }
    else{
        echo 'fail';
        }
    }}
}

?> 



<!DOCTYPE html>
<html>

    <head>
    <link rel="stylesheet" type ="text/css" href="C:\Users\sarah\OneDrive\المستندات\Tutorly_\css_files\jobRequestStyle.css" >
    <link rel = "stylesheet" type = "text/css" href="C:\Users\sarah\OneDrive\المستندات\Tutorly_\css_files\common.css">
        <title>Post Job Request</title>
        <meta charset="UTF-8">
        <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1"> 

    </head>
    <header>
        <img src = "../images/logo.png" class ="logo" width = "140"  height= "140" alt="logo"  >
            <nav>
                <ul class = "nav_links">
                    <li><a href = "/html_files/HomePageParent.html"> Home</a></li>
                    <li><a href = "#"> Profile</a>
                        <ul>
                            <li><a href = "/html_files/ViewProfileParent.html"> View</a></li>
                            <li><a href = "/html_files/EditProfileParent.html"> Edit</a></li>
                        </ul>
                    </li>
                    <li><a href = "#"> Requests</a>
                        <ul> 
                            <li><a href = "/html_files/JobRequest.html"> Post</a></li>
                            <li><a href = "/html_files/EditRequest.html"> Edit</a></li>
                        </ul>
                    </li> 
                    <li><a href = "../html_files/RequestOffers.html"> Offers</a></li>
                    <li><a href = "#"> Booking</a>
                        <ul>
                            <li><a href = "../php_files/CurrentBooking.php"> Current</a></li>
                            <li><a href = "../php_files/PreviousBooking.php"> Previous</a></li>
                        </ul>
                    </li>
                   
                </ul>
            </nav>
            <p><a class= "out" href="../html_files/index.html">Logout</a></p>
    </header>

    <body>
        
       
    
    

        <div class="postingPage">
            <h2>Post Job Request</h2>
        
            <div class="container">

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <p id="formInfo">

                <div id="kids_info">
                    <label class="nameLabel"> Kid/s Name: <span class="errspan" style="color:red;font-size: 15px;"><?php echo $kidName_err; ?></span>
                        <input class="inputName" name="kidsname[]" type="text" placeholder="Enter your Kid Name" required> 
                    </label>
                    
                    <label class="ageLabel"> Kid/s Age: 
                        <input class="inputAge" name="kidsage[]" type="number" min="0" max="17" placeholder="Enter your Kid Age" required>
                    </label>
                </div>
                    
                        <div class="controls">
                          <a href="#" id="add_more_fields" size="50"><i class="fa fa-plus"></i></a>
                          <a href="#" id="remove_fields" style="float: right; margin-right: 13px"><i class="fa fa-minus"></i></a>
                          <p style="margin-left: 140px;">Select + to add child, - to remove child</p>
                        </div>
                
                <label class="serviceLabel"> Type Of Class : <span class="errspan" style="color:red;font-size: 15px;"><?php echo $service_err; ?></span>
                    <input class="inptService" name="service" type="text" placeholder="Enter type of class you Kid want" required> 
                </label>
                
                <label class="durationLabel"> Duration: <br> <span class="errspan" style="color:red;font-size: 15px;"><?php echo $to_time_err; ?></span><br>
                Date:<input class="inputDay" name="form_day" type="date" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required > </label>
                <label class="durationLabel"> From: <input class="inputFromTime" name="from_time" type="time" required > </label>
                <label class="durationLabel"> To: <input class="inpuToTime" name="to_time" type="time"  required> </label>
                <br><br>
                <label class="commentsLabel"> Add Comments: (optional)
                    <textarea class="commentsArea" name="comments" cols="72" rows="6" placeholder="  Add your comment if you have"></textarea>
                </label>
                <br>
                 
                <input type="submit" class="Bottons postBotton"  value="Post" name="post_submit"/>
            </p>
            </form>
            </div> <!-- end container -->
        </div> <!-- end postingPage -->
    </body>
    <footer> 
       
      
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
        <script src="addKids.js"></script>
</html>

           

   
