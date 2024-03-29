<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "381";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// common
function validate($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

function dd($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die("Died...");
}





// parent
function parent_signup_handler($email, $password,$fname, $lname, $city, $location, $img)
{
    global $conn;
    $sql = "INSERT INTO `parent` VALUES ('" . $email . "','" . $password . "','" . $fname . "','" . $lname . "','" . $city . "','" . $location . "','"  . $img . "')";
    $result = mysqli_query($conn, $sql);
    return $result;
}
function get_parent_email($email)
{
    global $conn;
    $sql = "SELECT email FROM `parent` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}

// tutor
function get_tutor_email($email)
{
    global $conn;
    $sql = "SELECT email FROM `tutor` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}

function tutor_signup_handler($email, $password, $fname, $lname, $gender, $id, $age,  $city, $phone,  $msg, $img)
{

    global $conn;
    $sql = "INSERT INTO `tutor` VALUES ('" . $email . "','" . $password . "','" . $fname . "','" . $lname . "','" . $gender . "','" . $id . "','" . $age . "','" . $city . "','" . $phone . "','" . $msg . "','" . $img . "')";
    $result = mysqli_query($conn, $sql);

    return $result;
}

// view rates
function get_rates($email)
{
    global $conn;
    $sql = "SELECT review.Rate	, review.feedBack, review.Date, review.time , parent.firstName,parent.lastName,parent.img FROM `review`, `parent` WHERE review.parentEmail = parent.email AND review.tutorEmail = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    // dd(mysqli_fetch_assoc($result));
    return $result;
}


// offers
function get_requests($email)
{
    global $conn;
    $sql = "SELECT requests.TypeOfClass, requests.startTime, requests.endTime, requests.startDate, requests.startDate, offer.price, offer.offerstatus FROM `requests`, `offer` WHERE  requests.ID = offer.RequestID AND offer.tutorEmail = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    return $result;
}