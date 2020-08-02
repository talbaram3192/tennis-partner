<?php


session_start();

if(!isset($_SESSION['name'])){
    header("location:index.php");
}

    
      elseif(isset($_POST['approve'])){
        approve();
      }
      elseif(isset($_POST['reject'])){
        reject();
      }elseif(isset($_POST['sendto'])){
         $sendto = $_POST['sendto'];
         $message = $_POST['message'];

         include('connect.php');

          $conn->query("INSERT INTO messages(sending,receiving,content) VALUES('$_SESSION[name]','$sendto','$message'");
           $isql = "INSERT INTO messages(sending,receiving,content) VALUES('$_SESSION[name]','$sendto','$message')";
           $ires = mysqli_query($conn, $isql) or die(mysqli_error($conn));
         if($ires){
           $smsg = "You sent a message";
         }else{
          $fmsg = "Failed to send your message";
         }

        }

      if(isset($_GET['background'])){
        
           include($_GET['background']);
           if($_GET['background'] == "greenback.html"){
            $_SESSION['color'] = "greenback.html";
           }else{
            $_SESSION['color'] = "brownback.html";
           }
      }elseif(isset($_GET['wongame'])){

         myfunc1();
         $reportedwin="you reported your win :) game: ".$_GET['wongame'];
      }elseif(isset($_GET['lostgame'])) {
        myfunc2();
        $reportedloss="you reported your loss :( game: ".$_GET['lostgame'];
      }


      
        if(isset($_SESSION['color'])){
          include($_SESSION['color']);
        }else{
          include("greenback.html");
         }
        
       

    function myfunc1(){

     include('connect.php');

     $gamenum=$_GET['wongame'];

     $result2=$conn->query("SELECT player1,player2,reportwon,reportlost,reportwon2,reportlost2 FROM games WHERE serial = $gamenum ");
	
	if($result2->num_rows > 0){ 
         $row2 = $result2->fetch_assoc();
         if($_SESSION["name"] == $row2["player1"]){
         if($row2["reportwon2"]==1){
            $conn->query("delete from games where serial = $gamenum");
         }else{
            $conn->query("update games set reportwon = 1 where serial = $gamenum");
            if($row2["reportlost2"]==1){
              $opname=$row2["player2"];
              $resultrank=$conn->query("select ranking from user where name = '$opname' ");
              if($resultrank->num_rows > 0){ 
               $rowx = $resultrank->fetch_assoc();
               $op = $rowx["ranking"];
               $conn->query("update user set won = won + 1 where name = '$_SESSION[name]' ");
               $conn->query("update user set loss = loss + 1 where name = '$row2[player2]' ");
               $conn->query("delete from games where serial = $gamenum");
               $sql="select count(1) FROM user";
               $result = mysqli_query($conn,$sql);
               $row = mysqli_fetch_array($result);
               $totalplayers = $row[0];
               $sqlop="select count(1) FROM user where ranking > $op ";
               $resultop = mysqli_query($conn,$sqlop);
               $rowop = mysqli_fetch_array($resultop);
               $totalop = $rowop[0];
               $totalop += 1;
               //decide how many points to give base on opponents ranking
               if($totalop / $totalplayers >= 0.9){
                $conn->query("update user set ranking = ranking + 5 where name = '$_SESSION[name]' ");
               }elseif($totalop / $totalplayers <= 0.1){
                $conn->query("update user set ranking = ranking + 20 where name = '$_SESSION[name]' ");
               }else{
                $conn->query("update user set ranking = ranking + 10 where name = '$_SESSION[name]' ");
               }
             }
           }

            }

         }else{
          if($row2["reportwon"]==1){
            $conn->query("delete from games where serial = $gamenum");
         }else{
           $conn->query("update games set reportwon2 = 1 where serial = $gamenum");
             if($row2["reportlost"]==1){
              $opname=$row2["player1"];
              $resultrank=$conn->query("select ranking from user where name = '$opname' ");
              if($resultrank->num_rows > 0){ 
               $rowx = $resultrank->fetch_assoc();
               $op = $rowx["ranking"];
               $conn->query("update user set won = won + 1 where name = '$_SESSION[name]' ");
               $conn->query("update user set loss = loss + 1 where name = '$row2[player1]' ");
               $conn->query("delete from games where serial = $gamenum");
               $sql="select count(1) FROM user";
               $result = mysqli_query($conn,$sql);
               $row = mysqli_fetch_array($result);
               $totalplayers = $row[0];
               $sqlop="select count(1) FROM user where ranking > $op ";
               $resultop = mysqli_query($conn,$sqlop);
               $rowop = mysqli_fetch_array($resultop);
               $totalop = $rowop[0];
               $totalop += 1;
               if($totalop / $totalplayers >= 0.9){
                $conn->query("update user set ranking = ranking + 5 where name = '$_SESSION[name]' ");
               }elseif($totalop / $totalplayers <= 0.1){
                $conn->query("update user set ranking = ranking + 20 where name = '$_SESSION[name]' ");
               }else{
                $conn->query("update user set ranking = ranking + 10 where name = '$_SESSION[name]' ");
               }
             }  
            }     
          }
         }
        }

  }

  function myfunc2(){

     include('connect.php');

     $gamenum=$_GET['lostgame'];
     $result2=$conn->query("select player1,player2,reportlost,reportwon,reportlost2,reportwon2 from games where serial = $gamenum ");

     if($result2->num_rows > 0){ 
        $row2 = $result2->fetch_assoc();
         if($_SESSION["name"] == $row2["player1"]){
           if($row2["reportlost2"]==1){
            $conn->query("delete from games where serial = $gamenum");
         }else{
            $conn->query("update games set reportlost = 1 where serial = $gamenum");
            if($row2["reportwon2"]==1){
              $opname=$row2["player1"];
              $resultrank=$conn->query("select ranking from user where name = '$opname' ");
              if($resultrank->num_rows > 0){ 
               $rowx = $resultrank->fetch_assoc();
               $op = $rowx["ranking"];
               $conn->query("update user set loss = loss + 1 where name = '$_SESSION[name]' ");
               $conn->query("update user set won = won + 1 where name = '$row2[player2]' ");
               $conn->query("delete from games where serial = $gamenum");
               $sql="select count(1) FROM user";
               $result = mysqli_query($conn,$sql);
               $row = mysqli_fetch_array($result);
               $totalplayers = $row[0];
               $sqlop="select count(1) FROM user where ranking > $op ";
               $resultop = mysqli_query($conn,$sqlop);
               $rowop = mysqli_fetch_array($resultop);
               $totalop = $rowop[0];
               $totalop += 1;
               if($totalop / $totalplayers >= 0.9){
                $conn->query("update user set ranking = ranking + 5 where name = '$row2[player2]' ");
               }elseif($totalop / $totalplayers <= 0.1){
                $conn->query("update user set ranking = ranking + 20 where name = '$row2[player2]' ");
               }else{
                $conn->query("update user set ranking = ranking + 10 where name = '$row2[player2]' ");
               }
             }
           }

        }
         }else{
           if($row2["reportlost"]==1){
            $conn->query("delete from games where serial = $gamenum");
         }
           $conn->query("update games set reportlost2 = 1 where serial = $gamenum");
             if($row2["reportwon"]==1){
              $opname=$row2["player2"];
              $resultrank=$conn->query("select ranking from user where name = '$opname' ");
              if($resultrank->num_rows > 0){ 
               $rowx = $resultrank->fetch_assoc();
               $op = $rowx["ranking"];
               $conn->query("update user set loss = loss + 1 where name = '$_SESSION[name]' ");
               $conn->query("update user set won = won + 1 where name = '$row2[player1]' ");
               $conn->query("delete from games where serial = $gamenum");
               $sql="select count(1) FROM user";
               $result = mysqli_query($conn,$sql);
               $row = mysqli_fetch_array($result);
               $totalplayers = $row[0];
               $sqlop="select count(1) FROM user where ranking > $op ";
               $resultop = mysqli_query($conn,$sqlop);
               $rowop = mysqli_fetch_array($resultop);
               $totalop = $rowop[0];
               $totalop += 1;
               if($totalop / $totalplayers >= 0.9){
                $conn->query("update user set ranking = ranking + 5 where name = '$row2[player1]' ");
               }elseif($totalop / $totalplayers <= 0.1){
                $conn->query("update user set ranking = ranking + 20 where name = '$row2[player1]' ");
               }else{
                $conn->query("update user set ranking = ranking + 10 where name = '$row2[player1]' ");
               }
            }       
          }
        }
      }
  }

     function approve(){

      include('connect.php');

    
         $player2=$_POST["approve"];

         $conn->query("insert into games(player1,player2) values('$_SESSION[name]','$player2') ");

     $conn->query("delete from invitations where inviting = '$player2' and invited = '$_SESSION[name]'");

     }
     function reject(){
      include('connect.php');

         $player2=$_POST["reject"];

          $conn->query("delete from invitations where inviting = '$player2' and invited = '$_SESSION[name]'");

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
	*{
		box-sizing:border-box;
		margin:0px;
		}
body{
  height:1000px;
  font-family: 'Dekko';
  font-size: 30px;

}
header{
height: 20%;
}

aside{
	width:20%;
}
main{
	width:60%;
}
aside{
  width:20%;
}
.x{
	height:80%;
	float:left;
}

	
	.ga{
	font-weight: bold;
	text-align: center;
	margin-left:30%;
	font-size:13px;
	border:1px solid grey;
	border-radius: 20%;
	width:40%;
	margin-bottom: 2%;
  margin-top: 2%;
  background-color: #f5f5f0;

}
#addpic{
  position: absolute;
  top:-72px;
  width:150px;
  text-align: center;
  font-weight: bold;
  font-size: 20px;
  background-color: #f5f5f0;
  border-radius: 20px;
  border:2px solid #adad85;

}
h2{
	text-align: center;
  font-family: 'Kalam';
  font-size: 22px;
  font-weight: bold;
  background-color: #ffff33;
  border:2px solid #adad85;
  border-radius: 20px;
  background-image: linear-gradient(to bottom right, #bfff80, #ffff33);
}
h3{
  text-align: center;
  text-decoration: underline;
  font-weight: bold;
}

#wonbutton{
	font-weight: bold;
}
#lostbutton{
	font-weight: bold;

}
.alert{
	width:40%;
	margin:auto;
	text-align: center;
	font-weight: bold;
  font-size: 15px;
}

