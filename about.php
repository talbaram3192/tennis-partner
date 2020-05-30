<?php 

session_start();
if(!isset($_SESSION['name'])){
	header("location:index.php");
}

?>


<html>
<head>
	  <link href='https://fonts.googleapis.com/css?family=Dekko' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>

body{
  height:1000px;
  background-image:url('images/back.jpg');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  font-family: 'Dekko';
  font-size: 30px;
}
.title{
  display: inline-block;
  font-family: 'Kalam';font-size: 45px;
  margin-left: 2%;
  margin-top:1%;
  margin-bottom: 2%;
}
.description{
   margin-top:5%;
   width:50%;
   font-size:22px;
   margin-left: 2%;
   background-color: #f5f5f0;
   border-radius: 20%;
   padding: 2.5%;

}
.started{
	font-weight: bold;
    text-align: center;
}
.arrow {
  margin-left:40%;
  border: solid black;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 13px;
  margin-bottom: 3%;
}
.down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}

  </style>


</head>

<h1 class="title">What's Tennis Partner?</h1>
<?php if($_COOKIE["admin"] != 1){
  ?>
  <?php include('header.html'); ?>

<?php } else{?>
<?php include('headeradmin.html'); ?>
<?php } ?>

<div class="description">
<p>
Tennis-Partner is a web application that is used for tennis players of all levels to find their tennis partners and schedule games together.<br>
The app classifies players according to their subjective level and offers a ranking system that is based on their objective scores playing with each other.<br> Players can choose to publish their preferred dates for games on a public wall so that other players could join them if they wish, There is also an option to invite other players privately.<br>
Tennis-player is an interactive platform, and its goal is to make it easier for players to find other players and enjoy the game together. 
	</p>
	<div><i class="arrow down"></i></div>
<p class="started">Get started! Schedule your next match in the <?php if($_COOKIE['admin']==1){ ?><a href="welcomeadmin.php">Main Dashboard</a> <?php }else{
	?><a href="welcome.php">Main Dashboard</a><?php } ?></p>
</div>



</html>