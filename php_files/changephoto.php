<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=381", "root", "");

//variable email
$get_email = $_GET['email'] ?? "none";
$email = "%" . $get_email . "%";

//select data from table tutor
$query_sel = "SELECT * FROM tutor WHERE email LIKE '$email'";
$stmt_sel = $pdo->query($query_sel);
$get = $stmt_sel->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $targetfolder2 = "uploads/";
    $name_img = basename( $_FILES['photo']['name']);
    $tmp_name = $_FILES["photo"]["tmp_name"];
    $name = basename($_FILES["photo"]["name"]);
    move_uploaded_file($tmp_name, "uploads/$name");
//    update data
    $email = str_replace('%', '', $email);
    $query_1 = "UPDATE tutor SET img='$name' WHERE email=:e";
    $stmt_1 = $pdo->prepare($query_1);
    $stmt_1->execute(array(':e' => $email,));
    header("Location: changephoto.php?email=".$get_email);
    return;
}
?>


<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel ="stylesheet" type= "text/css"
     href="../css_files/common.css">
<body>
<h1 class="text-primary text-center">
    Edit Profile
</h1>
<form method="post" enctype="multipart/form-data" action="">

    <input type="file" name="photo" class="form-control" required>
    <br>
    <div class="text-center">
        <input type="submit" class="button1" >
        <a class= "button1" id="but" href="../php_files/EditProfileTutor.php
">back</a>

    </div>
</form>
<div class="text-center">
    <img src="uploads/<?php echo $get['img']?>" style="max-width: 100%">
</div>
</body>
</html>