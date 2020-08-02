
 <head>
 	<link href='https://fonts.googleapis.com/css?family=Dekko' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	table{
		margin:auto;
		margin-top:5%;
		border:1px solid grey;
		text-align: center;
		background-color: #e0e0d1;
		width:400px;
	}
	th{
       border:1px solid grey;
       background-color: #c2c2a3;
       font-weight: bold;
	}
	td{
		border:1px solid grey;
	}
    body{
    	background-image:url('images/back.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Dekko';
        font-size: 30px;
    }
    h1{
    	font-family: 'Kalam';font-size: 55px;
    	text-align: center;
    	margin-top:3%;
    }

</style>

  </head>




<body>
	<h1>
      Rankings
	</h1>

<?php
 if($_COOKIE["admin"] != 1){
	 include('header.html'); 
 } else{
    include('headeradmin.html'); 
}


session_start();
if(!isset($_SESSION["name"])){

	header("location:index.php");
}

    include('connect.php');

$sql = "SELECT 
        ROW_NUMBER() OVER(ORDER BY ranking DESC) AS place,
        name,ranking,won,loss
        FROM user";

$result= mysqli_query($conn,$sql);

?>
<table>
	<tr><th>Place</th><th>Name</th><th>Points</th><th>Matches played</th></tr> <?php
while($row = $result->fetch_assoc()){
	$total=$row["won"]+$row["loss"];
    ?> <tr><td> <?php echo $row["place"]; ?> </td>
    	<td> <?php echo $row["name"]; ?> </td>
    	<td> <?php echo $row["ranking"]; ?> </td> 
    	<td> <?php echo $total; ?> </td> </tr> 
    <?php } ?>
    	</table> 



</body>



