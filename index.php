<?php
session_start(); // Start the session

// Logout logic
if (isset($_GET['logout'])) {
    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();
    }
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>HH.LayB</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="wrapper">
                <nav>
                    <ul>
                        <li><img src="image/a8e5ecdcec54441b9ab0d33727971cfb.png" id="homelogo"></li>
                        <li><a href="Make.html">Make LayBay</a></li>
                        <li><a href="LayBay.php">LayBays</a></li>

                        <!-- logged in user information -->
                        <?php if (isset($_SESSION['username'])) : ?>
                            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                            <p><a href="index.php?logout=1" style="color: lightblue;font-size: 18px;">Logout</a></p>
                        <?php else : ?>
                            <li><a href="login.php">Login</a></li> <!-- Add a "Login" link for non-logged-in users -->
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>
