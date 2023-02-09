<?php
session_start();
require("../PHP_Files/query.php");
$rates = get_rates($_SESSION["email"]);
?>
<?php include ("../php_files/tutorHeader.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/b8b24b0649.js" crossorigin="anonymous"></script>
    <title> Rate&Reviews</title>
    <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .Sub ,.pic{
                    font-size: 16px;
                    color: #293241;
                background-color:#98C1D9 ;}
                .checked {
                    content:'\f005';
                    color: yellow;
                    margin-left:8px;
                }
    </style>
</head>
<body>


    <h2>Rate & Reviews </h2> 

    <div class="containers" style="width:60%;hight:auto;">
        <?php
        while ($row = mysqli_fetch_assoc($rates)) {
            
            // dd($row);
            echo '<div class="Sub" style="margin-left:35px;width:90%;">
            
                            <img class="pic"style="background-color:#98C1D9;float:left;width:13%;margin-right:5%;" src="../images/' . $row["img"] . '"><br>
                            <Strong style="background-color:#98C1D9;font-weight: bold;font-size: 20px;">' . $row["firstName"] . " " . $row["lastName"] . '</Strong>
                            <p style="background-color:#98C1D9;font-size: 15px;position: absolute;right:22%;text-align: right;">' . $row["time"] . " " . $row["Date"] . '</p><br>
                            ';
            for ($i = 1; $i <= $row["Rate"]; $i++) {
                echo '<span class="fa fa-star checked"style="background-color:#98C1D9;font-size: 20px;"></span>';
            }
            echo '<p style="background-color:#98C1D9;font-size: 18px;"> ' . $row["feedBack"] . ' </p>
            </div>';
        }
        ?>
</div>

   
  <?php include("../php_files/footer.php");?>

</body>
</html>