
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookmyVenue</title>
    
</style>
</head>
<body>
<?php 
require('header.php');
?> 

<section>

<div id="cardsbackground" class="row row-cols-1 row-cols-md-3 g-4 p-3 mt-3" >
  <div class="col">
    <div class="card h-100">
      <img src="img/muharraq.png" class="card-img-top" alt="..."  >
      <div class="card-body">
        <h5 class="card-title">Muharraq</h5>
        <p class="card-text">Secure your spot at Muharraq's finest stadium today! Experience top-notch amenities and incredible comforts for an unforgettable time. It's the ultimate destination for an unparalleled experience you won't find anywhere else!</p>
      </div>
      <button type="button" class="btn btn-info">
        <a href="viewgrounds.php?city=Muharraq" class="text-decoration-none link-dark"> View Stadiums</a></button>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 ">
      <img src="img/manama.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Manama</h5>
        <p class="card-text">Secure your spot at Manama's finest stadium today! Experience top-notch amenities and incredible comforts for an unforgettable time. It's the ultimate destination for an unparalleled experience you won't find anywhere else!</p>
      </div>
      <button type="button" class="btn btn-info">
        <a href="viewgrounds.php?city=Manama" class="text-decoration-none link-dark"> View Stadiums</a></button>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="img/riffa1.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Riffa</h5>
        <p class="card-text">Secure your spot at Riffa's finest stadium today! Experience top-notch amenities and incredible comforts for an unforgettable time. It's the ultimate destination for an unparalleled experience you won't find anywhere else!</p>
      </div>
     <button type="button" class="btn btn-info">
        <a href="viewgrounds.php?city=Riffa" class="text-decoration-none link-dark"> View Stadiums</a></button>
    </div>
  </div>
  
</div>

</section>


<?php 
require('footer.php');
?> 
</body>
</html>