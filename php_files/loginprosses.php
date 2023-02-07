<?php
session_start();


if(isset($_POST['submit'])){
    
$servername= "localhost";
$username= "root" ;
$password= "";
$dbname= "381" ;
$connection= mysqli_connect($servername,$username,$password,$dbname);
$database= mysqli_select_db($connection, $dbname);
// Check the connection
if (!$connection) 
die("Connection failed: " . mysqli_connect_error());

//echo 'PHP version: ' . phpversion();
//print_r($_POST);
    if(!empty($_POST['email']) && !empty($_POST['pass'])){

        $userEmail = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $userPassword = mysqli_real_escape_string($connection,$_POST['pass']);
        //$password_encrypted = password_hash(mysqli_real_escape_string($connection,$_POST['uPassword']), PASSWORD_DEFAULT);
        //$password_encrypted = password_hash($userPassword, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM `tutor` WHERE email='$userEmail'AND password='$userPassword'";
        // AND password='$userPassword'
        $userFound = mysqli_query($connection,$sql);
        //echo $password_encrypted;
        if($userFound){

            if(mysqli_num_rows($userFound) > 0){
                
                while($row = mysqli_fetch_assoc($userFound)){
                    //$userPassword==$row['password'] password_verify($password_encrypted,$row['password'])
                    //password_verify($userPassword,$row['password'])//////////////////////////////////////////////////////////////////
                    //var_dump(password_verify($userPassword,$row['password']));
                    //if(password_verify($userPassword,$row['password'])){
                    if($userPassword==$row['password']){
                        $_SESSION['email'] = $row['email'];
                            $_SESSION['firstName']=$row['firstName'];
                            $_SESSION['lastName']=$row['lastName'];
                            $_SESSION['img']=$row['img'];

                        header('Location:../html_files/HomePageTutor.php');
                        exit;
                    }
                    //}
                }
                      //  $_SESSION['user_name'] = $userEmail;
                        
            }
            
            header('Location:../php_files/LoginTutor.php?error=failToLogIn');  
        }
        $sql = "SELECT * FROM `parent` WHERE email='$userEmail'AND password='$userPassword'";
        // AND password='$userPassword'
        $userFound = mysqli_query($connection,$sql);
        
        if($userFound){
            
            if(mysqli_num_rows($userFound) > 0){
                
                    while($row = mysqli_fetch_assoc($userFound)){
                        /////////////////////////////////////////////////////////////////////////////////////////////////
                        if($userPassword==$row['password']){
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['firstName']=$row['firstName'];
                            $_SESSION['lastName']=$row['lastName'];
                            $_SESSION['img']=$row['img'];
                            $_SESSION['City']=$row['City'];
                            $_SESSION['Location']=$row['Location'];
                            header('Location:../html_files/HomePageParent.php');
                        exit;
                        }
                    }
                
                       // $_SESSION['user_name'] = $userEmail;
                        
            }
            
            
        }
        
        header('Location:../php_files/LoginParent.php?error=failToLogIn');
        
        
    }
    //unset($_SESSION['user_name']);
}?>