.profile{
	text-align: center;
	margin-top: 10%;
  font-size:15px;
}

#img{
  position: absolute;
  margin-left:25%;

}
.title{
  display: inline-block;
  font-family: 'Kalam';font-size: 45px;
  margin-left: 2%;
  margin-top:1%;
}

.invite{
  text-align: center;
  border:1px solid black;
  border-radius: 20%;
  font-size:15px;
  margin-top:10%;
  padding: 15%;
  background-color: #f5f5f0;
}
/* Popup container */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

/* The actual popup (appears on the bottom) */
.popup .popuptext {
  visibility: hidden;
  width: 200px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  top: 110%;
  left: 30%;
  margin-left: -80px;
  font-size: 15px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
  transform: rotate(-180deg);
}

/* Toggle this class when clicking on the popup container (hide and show the popup) */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
#upimg{
  color:black;
}
img{
  border-radius: 50%;
  border-style: outset;
  border-color:  #669999;
  border-width: 7px;
}
#winstats{
  font-size:20px;
  font-weight: bold;
}
.background{
  font-size: 15px;
  float:left;

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
  margin-left: 2%;
}
.panel-heading{
  font-size:18px;
  background-color: #f5f5f0;
  margin-left: 2%;
  text-align: center;
}
.form-group{
  font-size:15px;

}
.panel-body{
  background-color: white;
  margin-bottom: 7%;
  margin-left: 2%;
  text-align: center;
}
select{
  margin-bottom: 5%;
}
.alert{
  width:100%;
  margin-bottom: 3%;
}
.report{
  width:40%;
}


