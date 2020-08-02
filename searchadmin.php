<!doctype html>

<html>
<head>
	<style>
      table{
      	margin-top: 4%;
      	margin-bottom:4%;

      }

	</style>
</head>



<h3>search for players </h3>
		<form method="POST" action="searchadmin.php">
			<input type="text" name="q" placeholder="Search Query...">
			<select name="column">
				<option value="name" selected>User Name</option>
				<option value="Email">Email</option>
			</select>
			<input type="submit" name="submit" value="Find">
		</form>

</html>

		<?php
			session_start();
		if(!isset($_SESSION['name'])){
        header("location:index.php");
      }
      include('connect.php');		

        if (isset($_POST['del'])){
        	myfunc();
        }
		else if (isset($_POST['submit'])) {
			$q = $conn->real_escape_string($_POST['q']);
		$column = $conn->real_escape_string($_POST['column']);

		$sql = $conn->query("SELECT id,name,level,admin FROM user WHERE $column LIKE '%$q%'");
		if ($sql->num_rows > 0) {
			echo "<style>table{  text-align:center; background-color:#daf1f1; border: 2px black solid;} tr{ color: black; border: 2px black solid;} td{ color: black; border: 2px black solid;} th{ color: black; border: 2px black solid;}</style>
				<table><tr><th>ID</th><th>UserName</th><th>Level</th><th>Admin</th><th>Delete</th>";
			while ($data = $sql->fetch_array())
			{
				if($data['admin'] == 0){
				 echo "<tr><td>" . $data["id"]. "</td><td>" . $data["name"]. "</td><td>" . $data["level"]. "</td><td>"."No". "</td><td><form action=searchadmin.php method=post><input type=submit name=del value=delete_id_".$data["id"]."></form></td></tr>";
				
                }
				 else{
				 echo "<tr><td>" . $data["id"]. "</td><td>" . $data["name"]. "</td><td>" . $data["level"]. "</td><td>" . "Yes". "</td></tr>";

				}
					  }
				 echo "</table>";
			
		} else
			echo "Your search query doesn't match any data!";
	}
	echo "<a href=welcomeadmin.php>back to home page</a>";

	function myfunc(){
        include('connect.php');
 		$delete=substr($_POST['del'], 10);
        $conn->query("delete from user where id = $delete"); 


	}
?>