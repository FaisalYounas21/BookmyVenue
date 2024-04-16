<?php 
session_start();
require ('session.php')?>
<?php

require('connection.php'); 
$alertMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $stadiumId = $_POST['stadiumId'];
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = date("h:i A", strtotime($_POST['bookingTime']));
    try {
        // Prepare and execute SQL query to insert booking details into the database
        $stmt = $db->prepare("INSERT INTO bookings (Ground_id, booking_date, booking_time,username) VALUES (?, ?, ?,?)");
        $stmt->execute([$stadiumId, $bookingDate, $bookingTime,$_SESSION['activeUser']]);
        
        // Checks if the booking was successfully inserted
        if ($stmt->rowCount() > 0) {
            header("Location: reservation.php?message=success");
        } else {
        
            header("Location: reservation.php?message=failure");
        }

        echo $alertMessage;
    } catch (PDOException $ex) {
       
        echo "Database error: " . $ex->getMessage();
    }
} else {
   
    echo "Form submission error.";
}
?>
