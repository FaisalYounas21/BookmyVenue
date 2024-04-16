<?php
require('connection.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $bookingId = $_GET['id'];

    try {
        // Prepare and execute SQL query to delete the booking record
        $stmt = $db->prepare("DELETE FROM bookings WHERE Bid = ?");
        $stmt->execute([$bookingId]);

        // Checks if the deletion was successful
        if ($stmt->rowCount() > 0) {
            header("Location: reservation.php?message=successcancel");
        
        } else {
            header("Location: reservation.php?message=failurecancel");
          
        }
    } catch (PDOException $ex) {
      
        http_response_code(500);
        echo "Database error: " . $ex->getMessage();
    }
} else {
    
    http_response_code(400);
    echo "Invalid request method.";
}
?>
