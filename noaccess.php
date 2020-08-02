
<?php

session_start();
session_destroy();

echo "no access to this page!!";

echo "<br>
<br>
<a href=index.php>get back to login page</a>";

?>