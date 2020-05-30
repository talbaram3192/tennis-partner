<?php
    session_start();
        if(!isset($_SESSION['name'])){
        header("location:index.php");
      }

	$servername="localhost";
    $username = "root";
    $password = "";
    $dbname = "taldb";
 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
if (!$conn->set_charset("utf8")) { printf("Error loading character set utf8: %s\n", $conn->error); exit();}

    $conn->query("SET NAMES 'utf8'");


$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }

// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }

// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $sql="update user set pic = '$target_file' where name = '$_SESSION[name]' ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

echo "<br><br> <a href=myGames.php>back to your profile</a>";

?>