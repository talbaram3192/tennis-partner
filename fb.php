<?php

if(!isset($_SESSION['name'])){
    header("location:index.php");
}

if(isset($_GET['FB'])){
    $fb= $_GET['FB'];

     include('connect.php');
     
    $sql = "update user set fb = '$fb' where name = '$_SESSION[name]'";
     $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
     
     echo "<a href=".$fb.">you updated your profile!</a>";

}




?>