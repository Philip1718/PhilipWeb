<?php
// Make sure you have proper error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$id = $_POST['id'];
$tel = $_POST['tel'];
$price = $_POST['price'];
$deposit = $_POST['deposit'];
$bayArea = $_POST['bayArea'];
$layBayDate = $_POST['layBayDate'];
$expireDates = $_POST['expireDates'];

// Validate and sanitize user input
// Add proper validation and sanitation for user inputs here

// Check if any of the required fields are empty before proceeding with the database operation
if (empty($firstName) || empty($lastName) || empty($id) || empty($tel) || empty($price) || empty($deposit) || empty($bayArea) || empty($layBayDate) || empty($expireDates)) {
    die("Please fill in all the required fields.");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Use placeholders in the SQL statement and bind parameters
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, id, tel, price, deposit, bayArea, layBayDate, expireDates) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt) {
        $stmt->bind_param("ssssdisss", $firstName, $lastName, $id, $tel, $price, $deposit, $bayArea, $layBayDate, $expireDates);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Registration Successful.";
        } else {
            echo "Registration Failed.";
        }

        $stmt->close();

        // Add the JavaScript for the redirect here
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "http://localhost/HHLayB/src/make.html";
            }, 3000); // Redirect after 3 seconds
        </script>
        <?php
    } else {
        echo "Error in SQL statement preparation: " . $conn->error;
    }

    $conn->close();
}
?>
