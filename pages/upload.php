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
<html lang="en">
<head>
  <title>K1J Ltd</title>
  <link rel="shortcut icon" type="image/png" href="salefavi.png"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <!-- mdb -->
  <link rel="stylesheet" href="mdb.min.css" />
  
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

  <!-- Dashboard -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" >

  <link rel="stylesheet" href="style.css" >


</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <p style="font-size: 30px; margin-top: 12px;">K1J Ltd</p>
        <p style="margin-top: 12px;"> <a href="profile.php" style="color: black;"class="link-secondary"><strong>Hello</strong> <?php echo $_SESSION["username"]; ?>!</a></p>
    </header>
    <!-- Navigation bar -->
    <div class='l-navbar' id='nav-bar'>
        <nav class='nav'>
            <div>
              <a href='index.php' class='nav_logo'> <i class='bx bx-layer nav_logo-icon'></i> <span class='nav_logo-name'>K1J Ltd</span> </a>
                <div class='nav_list'>
                  <a href='index.php' class='nav_link'> <i class='bx bx-grid-alt nav_icon'></i> <span class='nav_name'>Dashboard</span> </a>

                  <a href='admins.php' class='nav_link active'> <i class='bx bxs-user-detail nav_icon'></i> <span class='nav_name'>Admins</span> </a>

                  <a href='users.php' class='nav_link'> <i class='bx bx-list-ul nav_icon'></i> <span class='nav_name'>Users | Customers</span> </a>

                  <a href='products.php' class='nav_link'> <i class='bx bx-store-alt nav_icon'></i> <span class='nav_name'>Products</span> </a>

                  <a href='profile.php' class='nav_link'> <i class='bx  bx-user nav_icon'></i> <span class='nav_name'>Profile</span> </a>

                  <a href='log.txt' class='nav_link'> <i class='bx bx-message-square-detail nav_icon'></i> <span class='nav_name'>Log</span> </a>

                </div>
            </div> <a href='logout.php' class='nav_link'> <i class='bx bx-log-out nav_icon'></i> <span class='nav_name'>SignOut</span> </a>
        </nav>
    </div>

    <?php
    try {

    //  $target_dir = "uploads/"; // permissions need to be set on this folder
        $target_file = "uploads/" . basename($_FILES["uploadFile"]["name"]);

    // Check if file already exists
        if (file_exists($target_file)) {
            throw new Exception("File already exists");        
        }

    // Check file size
        if ($_FILES["uploadFile"]["size"] > 10000000) {
            throw new Exception("File is too large");                
        }

    // try to upload file
        if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["uploadFile"]["name"]). " has been uploaded."."\r\n";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    } catch(Throwable $e) {
        echo $e->getMessage();
    }

    $image = basename($_FILES["uploadFile"]['name']);

    $check1 = $_FILES['uploadFile']['size'];

    $sizeKB = $check1 / 1000 . "KB";

    $imagedata = getimagesize("uploads/".$image);

    $width = $imagedata[0];
    $height = $imagedata[1];


    ?>

    <p></p>
    <img src="uploads/<?php echo $image; ?>">
    <br><br>
    File Size: <?php echo $sizeKB; ?>
    <br><br>
    File Name: <?php echo $_FILES['uploadFile']['name']; ?>
    <br><br>
    File Type: <?php echo $_FILES['uploadFile']['type']; ?>
    <br><br>
    Image Width x Height: <?php echo $width . 'x' . $height; ?>
    <br><br>
    
    <!-- FOOTER -->
    <div class="footer-copyright text-center py-3">
        <?php include 'footer.php';?>
    </div>


      <!-- Enables datatable -->
      <script type="text/javascript">
      $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
      });
      </script>






<!-- Custom Styles -->



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

</body>
</html>