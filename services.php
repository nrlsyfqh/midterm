<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection file
require_once 'db.php';

// Fetch all services from the database
$stmt = $pdo->query("SELECT * FROM tbl_services");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Page - Blossom Women's Care</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .service-card {
            background-color: #ffe6e6; /* Light pink background color */
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .service-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service-card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .service-card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .service-card-description {
            color: #666;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .service-card-price {
            font-weight: bold;
            color: #ee6969;
            margin-top: 10px;
        }

        .service-card-button {
            text-align: center;
            margin-top: 20px;
        }

        .service-card-button button {
            background-color: #de9190; /* Pastel pink for View Details button */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .service-card-button button:hover {
            background-color: #d34646; /* Darker shade for hover */
        }

        .w3-teal {
            background-color: #de9190 !important; /* New teal color */
            color: white !important; /* Text color for teal background */
        }

        .clinic-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 3rem; /* Adjust size as needed */
            font-weight: 700;
            margin: 0;
        }
    </style>
</head>
<body>

<header class="w3-container w3-center w3-teal w3-padding-32">
<h1 class="clinic-title">Blossom Women's Care</h1>
<p>Welcome to Your One Stop Health Solution</p>
</header>

<div class="w3-bar w3-teal">
    <a href="index.html" class="w3-bar-item w3-button">Home</a>
    <a href="services.php" class="w3-bar-item w3-button">Services</a>
    <a href="logout.php" class="w3-bar-item w3-button" style="float:right">Logout</a>
</div>

<div class="w3-container w3-padding-64">
    <h2 class="w3-black-teal w3-center">OUR SERVICE</h2>

    <div class="w3-row-padding">
        <?php foreach ($services as $service): ?>
        <div class="w3-col l4 m6 w3-margin-bottom">
            <div class="w3-card service-card">
                <img src="assets/images/service_<?php echo $service['service_id']; ?>.png" alt="<?php echo htmlspecialchars($service['service_name']); ?> Image">
                <div class="service-card-content">
                    <h3 class="service-card-title"><?php echo htmlspecialchars($service['service_name']); ?></h3>
                    <p class="service-card-description"><?php echo htmlspecialchars($service['brief_description']); ?></p>
                    <p class="service-card-price">RM<?php echo number_format($service['service_price'], 2); ?></p>
                    <div class="service-card-button">
                        <button onclick="showServiceDetails('<?php echo $service['service_name']; ?>', '<?php echo htmlspecialchars(addslashes($service['detailed_description'])); ?>', <?php echo $service['service_price']; ?>)">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal for Service Details -->
    <div id="serviceDetailsModal" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4">
            <header class="w3-container w3-teal">
                <span onclick="document.getElementById('serviceDetailsModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h2 id="modalServiceName"></h2>
            </header>
            <div class="w3-container">
                <p id="modalServiceDescription"></p>
                <p id="modalServicePrice"></p>
            </div>
            <div class="w3-container w3-padding">
                <button onclick="bookService()" class="w3-button w3-white w3-border w3-border-red w3-round-large w3-hover-pale-red" style="float: right;">Book Appointment</button>
            </div>
        </div>
    </div>

</div>

<footer class="w3-container w3-center w3-teal w3-padding-16">
    <p>&copy; 2024 Blossom Women's Care. All rights reserved.</p>
</footer>

<script>
    function showServiceDetails(serviceName, serviceDescription, servicePrice) {
        document.getElementById('modalServiceName').textContent = serviceName;
        document.getElementById('modalServiceDescription').textContent = serviceDescription;
        document.getElementById('modalServicePrice').textContent = 'Price: RM' + servicePrice.toFixed(2);
        document.getElementById('serviceDetailsModal').style.display = 'block';
    }

    function bookService() {
        var serviceName = document.getElementById('modalServiceName').textContent;
        // Implement booking logic here
        alert('Booking ' + serviceName);
        // Optionally, close modal after booking
        document.getElementById('serviceDetailsModal').style.display = 'none';
    }
</script>

</body>
</html>
