<?php
session_start();
require("../PHP_Files/query.php");
$rates = get_rates($_SESSION["email"]);
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>
    <title> Rate&Reviews</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .Sub ,.pic,.p,.s{
                    font-size: 16px;
                    color: #293241;
                background-color:#98C1D9 ;}
    </style>
</head>
<body>
<?php include("../php_files/parentHeader.php");?>

    <h2>Rate & Reviews </h2> 

    <div class="containers" style="width:60%;hight:auto;">
        <?php
        while ($row = mysqli_fetch_assoc($rates)) {
            
            // dd($row);
            echo '<div class="Sub" style="margin-left:35px;width:90%;">
            
                            <img class="pic"style="background-color:#98C1D9;float:left;width:13%;margin-right:5%;" src="../images/' . $row["img"] . '"><br>
                            <Strong style="background-color:#98C1D9 ;">' . $row["firstName"] . " " . $row["lastName"] . '</Strong><br>
                            <p style="background-color:#98C1D9 ;">' . $row["time"] . " " . $row["Date"] . '</p>
                            ';
            for ($i = 1; $i <= $row["Rate"]; $i++) {
                echo '<span class="fa fa-star checked"style="background-color:#98C1D9 ;"></span>';
            }
            echo '<p style="background-color:#98C1D9 ;"> ' . $row["feedBack"] . ' </p>
            </div>';
        }
        ?>
</div>

   
  <?php include("../php_files/footer.php");?>

</body>
</html>