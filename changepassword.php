

<?php


session_start();
if(!isset($_SESSION["name"])){

	header("location:index.php");
}

   include('connect.php');

 if(isset($_GET['changepasswd'])){
 	$newpasswd=$_GET['newpasswd'];
 	$checknewpasswd=$_GET['newpasswdagain'];
 	if($newpasswd != $checknewpasswd){
 		$wrong = "The new passwords you inserted didn't match";
 	}else{
 		
         $conn->query("UPDATE user SET password = '$newpasswd' WHERE name = '$_SESSION[name]'"); 
         $success = "You changed your password successfully!";
 	}
 }

?>

<head>
 	<link href='https://fonts.googleapis.com/css?family=Dekko' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	*{
		box-sizing:border-box;
		margin:0px;
		}
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
    h1{
    	display: inline-block;
    	font-family: 'Kalam';font-size: 55px;
    	text-align: center;
    	margin-top:3%;
    }
    header{
    	height:20%;
    }
    main{
    	height: 80%;
    }
    form{
    	margin-left:35%;
    	font-size:20px;
    }
    label{
    display: inline-block;
    float: left;
    clear: left;
    width: 250px;
    text-align: right;
    margin-right: 2%;
    margin-bottom: 3%;
   }
   input {
     display: inline-block;
     float: left;
    }
    #change{
    	clear:both;
    	margin-left: 20%;
    }
    .alert{
       font-size: 20px;
       width:25%;
       margin:auto;
    }
    

</style>

</head>




<body>
	<header>

	<h1>
      Change your password
	</h1>

	<?php
 if($_COOKIE["admin"] != 1){
	 include('header.html'); 
 } else{
    include('headeradmin.html'); 
}
?>

</header>
<main><div>
    <form method="GET" action="changepassword.php">
	<label>Enter your new password:</label><input type="password" name="newpasswd">
	<label>Confirm your new password:</label><input type="password" name="newpasswdagain">
    <input id="change" type="submit" name="changepasswd" value="change!">
    </form>
</div>
<br>
<br>
<br>
<br>
<br>


      <?php if(isset($wrong)) { ?><div class="alert alert-danger" role="alert"> <?php echo $wrong; ?> </div><?php } ?>
      <?php if(isset($success)){ ?><div class="alert alert-success" role="alert"> <?php echo $success; ?> </div><?php } ?>
      <?php if(isset($wrongpass)) { ?><div class="alert alert-danger" role="alert"> <?php echo $wrongpass; ?> </div><?php } ?>


</main>
</body>