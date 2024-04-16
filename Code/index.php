<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookmyVenue</title>
  <link rel="stylesheet" href="style.css">
   <style>
       
        .welcome-message {
            margin-top:20px;
            padding: 20px; 
            text-align: center; 
            font-size: 4vw;
            font-family: 'Roboto', sans-serif;
            color: goldenrod; 
            font-weight:bold;
        }
    </style>
</head>
<body>
  
<?php 
require('header.php');
?> 




<section class="mainCarousel">


  <div id="carouselExampleDark" class="carousel carousel-dark slide mt-5 mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
          <img src="img/muharraq.png" style="max-width: 100%; max-height: 100%;" class="d-block" alt="...">
        </div>
      
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
          <img src="img/manama.png" style="max-width: 100%; max-height: 100%;" class="d-block" alt="...">
        </div>
       
      </div>
      <div class="carousel-item">
        <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
          <img src="img/riffa1.png" style="max-width: 100%; max-height: 100%;" class="d-block" alt="...">
        </div>
        
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>
<div class="welcome-message">
    Book now for an exciting match
</div>

<section > 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-items-center p-5">
            <div class="text-center">
                <img src="img/book.png" class="card-img-top rounded-circle shadow-lg mb-4" alt="..." style="width: 60vw; height: 60vw; max-width: 400px; max-height: 400px;"> <!-- Set width and height in viewport width (vw) units -->
               
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center p-5">
            <button type="button" class="btn btn-lg btn-lg-lg" style="background-color:goldenrod"> 
                <a href="stadiums.php" class="text-decoration-none " style="color:white;font-weight:bold">Book Your Venue Now</a>
            </button>
        </div>
    </div>
</div>


 
 

</section>

<?php
require('footer.php');
?>



</body>
</html>