</style>

	</head>

<body>
	<header>
<h1 class="title"><?php echo htmlspecialchars($_SESSION["name"]); ?>'s profile:</h1>
<form method="GET" action="myGames.php">
  <p class="background"><label>Choose your background
           <select name="background">
            <option value="greenback.html">Green</option>
            <option value="brownback.html">Brown</option>
           </select>
  </label></p>
  <button class="background" type="submit" class="btn btn-secondary">Choose</button>
</form>

<?php if($_COOKIE["admin"] != 1){
	?>
  <?php include('header.html'); ?>

<?php } else{?>
<?php include('headeradmin.html'); ?>


<?php } ?>
<?php

     include('connect.php');
     $sql = $conn->query("select pic from user where name = '$_SESSION[name]' ");
     if($sql->num_rows > 0){ 
		    while($row = $sql->fetch_assoc()){
		    	$profilepic =$row["pic"];
		    }
		}

 ?><?php if(!empty($profilepic)){ ?>
  <div class="popup" onclick="addpic()" id="img"><img src = <?php echo $profilepic ?> width=130 height=100>
   <span class="popuptext" id="myPopup"><form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload-Image" name="submit" id="upimg">
      </form></span></div> <?php }else{
         ?>  <div class="popup" onclick="addpic()" id="img"> <span id="addpic">Click to add your profile picture!</span>
           <span class="popuptext" id="myPopup"><form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload-Image" name="submit" id="upimg">
      </form></span></div>
   <?php } ?>

 <script>
