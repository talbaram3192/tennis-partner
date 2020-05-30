
<?php


session_start();

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

if(!isset($_SESSION['name'])){

  header("location:index.php");
}

         $result4=$conn->query("SELECT name,subject FROM comments"); 
         $result5=$conn->query("SELECT player1,player2,gdate,gtime,serial FROM games");  
 


?>


<?php
         
   
      if(isset($_POST['gameOn'])){

         myfunc2();
      }elseif (isset($_POST['delete'])) {
        myfunc();
      }
      elseif (isset($_POST['delgame'])) {
        myfunc3();
      }
      elseif (isset($_POST['advanced'])) {
        if($_COOKIE["admin"] != 1){
          header("location: search.php");
        }
        else{
             header("location: searchadmin.php");
        }
      }
      elseif(isset($_POST['invite'])){
         $servername="localhost";
         $username = "root";
         $password = "";
         $dbname = "taldb";


         $conn3 = new mysqli($servername, $username, $password, $dbname);

         if ($conn3->connect_error) {
          die("Connection failed: " . $conn3->connect_error);
          }
          $invited=$_POST['invite'];

           $sql = "SELECT email from user where name='$_SESSION[name]'";

           $result= mysqli_query($conn3,$sql);

           while($row = $result->fetch_assoc()) {
            $invitingemail=$row["email"];
           }
           $check="select inviting from invitations where inviting = '$_SESSION[name]' and invited ='$invited'";

           $result2= mysqli_query($conn3,$check);
           $countinvite = mysqli_num_rows($result2);
 
           if($countinvite == 0){

                $sql2 = "INSERT INTO invitations (inviting, invited, invitingemail, invitedemail) VALUES ('$_SESSION[name]','$invited','$invitingemail','null')";
                $res = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                if($res){
                $smes = "Invitation sent!";
                }else{
                $fmes = "Failed to send invitation";
                }
           }else{
              $fmes = "Failed to send invitation";
           }
      }
    
    if(isset($_GET['bestp'])){

         $servername="localhost";
         $username = "root";
         $password = "";
         $dbname = "taldb";


            $conn3 = new mysqli($servername, $username, $password, $dbname);
            $checkvote = $conn3->query("select voted from user where name = '$_SESSION[name]' ");
            while($check = $checkvote->fetch_assoc()){
              $didvote = $check['voted'];
            }
            if($didvote == 0){
            $conn3->query("update user set voted = 1 where name = '$_SESSION[name]' ");
            $sql="update weeklyquestions set numchoice = numchoice + 1 where choice = '$_GET[bestp]' ";
            $ress=mysqli_query($conn3, $sql) or die(mysqli_error($conn3));
            if($ress){
              $answer="you submitted your answer!";
            }else{
              $badanswer="something didn't work :/";
            }

            $result=$conn3->query("select * from weeklyquestions where choice = 'roger' ");
          
            while($row = $result->fetch_assoc()) {
              $roger = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'nole' ");
          
            while($row = $result->fetch_assoc()) {
              $nole = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'nadal' ");
          
            while($row = $result->fetch_assoc()) {
              $nadal = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'diego' ");
          
            while($row = $result->fetch_assoc()) {
              $diego = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'isner' ");
          
            while($row = $result->fetch_assoc()) {
              $isner = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'cilic' ");
          
            while($row = $result->fetch_assoc()) {
              $cilic = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'stef' ");
          
            while($row = $result->fetch_assoc()) {
              $stef = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'medvedev' ");
          
            while($row = $result->fetch_assoc()) {
              $medvedev = $row['numchoice'];
            }
          
            }else{
              $alreadyvoted = "You already voted you cheater!!";

              $result=$conn3->query("select * from weeklyquestions where choice = 'roger' ");
          
            while($row = $result->fetch_assoc()) {
              $roger = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'nole' ");
          
            while($row = $result->fetch_assoc()) {
              $nole = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'nadal' ");
          
            while($row = $result->fetch_assoc()) {
              $nadal = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'diego' ");
          
            while($row = $result->fetch_assoc()) {
              $diego = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'isner' ");
          
            while($row = $result->fetch_assoc()) {
              $isner = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'cilic' ");
          
            while($row = $result->fetch_assoc()) {
              $cilic = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'stef' ");
          
            while($row = $result->fetch_assoc()) {
              $stef = $row['numchoice'];
            }
            $result=$conn3->query("select * from weeklyquestions where choice = 'medvedev' ");
          
            while($row = $result->fetch_assoc()) {
              $medvedev = $row['numchoice'];
            }
            }
            
         }


      function myfunc2(){
         
         $servername="localhost";
         $username = "root";
         $password = "";
         $dbname = "taldb";


         $conn3 = new mysqli($servername, $username, $password, $dbname);

         if ($conn3->connect_error) {
          die("Connection failed: " . $conn3->connect_error);
          }
          if (!$conn3->set_charset("utf8")) { printf("Error loading character set utf8: %s\n", $conn3->error); exit();}

    $conn3->query("SET NAMES 'utf8'");

        $serial=substr($_POST['gameOn'], 5);
        $x = $_SESSION["name"];
        $conn3->query("update games set player2 = '$x' where serial = $serial"); 
      
      }
      function myfunc(){
         $servername="localhost";
         $username = "root";
         $password = "";
         $dbname = "taldb";


         $conn3 = new mysqli($servername, $username, $password, $dbname);

         if ($conn3->connect_error) {
          die("Connection failed: " . $conn3->connect_error);
          }
        $delete = $_POST['delete'];
        $conn3->query("delete from user where id = $delete");
      }
      function myfunc3(){
          $servername="localhost";
         $username = "root";
         $password = "";
         $dbname = "taldb";


         $conn3 = new mysqli($servername, $username, $password, $dbname);

         if ($conn3->connect_error) {
          die("Connection failed: " . $conn3->connect_error);
          }

          $delgame= substr($_POST['delgame'], 16);
          $conn3->query("delete from games where serial = '$delgame'");


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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
  *{
    box-sizing:border-box;
    margin:0px;
    }

header{
height: 20%;
}
.x{
  height:80%;
  float: left;
}
aside{
  width:20%;
}
main{
  width:60%;
}
h3{
  text-align: center;
  font-family: 'Kalam';
  font-size: 22px;
  font-weight: bold;
  background-color: #ffff33;
  border:2px solid #adad85;
  border-radius: 20px;
  background-image: linear-gradient(to bottom right, #bfff80, #ffff33);
}
.y{
  height:17%;
  text-align: center;
  font-size:15px;
}
#zresults{
  font-size:20px;
}
.z{
  height: 70%;
}
.row{
  margin:auto;
  margin-bottom: 3%;
  border-radius: 20%;

}
table{
width:100%;
font-size: 13px;
font-weight: normal;
}


#t1{
   font-weight: bold;
   color:#669999;
   border-bottom: 2px dotted #669999;
   width:100%;
   text-align: center;
}
.col-sm-8{
  background-color: #f5f5f0;
  font-size:13px;
}


form{
  font-size:12px;
}

.panel-heading{
  font-size:12px;
}
.games{
  width:20%;
  margin:auto;
}
.ga{
  text-align: center;
  margin-left:30%;
  font-size:13px;
  border:1px solid grey;
  border-radius: 30%;
  width:40%;
  margin-bottom: 2%;
  background-color: #f5f5f0;
}

.title{
  display: inline-block;
  font-family: 'Kalam';font-size: 45px;
  margin-left: 2%;
  margin-top:1%;
}



.ball{
  clear:both;
  float:left;
  margin-left:43%;
  margin-right: 30%;
}

.delgame{ 
  text-align: center;
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

.alert{
  font-size:13px;
}
.form-group{
  font-size:15px;
}
.panel-heading{
  font-size:17px;
}
.row{
  width:160%;
}

 .fa { 
  padding: 5px;
  width: 15px;
  text-align: center;
  text-decoration: none;
}

 .fa:hover { 
  opacity: 0.7;
}


 .fa-facebook { 
  background: #3B5998;
  color: white;
}
.btn{
  font-size:12px;
}

</style>
</head>
<body>
  <header>
<h1 class="title">welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?></h1>

<?php if($_COOKIE["admin"] != 1){
  ?>
  <?php include('header.html'); ?>

<?php } else{?>
<?php include('headeradmin.html'); ?>


<?php } ?>



</header>
<aside class="x">                                <!-- side a -->
  <div class="y">
    <h3 id="h3">find players! </h3>
    <form action="welcome.php" method="GET">
    <p><label>enter the level you're looking for:
           <select name="lvl" size="1">
            <option value=0 selected>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
           </select>
         </label></p>
         <p><button type="submit" class="btn btn-secondary">Search</button></p>
       </form>
         <form method="post">
         <button type="submit" class="btn btn-secondary" name="advanced">Advanced Search</button>
   </form>
          <?php if(isset($smes)) { ?><div class="alert alert-success" role="alert"> <?php echo $smes; ?> </div><?php } ?>
         <?php if(isset($fmes)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmes; ?> </div><?php } ?>


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


if(isset($_POST) & !empty($_POST)){

    if(!empty($_POST['subject'])){
        $subject=$_POST['subject'];
        $name = $_POST['name'];
        $isql = "INSERT INTO comments (name, subject) VALUES ('$name', '$subject')";
      $ires = mysqli_query($conn, $isql) or die(mysqli_error($conn));
         if($ires){
           $smsg = "Your Comment Submitted Successfully";
         }else{
          $fmsg = "Failed to Submit Your Comment";
         }

  }
  $result4=$conn->query("SELECT name,subject FROM comments");
}
        // if(empty($_POST['time']) & empty($_POST['gameOn']) & empty($_POST['delete']) & empty($_POST['delgame']) & empty($_POST['subject'])& empty($_POST['advanced']) & empty($_POST['invite'])){
    if(isset($_GET['lvl'])){
      echo "<script>alert(hi);</script";
    $lvl = $_GET['lvl'];
        $sql = "SELECT name,fb FROM user WHERE level = $lvl and name != 'admin' limit 5";

         $result= mysqli_query($conn,$sql);
         $count = mysqli_num_rows($result);
?> </div><div class="table"> <?php

      if($count > 0){
         ?><span id="lvlplayers">players on level <?php echo $lvl; ?>:</span> <?php

    echo "<style>table{  margin:auto; text-align:center; background-color:#f5f5f0; border:1px solid grey;} tr{ color: black; border:1px solid grey;} </style>
          <table><tr><th>name</th><th>invite</th><th>FB</th>";
         while($row = $result->fetch_assoc()) {
          if(!empty($row["fb"])){
             echo "<tr><td>" . $row["name"]. "</td><td><form method=post><button type=submit class=btn btn-Success value=".$row["name"]." name=invite >invite</button></form></td>"; ?> <td><a href= <?php echo $row["fb"]; ?> target="_blank" class="fa fa-facebook"></a></td></tr>
              <?php } else{
                         echo "<tr><td>" . $row["name"]. "</td><td><form method=post><button type=submit class=btn btn-Success value=".$row["name"]." name=invite >invite</button></form></td></tr>";
           
                        }
                    }

     echo "</table>";
} else {
     ?> <span id="zresults"> <?php echo "0 results"; ?> </span> <?php
}
?></div><?php
}


?>
   
  <div class="z">
    <h3>comments</h3>
    <br>

    <div class="panel panel-default">
  <?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

<div class="panel-heading"><b>Add a Comment</div>
  <div class="panel-body">
    <form method="post">
      <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Subject</label>
      <textarea name="subject" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
</div>
    
  <?php if(!empty($result4)){
  if($result4->num_rows > 0){ 
    while($row3 = $result4->fetch_assoc()){ ?>
<div class="container">
  <div class="row">
    <div class="col-sm-8 border border-secondary rounded-lg">
    <p id="t1"> <?php echo $row3["name"]; ?></p>

    <p><?php echo $row3["subject"]; ?></p>
      </div>
  </div>
</div>
<?php } } } ?>

</div>
</aside>
<main class="x">        <!-- main -->
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

if(isset($_POST) & !empty($_POST)){
   if(!empty($_POST['time'])){

        $time=$_POST['time'];
        $date = $_POST['date'];
        $sql = "INSERT INTO games (player1, player2, gdate, gtime) VALUES ('$_SESSION[name]','none','$date','$time')";
      $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
         if($res){
           $gsmsg = "Your match was posted successfully";
         }else{
          $gfmsg = "Failed to Submit Your match";
         }


     }

            $result5=$conn->query("SELECT player1,player2,gdate,gtime,serial FROM games");  


}


?>                        
    <h3>schedule your next match </h3>
    <br>
    
  <?php if(!empty($result5)){
  if($result5->num_rows > 0){ 
    while($row4 = $result5->fetch_assoc()){ ?>

           <div class="ga">
              <?php if($row4["player2"]=="none"){

                echo $row4["player1"]; ?> <b>vs <?php echo "<form action=welcome.php method=post><input type=submit name=gameOn value=Play_" . $row4["serial"]. "> </form>" ?>
                <?php }else{ 
                  echo $row4["player1"]; ?> <b>vs <?php echo $row4["player2"]; } ?>

          <p> <?php echo $row4["gtime"]; ?></p>
          <p><?php echo $row4["gdate"]; ?></p>
           
                             
      </div>
   


<?php } } }?>



  <br>

    <div class="games panel panel-default">
  <?php if(isset($gsmsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $gsmsg; ?> </div><?php } ?>
<?php if(isset($gfmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $gfmsg; ?> </div><?php } ?>

<div class="panel-heading"><b>post your next match</div>
  <div class="panel-body">
    <form method="post">
      <div class="form-group">
      <label for="exampleInputEmail1">Time</label>
      <input type="time" name="time" class="form-control" id="exampleInputEmail1" min="09:00" max="20:00" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Date</label>
      <input type="Date" name="date" class="form-control" id="exampleInputPassword1" min="2020-01-01" max="2020-12-31" required>
    </div>
    <button type="submit" class="btn btn-primary" name="newmatch">Submit</button>
  </form>
  </div>

</div>

</main>

<aside class="x">                                     <!-- side b -->
  <h3>our top 5 players </h3>
  <div class="table">
  <?php 

  $servername="localhost";
    $username = "root";
    $password = "";
    $dbname = "taldb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

if (!$conn->set_charset("utf8")) { printf("Error loading character set utf8: %s\n", $conn->error); exit();}

    $conn->query("SET NAMES 'utf8'");

  $result=$conn->query("SELECT id,name,level FROM user where name != 'admin' order by level desc limit 5");  
  if(!empty($result) && $result->num_rows > 0){
    echo "<style>table{  text-align:center; background-color:#f5f5f0; border:1px solid grey;} tr{ color: black; border:1px solid grey;} </style>
  <table><tr><th><b>players name</th><th><b>players level</th>";
         while($row = $result->fetch_assoc()) {
             echo "<tr><td>" . $row["name"]. "</td><td>" . $row["level"]. "</td></tr>";
          }
     echo "</table>";
} else {
     echo "0 results";
}

?>



</div>

<br>
<h3>The weekly question!</h3>

<?php if(isset($answer)) { ?><div class="alert alert-success" role="alert"> <?php echo $answer ?> </div><?php } ?>
<?php if(isset($badanswer)){ ?><div class="alert alert-danger" role="alert"> <?php echo $badanswer; ?> </div><?php } ?>
<?php if(isset($alreadyvoted)){ ?><div class="alert alert-danger" role="alert"> <?php echo $alreadyvoted; ?> </div><?php } ?>

<form method="GET" action="welcome.php">
  <p><label>Who's the best player in the history of the game??
           <select name="bestp" size="1">
            <option value="roger" selected>Roger federer (of course..)</option>
            <option value="nole">Novak djokobitch</option>
            <option value="nadal">Rafael nadull</option>
            <option value="diego">Diego Shortzman</option>
            <option value="medvedev">Evil Medvedev</option>
            <option value="stef">Stefanos Cringeypas</option>
            <option value="isner">John Servsner</option>
            <option value="cilic">Marin Chokic</option>
           </select>
           </label></p>
           <p><button type="submit" class="btn btn-secondary">Submit your answer</button>
         
 </form>

         <br>
  <canvas id="myChart"></canvas>
  <script>

    var roger = '<?php echo $roger; ?>';
    var nole = '<?php echo $nole; ?>';
    var nadal = '<?php echo $nadal; ?>';
    var isner = '<?php echo $isner; ?>';
    var cilic = '<?php echo $cilic; ?>';
    var stef = '<?php echo $stef; ?>';
    var medvedev = '<?php echo $medvedev; ?>';
    var diego = '<?php echo $diego; ?>';

    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Roger <3', 'Djokobithc', 'Nadaull', 'John Servsner', 'Marin Cokic', 'Stefanos Cringeypas', 'Evil Medvedev' , 'Diego Shortsman'],
        datasets: [{
            label: 'The Goat',
            backgroundColor: 'rgb(245, 158, 2)',
            borderColor: 'rgb(245, 158, 2)',
            data: [roger, nole, nadal, isner, cilic, stef, medvedev, diego]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>

</aside>

</body>


</html>
