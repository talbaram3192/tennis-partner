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
		<form method="GET" action="search.php">
			<input type="text" name="q" placeholder="Search Query...">
			<select name="column">
				<option value="name" selected>User Name</option>
				<option value="Email">Email</option>
			</select>
			<input type="submit" name="submit" value="Find">
		</form>

</html>

		<?php
		$connection = new mysqli("localhost", "root", "", "taldb");
		

         if (isset($_GET['submit'])) {
		// 	$q = $connection->real_escape_string($_GET['q']);
		// $column = $connection->real_escape_string($_GET['column']);

         	$q=$_GET['q'];
         	$column=$_GET['column'];
            echo "results for ".$q." :";

		$sql = $connection->query("SELECT id,name,level FROM user WHERE $column LIKE '%$q%'");
		if ($sql->num_rows > 0) {
			
			echo "<style>table{  text-align:center; background-color:#daf1f1; border: 2px black solid;} tr{ color: black; border: 2px black solid;} td{ color: black; border: 2px black solid;} th{ color: black; border: 2px black solid;}</style>
				<table><tr><th>ID</th><th>UserName</th><th>Level</th>";
			while ($data = $sql->fetch_array())
			{
				 echo "<tr><td>" . $data["id"]. "</td><td>" . $data["name"]. "</td><td>" . $data["level"]."</td></tr>";
				
                }
					  
				 echo "</table>";
			
		} else
			echo "Your search query doesn't match any data!";
	}
	echo "<a href=welcome.php>back to home page</a>";


?>