// When the user clicks on <div>, open the popup
function addpic() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>
</header>

<aside class="x">
<h2>your stat's</h2>
<div class="profile">
<h3>Ranking</h3>
<?php
     include('connect.php');
    $sql = "SELECT 
        ROW_NUMBER() OVER(ORDER BY ranking DESC) AS place,
        name,ranking,won,loss
        FROM user";

    $result= mysqli_query($conn,$sql);
    while($row = $result->fetch_assoc()){
         if($row['name'] == $_SESSION['name']){
            $myranking=$row['place'];
            $mypoints=$row['ranking'];
         }
    }
    echo $myranking;
    echo "<h3>Points</h3>";
    echo $mypoints;

?>

<h3>wins</h3>
<?php
     include('connect.php');

         $wins=$conn->query("select won from user where name= '$_SESSION[name]' ");
         if($wins->num_rows > 0){ 
		    while($row3 = $wins->fetch_assoc()){
		    	echo $row3["won"];
		    }
		}
   

  ?>  
<h3>losses</h3>

<?php
     include('connect.php');

         $loss=$conn->query("select loss,won from user where name= '$_SESSION[name]' ");
         if($loss->num_rows > 0){ 
		    while($row3 = $loss->fetch_assoc()){
		    	echo $row3["loss"];
		    	if($row3["won"]==0 & $row3["loss"]==0){
		    		$total =0;
		    	}
		    	else{
		    	$total = ($row3["won"]) / (($row3["won"]+$row3["loss"])) *100 ;
		    	$total = (int) $total;
		       }
		    }
		}

		echo "<br>
              <br>";
        
        ?><span id="winstats"> your'e winning <?php echo $total; ?>% of your matches </span> <?php
        echo "<br>
              <br>
              <br>
              <br>";

?>

<form action=myGames.php method="GET">
<p>Let others find you on FaceBook!</p>
<input type="url" name="FB">
<button type="submit" class="btn btn-secondary">submit</button>
</form>

<p> <?php include("fb.php"); ?> </p>

	</div>

  <h2>Messages</h2>
  <?php
     include('connect.php');

    ?>
<?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
<div class="panel-heading"><b>Send someone a message</div>
  <div class="panel-body">
    <form method="post">
      <div class="form-group">
      <label for="exampleInputEmail1">Send to:</label>
      <select name = "sendto">
      <?php 
        $sql = $conn->query("SELECT name FROM user WHERE name != '$_SESSION[name]'");
        if($sql->num_rows > 0 ){
          while($row = $sql->fetch_assoc()){
            ?>
                  <option value = <?php echo $row['name']; ?>><?php echo $row['name']; ?></option><?php
          }
        } ?>
      
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Subject</label>
      <textarea name="message" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
