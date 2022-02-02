<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>



<?php
$del_id=$_GET['remove_id'];
echo "ID=".$del_id;
$del_id1 = intval($del_id);

?>


<?php

//Setting up a connection

$servername = "localhost";
$username = "114708";
$password = "saltaire";
$dbname = "114708";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM contacts WHERE contactid='$del_id1'";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();


header("Location: main.php");

?>