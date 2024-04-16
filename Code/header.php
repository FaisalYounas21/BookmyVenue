<?php 

session_start(); 

if(isset($_SESSION['activeUser'])) {
  
    $loggedIn = true;
} else {
 
    $loggedIn = false;
}

  extract($_POST);
  if(isset($signsbt))
  {
      if($pass!=$cpass)
     echo "Passwords are not Identical!. Try Again";
     else{
      try{
        require('connection.php');
        $hashp=password_hash($pass,PASSWORD_DEFAULT);
        $sql="INSERT INTO users VALUES(null,'regular','$uname','$phone','$hashp')";
  
  
        $check=$db->exec($sql);
        if($check===1)
        echo"Successfully Registered. <a href='index.php'>Login</a>";
        die();
      }
  
  
      catch(PDOException $ex){
          $db->rollBack();
          if($db->errorCode()==23000)
          echo"User Name already taken";
          else
          die($ex->getMessage());
          }
          $db=null;
      }
  }

  if(isset($logsbt)){
    try{
        require('connection.php');
        
        $r=$db->query("SELECT * FROM users where Username='$uname'");
        if($row=$r->fetch()){
            if(password_verify($pass,$row['Password']))

          { 
            $_SESSION['activeUser']=$row['Username'];
            
            
            if($row['Usertype']=='Admin'|| $row['Usertype']=='admin'){
                header("location:addstadium.php?username=$row[2]"); 
            }
            else if ($row['Usertype']=='Regular' || $row['Usertype']=='regular'){
                header("location:index.php?username=$row[2]"); 
            }
            die();
          }
          else{
            echo"<div class='alert alert-danger' role='alert'>
            <p>Invalid Password</p>
        </div>";
          }
     
        }
        else{
          echo"<div class='alert alert-danger' role='alert'>
          <p>Invalid Username</p>
      </div>";
        }
       
        $db=null;
    }
    catch(PDOException $ex){
        
        echo $ex->getMessage();
        }
}
?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookmyVenue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
  <body>
  
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php" style="color:rgb(16, 16, 104);">BookmyVenue</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link me-2 fw-bold" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2 fw-bold" href="stadiums.php">Book Now</a>
            </li>
            <?php if($loggedIn): ?>
            <li class="nav-item">
              <a class="nav-link me-2 fw-bold" href="reservation.php">My Reservations </a>
            </li>
            <?php endif; ?>
            <?php if(isset($_SESSION['activeUser']) && $_SESSION['activeUser'] == 'Admin'): ?>
              <li class="nav-item">
              <a class="nav-link me-2 fw-bold" href="addstadium.php">Add Stadium</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link me-2 fw-bold" href="aboutus.php">About US</a>
            </li>
            
           

          </ul>
          <?php if($loggedIn):{ ?>
            <a href="logout.php" class="btn btn-outline-primary me-lg-2 me-3">Logout</a>
          
                  <h5>Welcome <?php echo $_SESSION['activeUser']; ?></h5>
             <?php }?> 

            <?php else: ?>
          <button type="button" class="btn btn-outline-primary me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
           Login
          </button>

          <button type="button" class="btn btn-outline-primary me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#registerModal">
           Register
           </button>
           <?php endif; ?>
        </div>
      </div>
    </nav>

    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <form method="post" action="">
            <div class="modal-header ">
              
              <h1 class="modal-title d-flex align-items-center fs-5 me-2" id="staticBackdropLabel">User Login
                <i class="bi bi-person-circle fs-3 me-2"></i>
              </h1>
              <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
              <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="text" class="form-control shadow-none" name="uname">
              </div>
 
              
              <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none" name="pass">
              </div>
            </div>
                    <div class="d-flex align-items-center justify-content-center mb-2">
            <button type="submit" class="btn btn-secondary " name="logsbt">Login</button>
        </div>

          </form>
       
        </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <form method="post" action="">
            <div class="modal-header ">
              
              <h1 class="modal-title d-flex align-items-center fs-5 me-2" id="staticBackdropLabel">Registeration
                <i class="bi bi-person-circle fs-3 me-2"></i>
              </h1>
              <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
              <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="text" class="form-control shadow-none" name="uname" >
              </div>

              <div class="mb-4">
                <label class="form-label">Phone</label>
                <input type="number" class="form-control shadow-none" name="phone">
              </div>

              <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none" name="pass">
              </div>

              <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control shadow-none" name="cpass">
              </div>

            </div>
            <div class="d-flex align-items-center justify-content-center mb-2" style="padding: 20px;">
              <button type="submit" class="btn btn-secondary me-2" name="signsbt">Register</button>
              <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
            </div>

          </form>
       
        </div>
      </div>
    </div>


    