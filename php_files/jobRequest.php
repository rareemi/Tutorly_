<?php
session_start();


$service_err = $form_day_err = $to_time_err = $kidName_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername= "localhost";
    $username= "root" ;
    $password= "";
    $dbname= "381project" ;
    
    if (!$connection= mysqli_connect($servername,$username,$password)) 
    die("Connection failed: " . mysqli_connect_error());
    
    if(!$database= mysqli_select_db($connection, $dbname))
    die("Could not open database failed: " . mysqli_connect_error());

    //$ID = mysqli_insert_id($connection);
    //echo "$ID";

    if( isset($_POST['service']) && isset($_POST['form_day']) && isset($_POST['from_time']) && isset($_POST['to_time'])){
        //$kidsname = $_POST['kidsname'];
        //$kidsages = $_POST['kidsages']; 
        $service = $_POST['service'];
        $form_day = $_POST['form_day'];
       // $to_day = $_POST['to_day'];
        $from_time = $_POST['from_time'];
        $to_time = $_POST['to_time'];
       
        //validate
       $valid = true;
        if($service == " "){
            $service_err = " please enter a service!" ;
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
        //$sql = "INSERT INTO `requests` (`TypeOfServese`, `startTime`, `endTime`, `startDate`, `comments`, `parentName`, `ID`, `status`, `ParentEmail`, `expireDate`, `city`, `District`) VALUES ('$service', '$from_time', '$to_time', '$form_day', '$comments','Mona', NULL, 'unserved', 'parent1@gmail.com', '2022-11-04', 'Riyadh' , 'aldreya')";
        $query = mysqli_query($connection,$sql);
       // print_r($_POST);
       // isset($_POST['kidsname']) && isset($_POST['kidsages']) &&
       if( $query ){
        echo 'done1';
        
        //Insert ID
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

    //header("Location: http://localhost/BabySitterProject/HTML_Files/postingJobRequest.php");
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
        <title>Post Job Request</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../CSS_Files/jobRequestStyle.css">
        <link rel="stylesheet" href="../CSS_Files/menustyle.css">
        <link rel="stylesheet" href="../CSS_Files/footer.css">
        <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1"> 

    </head>
    
    <body>
        
         <!--Upper Menue-->
    <?php include("parentheader.php"); ?>
    

        <div class="postingPage">
            <h2>Post Job Request</h2>
        
            <div class="container">

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <p id="formInfo">

                <div id="kids_info">
                    <label class="nameLabel"> Kid/s Name: <span class="errspan" style="color:red;font-size: 15px;"><?php echo $kidName_err; ?></span>
                        <input class="inputName" name="kidsname[]" type="text" placeholder="Enter Kid Name" required> 
                    </label>
                    
                    <label class="ageLabel"> Kid/s Age: 
                        <input class="inputAge" name="kidsage[]" type="number" min="0" max="17" placeholder="Enter Kid Age" required>
                    </label>
                </div>
                    
                        <div class="controls">
                          <a href="#" id="add_more_fields" size="50"><i class="fa fa-plus"></i></a>
                          <a href="#" id="remove_fields" style="float: right; margin-right: 13px"><i class="fa fa-minus"></i></a>
                          <p style="margin-left: 140px;">Select + to add child, - to remove child</p>
                        </div>
                
                <label class="serviceLabel"> Type Of Service: <span class="errspan" style="color:red;font-size: 15px;"><?php echo $service_err; ?></span>
                    <input class="inptService" name="service" type="text" placeholder="Enter type of service you want" required> 
                </label>
                
                <label class="durationLabel"> Duration: <br> <span class="errspan" style="color:red;font-size: 15px;"><?php echo $to_time_err; ?></span><br>
                Date:<input class="inputDay" name="form_day" type="date" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required > </label>
                <label class="durationLabel"> From: <input class="inputFromTime" name="from_time" type="time" required > </label>
                <label class="durationLabel"> To: <input class="inpuToTime" name="to_time" type="time"  required> </label>
                <br><br>
                <label class="commentsLabel"> Add Comments: (optional)
                    <textarea class="commentsArea" name="comments" cols="72" rows="6" placeholder="  Add any comment if you want"></textarea>
                </label>
                <br>
                 
                <input type="submit" class="Bottons postBotton"  value="Post" name="post_submit"/>
            </p>
            </form>
            </div> <!-- end container -->
        </div> <!-- end postingPage -->

           
        <footer> <!-- footer -->
            <table class="tableF">
                <tr>
                    <th><a href="aboutUs.html"> About Us </a></th>
                    <th><a href="FAQ.html"> FAQs </a></th>
                    <th><a href="ContactUs.php"> Contact Us </a></th>
                </tr>
            </table>
            <div id="shareProfile">
                    <h4>Share the website</h4>
                
                    <a href="https://facebook.com" target="_blank">
                        <i class="fa-brands fa-facebook fa-2x"></i>
                    </a>
            
                    <a href="https://twitter.com" target="_blank">
                        <i class="fa-brands fa-twitter fa-2x"></i>
                    </a>
            
                    <a href="https://linkedin.com" target="_blank">
                        <i class="fa-brands fa-linkedin fa-2x"></i>
                    </a>
            
                    <a href="https://instagram.com" target="_blank">
                        <i class="fa-brands fa-instagram fa-2x"></i>
                    </a>
            
                    <a href="https://web.whatsapp.com" target="_blank">
                        <i class="fa-brands fa-whatsapp fa-2x"></i>
                    </a>
                </div><br> 
            <div class="footer">
            &copy; A Watchful Eye, 2022
            </div>
            </footer> <!-- end footer -->
    </body>
    <script src="addKids.js"></script>
</html>