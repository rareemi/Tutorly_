<?php
session_start();

//print_r($_POST);
if(isset($_POST['submit'])){
    $servername= "localhost";
$username= "root" ;
$password= "";
$dbname= "381" ;
$connection= mysqli_connect($servername,$username,$password,$dbname);
$database= mysqli_select_db($connection, $dbname);
               
if (!$connection) 
die("Connection failed: " . mysqli_connect_error());
$loggedInUser = $_SESSION['email'];

    if(!empty($_POST['uPassword'])){
        $userPassword = mysqli_real_escape_string($connection,$_POST['uPassword']);
        
        $sql ="SELECT * FROM `parent`INNER JOIN requests ON parent.email  = requests.ParentEmail WHERE email='$loggedInUser'and requests.status='served'";
        $userFound = mysqli_query($connection,$sql);
        if($userFound){

            if(mysqli_num_rows($userFound) > 0) {
    
            while ($row = mysqli_fetch_assoc($userFound)) {
            if ($userPassword==$row['password']&&date('Y-m-d') < $row['startDate']) {
                header('Location:/Tutorly_/php_files/DeletProfileParent.php?error=serReq');
            
                exit;

            }elseif($userPassword==$row['password']&&date('Y-m-d') == $row['startDate'] && date('H:i')<$row['startTime']){
                header('Location:/Tutorly_/php_files/DeletProfileParent.php?error=serReq');
                exit;
            }
        }}}

        $sql ="SELECT * FROM `parent`INNER JOIN requests ON parent.email  = requests.ParentEmail WHERE email='$loggedInUser'";
        $userFound = mysqli_query($connection,$sql);
        if($userFound){

            if(mysqli_num_rows($userFound) > 0) {
    
            while ($row = mysqli_fetch_assoc($userFound)) {
                if($userPassword==$row['password']){
                $sql2="SELECT ID,ParentEmail FROM `requests`WHERE ParentEmail='$loggedInUser'";
                $userFound2 = mysqli_query($connection,$sql2);
                if($userFound2){

                    if(mysqli_num_rows($userFound2) > 0) {
            
                    while ($row = mysqli_fetch_assoc($userFound2)) {
                        $idio=$row['ID'];
                        //echo $idio;
                        
                        $sql3="DELETE FROM `offer` WHERE RequestID='$idio'";
                        $userFound3 = mysqli_query($connection,$sql3);
                        $sql3="DELETE FROM `kids` WHERE ID='$idio'";
                        $userFound3 = mysqli_query($connection,$sql3);
        
                }}}
                $sql3="DELETE FROM `requests` WHERE ParentEmail='$loggedInUser'";
                $userFound3 = mysqli_query($connection,$sql3);
                $sql3="DELETE FROM `review` WHERE parentEmail='$loggedInUser'";
                $userFound3 = mysqli_query($connection,$sql3);
                $sql6="DELETE FROM `parent` WHERE email='$loggedInUser'";
                $userFound = mysqli_query($connection,$sql6);
                header('Location:/Tutorly_/php_files/LoginParent.php');
               exit;
            }

        }}}
        $sql = "SELECT * FROM `parent` WHERE email='$loggedInUser'AND password='$userPassword'";
        //echo $sql;
        // AND password='$userPassword'
        $userFound = mysqli_query($connection,$sql);
        //echo $password_encrypted;
        if($userFound){

            if(mysqli_num_rows($userFound) > 0){
                echo "true";
                while($row = mysqli_fetch_assoc($userFound)){
                    // if(password_verify($userPassword,$row['password'])){
                    if($userPassword==$row['password']){
                        
                        $sql2="DELETE FROM `parent` WHERE email='$loggedInUser'";
                        $userFound = mysqli_query($connection,$sql2);
                        header('Location:/Tutorly_/php_files/LoginParent.php');
                        exit;
                    }
                }
                      //  $_SESSION['user_name'] = $userEmail;
                        
            }
            
            
        }
        
        
        header('Location:/Tutorly_/php_files/DeletProfileParent.php?error=failToDelete');
        
        
    }
}?>
