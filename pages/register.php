<?php
// Start the session
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Saltaire Sports - Contact Management System</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  
<?php
$operation    = $_POST['operation'];
if ($operation == "add") {
  echo "<h3>Add Contact</h3>";
} else {
  echo "<h3>Edit Contact</h3>";
}
?>
      

      <?php
        // add error message if previous attempt failed
        if(!empty($_SESSION['save_msg']))
        {
            echo '<p class="text-danger">';
            echo $_SESSION['save_msg'];
            $_SESSION['save_msg'] = "";
            echo '</p>';
        }
      ?>

<?php
  $rowID = $_POST['edit'];
  $conn = getDBConnection();        // get connection to database
  $row = getContactData($conn, $rowID);    // get contact detail for specified row


//
// This function reads contact data from the database and calls buildTableEntry
//
function getContactData($conn, $rowID) {
  $sql = "SELECT contactid, name, email FROM contacts";
  $sql = $sql . " where contactid = " . $rowID . ";";
  $result = mysqli_query($conn, $sql);      // access database
  $row = array();                           // empty array
 
  if (mysqli_num_rows($result) == 1) {       // if 1 row returned, get info
    $row = mysqli_fetch_assoc($result);   // build table row for each returned row
  } else {
    echo "0 results";
  }
   return $row;
}

//
// Get database connection
//
function getDBConnection() {
  // get connection to MySQL database
	$servername = "localhost";
	$username = "114708";
	$password = "saltaire";

	try {
		$conn = new PDO("mysql:host=".$servername.";dbname=114708;", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully";
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
  return $conn;
}

?>

<form name='form1' id='form1' class="form-signin" action="add.php" method="get">    
<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">Full Name</span>
  </div>
  <input type="text" name="name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
</div>
      
<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
  </div>
  <input type="text" name="email"class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">password</span>
  </div>
  <input type="text" name="password"class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
</div>
<div class="form-row">
  <div class="form-group col-md-6">
      <label for="chooseMembership">Membership type</label>
      <select name="membership" id="chooseMembership" class="form-control">
        <option selected>Choose...</option>

        <!-- Casual Membership type -->
        <option value="Casual">Casual</option>

        <!-- Fitness Membership type -->
        <option value="Fitness">Fitness</option>

        <!-- Dedicated Membership type -->
        <option value="Dedicated"> Dedicated</option>
      </select>
    </div>
    </div>
 <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

</form>


    
  </body>
  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>&copy; Harriet Brooke 2021</p>
    </div>
  </footer>
</html>
