

<?php

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

   if($_SERVER["REQUEST_METHOD"] == "POST") {


      $username = $_POST['name'];
      $userID = $_POST['id'];
      $useremail = $_POST['email'];
      $userpassword = $_POST['pswd'];
      $userlevel = $_POST['lvl'];

       $sql="INSERT INTO user (id,name,email,password,admin,level) VALUES ('".$userID."','".$username."','".$useremail."','".$userpassword."','0','".$userlevel."');";
       $sql2="SELECT email FROM user WHERE email ='$useremail'";
       $result= mysqli_query($conn,$sql2);
       $count = mysqli_num_rows($result);

       if ($conn->query($sql)==FALSE || $count==1){
           	$fmsg = "seems like we have a problem-->>".$conn->error;
	    }else{
		    $smsg = "added succssefully!!";
	   }


}

?>


<!doctype html>


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
  main{
    width:20%;
    margin:5% auto;
    background-size: cover;
    font-family: 'Dekko';
    font-size: 20px;
  }
  h2{
  display: inline-block;
  font-family: 'Kalam';font-size: 45px;
  margin-left: 2%;
  margin-top:1%;
  }
  body{
  background-image:url('images/back1.jpg');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  }
 
  .form-control{
    font-size:12px;
  }
  .btn{
    font-size:12px;
  }

  </style>
</head>

<body>
	<main>
	<div class="container">
  <h2>sign-up!</h2>
  <br>
  <br>
  <form action="signup.php" method="post">
  	<div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="johnny" name="name" required>
    </div>
    <div class="form-group">
      <label for="id">ID:</label>
      <input type="text" class="form-control" id="id" name="id" placeholder="000000000" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
    </div>
    <div class="form-group">
      <p><label>choose your level:
           <select name="lvl" size="1">
            <option value="0" selected>0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
           </select>
         </label></p>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <br>
    <br>
    <?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
  </form>
  <a href="index.php"><b>back to login page</a>
</div>
<script>
function validate(){
    


}

</script>
</main>
</body>


</html>