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

// contact us
function contact_us_handler($name, $email, $message)
{
    global $conn;
    $sql = "INSERT INTO `contactus` (`name`, `email`, `massage`) VALUES ('" . $name . "','" . $email . "','" . $message . "')";
    $result = mysqli_query($conn, $sql);
    return $result;
}



// parent
function parent_signup_handler($fname, $lname, $email, $password, $city, $district, $street, $bldg_number, $postal, $_2nd_number, $img)
{
    global $conn;
    $sql = "INSERT INTO `parent` VALUES ('" . $email . "','" . $password . "','" . $fname . "','" . $lname . "','" . $city . "','" . $district . "','" . $street . "','" . $bldg_number . "','" . $postal . "','" . $_2nd_number . "','" . $img . "')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// babysitter
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
    $sql = "SELECT review.rate, review.feedback, review.date, review.time , parent.firstName,parent.lastName,parent.img FROM `review`, `parent` WHERE review.parentEmail = parent.email AND review.babysitterEmail = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    // dd(mysqli_fetch_assoc($result));
    return $result;
}


// offers
function get_requests($email)
{
    global $conn;
    $sql = "SELECT requests.TypeOfServese, requests.startTime, requests.endTime, requests.startDate, requests.startDate, offers.price, offers.offerstatus FROM `requests`, `offers` WHERE  requests.ID = offers.RequestID AND offers.babySitterEmail = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    return $result;
}