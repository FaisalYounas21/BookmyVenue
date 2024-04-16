<?php require('connection.php'); 

$selectedCity = '';
if (isset($_GET['city'])) {
    $selectedCity = $_GET['city'];

 
    try {
        // Prepare and execute SQL query to fetch stadium data
        $stmt = $db->prepare("SELECT * FROM grounds WHERE city = ?");
        $stmt->execute([$selectedCity]);
        $stadiums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
       
        echo "Database error: " . $ex->getMessage();
       
        exit; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookmyVenue</title>
    
</head>
<body>
    <?php require('header.php'); ?> 

    <section>
       
        <div>
            <h2 class="text-center"><?php echo $selectedCity; ?></h2>
        </div>
        <?php if (!isset($_SESSION['activeUser'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Important:</strong> Please Login before booking the venue. Thank you.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

        <?php
        
        if (!empty($stadiums)) {
            // Loop through the stadiums and display them
            foreach ($stadiums as $stadium) {
                echo "<div class='card m-5 text-bg-light' style='max-width: 540px;'>";
                echo "<div class='row g-0'>";
                echo "<div class='col-md-4'>";
                echo "<img src='Pic/". $stadium['picture']."' class='img-fluid rounded-start' alt='Stadium Image'>";
                echo "</div>";
                echo "<div class='col-md-8'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $stadium['StadiumName'] . "</h5>";
                echo "<p class='card-text'>" . $stadium['Description'] . "</p>";
                echo "<p class='card-text'><small class='text-muted'>Price: " . $stadium['Price'] . " BHD</small></p>";
                // Add an id attribute to the button for easier targeting
                echo "<button class='btn btn-secondary book-btn' data-stadium-id='" . $stadium['Gid'] . "' data-bs-toggle='modal' data-bs-target='#exampleModal'>Book</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // When no record found
            echo "<p>No stadiums found for the selected city.</p>";
        }
        ?>
    </section>

    <?php require('footer.php'); ?> 

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select Date and Time</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <form method="post" action="booking_handler.php">
                        <input type="hidden" id="stadiumId" name="stadiumId">
                        <div class="mb-3">
                            <label for="bookingDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="bookingDate" name="bookingDate">
                        </div>
                        <div class="mb-3">
                            <label for="bookingTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="bookingTime" name="bookingTime" min="10:00" max="22:00">
                        </div>
                        <button type="submit" class="btn btn-primary">Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle the click event on the "Book" button
        document.querySelectorAll('.book-btn').forEach(item => {
            item.addEventListener('click', event => {
                const stadiumId = event.target.getAttribute('data-stadium-id');
                document.getElementById('stadiumId').value = stadiumId;
            });
        });

        // JavaScript to handle form submission and AJAX request
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            const formData = new FormData(this); // Get form data
            fetch('booking_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Handle response, e.g., show success message or handle errors
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
