<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>TUTORLY</title>
     <link rel ="stylesheet" type= "text/css" href="../css_files/common.css">

     <style>
	 html, body{
    display:inline-block;
     }
    footer{
    display:table;
     }
      .icons{
        background-color:#7290a2;
        font-size: 19px;
        border-radius: 30px;
        padding: 35px 70px;
        text-align: center;
        }

        .icons:hover{color: #F5FBFF;
            font-size: 22px;}
           
        </style>
    </head>

    <body>
        
    <div class="containers" style="width:100% ;background-color:  #F5FBFF;">
	   <div style=" text-align:center;width:100%;">
		<img src = "../images/logo.png" class ="logo" width = "500"  height= "540" alt="logo" >
		</div>
       <table style=" text-align:center;width:70%; margin-left:15%;">
		<tr>
        <td ><p><a  class ="icons" href="../php_files/LoginParent.php">I'm a Parent</a></p></td>
		<td><p><a  class="icons" href="../php_files/LoginTutor.php" >I'm a Tutor   </a></p></td>
		</tr>
	   </table>
       <br><br><br>
    </div>
       <?php include("../php_files/footer.php");?>
        </body>

</html>