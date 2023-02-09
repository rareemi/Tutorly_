<?php
session_start();
require("../php_files/query.php");
$requests = get_requests($_SESSION['email']);

?>

<?php include("tutorHeader.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Offers with Status</title>
    <link rel ="stylesheet" type="text/css" href = "../css_files/common.css">
<style> .tableS{
    border-spacing: 1;
    /* border-collapse: collapse;  */
    background-color: #98C1D9(248, 250, 219);
    border-radius: 6px;
    overflow: hidden;
    max-width: 1300px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    border-style: solid;
    border: 2px solid;
    text-align: center;
  
    border-color: #98C1D9;
  }
  .Green{color: #2ca12c}
  .Red{color: #de543c}
  </style>
</head>
<body>
  
  <h2> Offers with Status</h2> <br>
<table class="tableS" border ="1"> 
<thead>
  <tr>     <th> </th> <th>Date </th><th> Duration</th> <th> Student Name</th> <th>Subject </th><th> Price</th><th> Status</th></tr>
</thead>
<tbody> 
<?php
      $count = 1;
      while ($row = mysqli_fetch_assoc($requests)) {
        echo '
            <tr>
              <td>' . $count . '</td>
              <td>' . $row["startDate"] . '</td>
              <td>' . $row["startTime"] . " - " . $row["endTime"] . '</td>
              <td>' . $row["TypeOfClass"] . '</td>
              #<td> ' . $row["price"] . '</td>';
        if (strtolower($row["status"]) == "accepted")
          echo '<td class="Green">' . $row["status"] . '</td>';
        else if (strtolower($row["status"]) == "served")
          echo '<td class="Green">' . $row["status"] . '</td>';
        else if (strtolower($row["status"]) == "unserved")
          echo '<td class="Red">' . $row["status"] . '</td>';
        echo '</tr>';
         $count = $count +1;
      }
      ?>
</tbody>


    
</table>



       
      
<?php include("footer.php");?>
</body>
</html>