<?php
include("Connection.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image upload</title>
     <link rel="stylesheet" href="prescupload.css">
</head>
<body>
    <h1>PRESCRIPTION</h1>

    <div class="myform">
      <form method="POST" enctype="multipart/form-data">
            <div class="input-field">
               <label><b><font size="+2">Patients Name</font></b></label>
               <input type="text" name="username"> 
            </div>

            <div class="input-field">
                <label><b><font size="+2">Select An Image</font></b></label>
                <input type="file" name="profile"> 
            </div>

        
            <div class="submit-btn">
                <button type="submit" name="upload">UPLOAD</button>
            </div>

        </form> 
    </div>
 <?php 
     if(isset($_POST['upload']))
     {
        $img_loc=$_FILES['profile']['tmp_name'];
        $img_name=$_FILES['profile']['name']; 
        $uname=$_POST["username"];
        $img_ext=pathinfo($img_name,PATHINFO_EXTENSION);
        $img_size=$_FILES['profile']['size']/(1024*1024); 

        $img_des="uploaded images/".$uname.".".$img_ext;  

        if(($img_ext!='jpg') && ($img_ext!='png') && ($img_ext!='jpeg') && ($img_ext!='webp')) 
        {
            echo "<script>alert('Invalid Image Extension');</script>";
            exit();
        }
        
        if($img_size>3)
        {
            echo"<script>alert('Image size is greater than 3MB');</script>";
            exit();
        }


        move_uploaded_file($img_loc,$img_des); 
        $query="INSERT INTO `user_data`(`UserName`, `Profile`) VALUES ('$uname','$img_des')";
       
        if (mysqli_query($conn,$query))
        {
            move_uploaded_file($img_loc,$img_des);
             echo "<script>alert('Sucessful');</script>";
        }
        

        else
        {
            echo"<script>alert('un-sucessful');</script>";
             
        } 
    

     }
 ?>

</body>
</html>