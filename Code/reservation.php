<?php 
require('header.php');
require('connection.php'); 
$alert="";
$activeuser = $_SESSION['activeUser'];


if (isset($_GET['message'])) {
    if ($_GET['message'] == "success") {
        // Display success message for booking
        $alert="<div class='alert alert-success' role='alert'>Successfully Booked!</div>";
    } elseif ($_GET['message'] == "failure") {
        // Display failure message for booking
        $alert= "<div class='alert alert-danger' role='alert'>Booking failed. Please try again.</div>";
    }
    elseif ($_GET['message'] == "successcancel") {
        // Display success message for cancellation
        $alert= "<div class='alert alert-success' role='alert'>Successfully Cancelled!</div>";
    }
    elseif ($_GET['message'] == "failurecancel") {
        // Display failure message for cancellation
        $alert= "<div class='alert alert-danger' role='alert'>Cancellation failed. Please try again.</div>";
    }
}

try {
  
    $stmt = $db->prepare("SELECT b.*, g.* FROM bookings b JOIN grounds g ON b.Ground_id = g.Gid WHERE b.username = ?");
    $stmt->execute([$activeuser]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
   
    echo "Database error: " . $ex->getMessage();
    
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<section>
<?php echo $alert; ?>
<?php foreach ($bookings as $booking): ?>
    <div class="card m-5" style="max-width: 540px;">
        <div class="row g-0">
        <div class="col-md-4">
        <img src='Pic/<?php echo $booking['picture']; ?>' class="img-fluid rounded-start" alt="...">
    </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $booking['StadiumName']; ?></h5>
                    <h6>Location: <?php echo $booking['city']; ?></h6>
                    <h6>Date: <?php echo $booking['booking_date']; ?></h6>
                    <h6>Time: <?php echo $booking['booking_time']; ?></h6>
                    <button type="button" class="btn btn-danger cancel-btn"  data-booking-id="<?php echo $booking['Bid']; ?>">Cancel Booking</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</section>
<script>
    document.querySelectorAll('.cancel-btn').forEach(item => {
        item.addEventListener('click', event => {
            const bookingId = event.target.getAttribute('data-booking-id');
            if (confirm("Are you sure you want to cancel this booking?")) {
                // Send AJAX request to delete booking
                fetch('cancel_booking.php?id=' + bookingId, {
                    method: 'POST'
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the card from the page on successful deletion
                        event.target.closest('.card').remove();
                    } else {
                        console.error('Cancellation failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
</script>
<?php 
require('footer.php');
?> 
</body>
</html>