</div>

    <?php

    $sql = $conn->query("SELECT sending,content FROM messages WHERE receiving = '$_SESSION[name]'");
    if($sql->num_rows>0){
      while($row = $sql->fetch_assoc()){ ?>
            <div class="container">
               <div class="row">
               <div class="col-sm-8 border border-secondary rounded-lg">
                 <p id="t1"> <?php echo $row["sending"]; ?></p>

                  <p><?php echo $row["content"]; ?></p>
              </div>
  </div>
</div> <?php
      }
    }
    ?>

 
	</aside>

<main class="x">
	<h2>report your scores</h2>
<?php


     include('connect.php');

    $result=$conn->query("SELECT player1,player2,gdate,gtime,serial,reportwon,reportlost,reportwon2,reportlost2 FROM games WHERE '$_SESSION[name]' = player1 or '$_SESSION[name]' = player2");

     if(isset($reportedwin)) { ?> <div class="report alert alert-success" role="alert"> <?php echo $reportedwin; ?> </div> <?php } ?>
      <?php if(isset($reportedloss)){ ?> <div class="report alert alert-danger" role="alert"> <?php echo $reportedloss; ?> </div><?php } 
	
	if($result->num_rows > 0){ 
		while($row = $result->fetch_assoc()){ ?>

           <div class="ga">
           	  <?php if($row["player2"] != "none"){

           	  	echo $row["player1"]; ?> vs <?php echo $row["player2"];
                if(

                    (($_SESSION["name"] == $row["player1"]) && ($row["reportwon"] == 1 || $row["reportlost"]==1)) or (($_SESSION["name"] == $row["player2"]) && ($row["reportwon2"]==1 || $row["reportlost2"]==1))
                ){ ?>

                  <p> <?php echo $row["gtime"]; ?></p>
                  <p> <?php echo $row["gdate"]; ?></p>

                  <p>games number: <?php echo $row["serial"]; ?> </p>
               <?php }else{  ?>

                   <p> <?php echo $row["gtime"]; ?></p>
                   <p> <?php echo $row["gdate"]; ?></p>
                   <p>games number: <?php echo $row["serial"]; ?> </p>

                  <form action="myGames.php" method="GET"><button onClick="reported()" id= "wonbutton" type="submit" class = "btn btn-success" name="wongame" value= <?php echo $row["serial"]; ?> >Won</button>  
                 <button id= "lostbutton" type="submit" class = "btn btn-danger" name="lostgame" value= <?php echo $row["serial"]; ?> >Lost</button></form>

                <?php }  ?>
           	      	
           	      
                  <?php
                  }else{
                  	echo "waiting for someone to join you"; 
                  	?>
                  	<p><?php echo $row["gtime"]; ?> </p>
		                <p><?php echo $row["gdate"];  ?> </p>
                    <p>games number: <?php echo $row["serial"]; } ?> </p> 

                  		                         		     
		  </div>
     
<?php } } ?>




</main>
<aside class="x">
  <h2>invitations</h2>
<?php

       include('connect.php');
       
      $sql="select inviting,invited,invitingemail,invitedemail from invitations where '$_SESSION[name]' = inviting or '$_SESSION[name]' = invited ";

         $result= mysqli_query($conn,$sql);
         $count = mysqli_num_rows($result);
         if($count > 0){
             while($row = $result->fetch_assoc()) {
               if($row["invitedemail"] == "null" ){
                  if($row["inviting"] == $_SESSION["name"]){
                    ?><div class="invite"><?php
                    echo "you invited <span style=font-weight:bold;>".$row["invited"]."</span>"; ?></div>
                    <?php
                  }
                  else{ 
                  ?><div class = "invite"><?php
                    echo "you were invited by <span style=font-weight:bold;>".$row["inviting"]."</span>";?>
                   <?php echo '<br><form method="post"> <button type="submit" class="btn btn-success" name="approve" value='.$row["inviting"].'>approve</button>
                    <button type="submit" class="btn btn-danger" name="reject" value='.$row["inviting"].'>reject</button></form>'; ?>
                    </div> <?php
                    
                  }
               }

             }
           }
          
         

?>
</aside>

</body>

	</html>