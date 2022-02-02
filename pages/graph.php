<?php
   // Start the session
   session_start();
   ?>

<?php
  if ($_SESSION["status"] != 'loggedInAdmin') {
    header("location:login.php");
    exit();
  }


?>
<!DOCTYPE html>
<html>
<head>
  <title>K1J Ltd</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

  <!-- Dashboard -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" >

  <link rel="stylesheet" href="style.css" >
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <link rel="stylesheet" href="style.css" >

</head>
<body id="body-pd">
    
    TESTER FOR DASHBOARD ANALYTICS
    
    <!--Container Main start-->
    <?php 
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

      $sql = "SELECT * FROM products";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $data = $data . '"' . $row["numOfSales"] . '", ';
              $data2 = $data2 . '"' . $row["numOfInteractions"] . '", ';
              $data3 = $data3 . '"' . $row["name"] . '", ';
              //echo "<br> Number of users: ". $row["users"]. " - Year: ". $row["time"]. "<br>";
          }
          $data = trim($data, ",");
          $data2 = trim($data2, ",");
          $data3 = trim($data3, ",");
      } else {
          echo "0 results";
      }


      // Add all the product sales together to find the total sales
      $result = mysqli_query($conn, 'SELECT SUM(numOfSales) AS value_sum FROM products'); 
        $row = mysqli_fetch_assoc($result); 
        $sum = $row['value_sum'];


      // Add all the product interactions together to find the total interactions
      $result = mysqli_query($conn, 'SELECT SUM(numOfInteractions) AS value_sum2 FROM products');
        $row = mysqli_fetch_assoc($result); 
        $sum2 = $row['value_sum2'];

        // Total amount of Sales
        echo '<h4>Total amount of Sales: ' . $sum . '</h4>';
        // Total Interactions
        echo '<h4>Total Interactions: ' . $sum2 . '</h4>';


      // Total Sales
      $result = mysqli_query($conn, 'SELECT price,numOfSales,(price*numOfSales) AS total_price FROM products;'); 
        $row = mysqli_fetch_assoc($result); 
        $sum3 = $row['total_price'];

        echo '<h4>Total Sales: ' . $sum3 . '</h4>';

    ?>
    <div class="height-100 bg-light">
      <canvas id="6last" style="width:100%;max-width:600px"></canvas>
      <canvas id="target" style="width:100%;max-width:600px"></canvas>
    </div>

<!-- FOOTER -->
<div class="footer-copyright text-center py-3">
  <?php include 'footer.php';?>
</div>

<script>
// GRAPH 1
var xValues = [<?php echo $data3; ?>];
var yValues = [<?php echo $data; ?>];
var barColors = ["#F94144", "#F3722C", "#F8961E", "#F9844A", "#F9C74F", "#90BE6D", "#43AA8B", "#4D908E", "#577590"];
// "#F94144", "#F3722C", "#F8961E", "#F9844A", "#F9C74F", "#90BE6D", "#43AA8B", "#4D908E", "#577590"

new Chart("6last", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Number of Sales "
    }
  }
});


// GRAPH 2
var xValues2 = [<?php echo $data3; ?>];
var yValues2 = [<?php echo $data2; ?>];
var barColors = ["#F94144", "#F3722C", "#F8961E", "#F9844A", "#F9C74F", "#90BE6D", "#43AA8B", "#4D908E", "#577590"];
// "#F94144", "#F3722C", "#F8961E", "#F9844A", "#F9C74F", "#90BE6D", "#43AA8B", "#4D908E", "#577590"

new Chart("target", {
  type: "bar",
  data: {
    labels: xValues2,
    datasets: [{
      backgroundColor: barColors,
      data: yValues2
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Number of Interactions "
    }
  }
});
</script>



<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) {

const showNavbar = (toggleId, navId, bodyId, headerId) =>{
const toggle = document.getElementById(toggleId),
nav = document.getElementById(navId),
bodypd = document.getElementById(bodyId),
headerpd = document.getElementById(headerId)

// Validate that all variables exist
if(toggle && nav && bodypd && headerpd){
toggle.addEventListener('click', ()=>{
// show navbar
nav.classList.toggle('show')
// change icon
toggle.classList.toggle('bx-x')
// add padding to body
bodypd.classList.toggle('body-pd')
// add padding to header
headerpd.classList.toggle('body-pd')
})
}
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE =====*/
const linkColor = document.querySelectorAll('.nav_link')

function colorLink(){
if(linkColor){
linkColor.forEach(l=> l.classList.remove('active'))
this.classList.add('active')
}
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

// Your code to run since DOM is loaded and ready
});
</script>

<?php $conn->close(); ?>

</body>
</html>