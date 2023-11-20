<?php
session_start();

// Check if the user is already logged in and redirect if they are
if (isset($_SESSION['username'])) {
    header('location: index.php'); // Redirect to the index page
    exit();
}

include('server.php');

// Handle the login logic
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";

            // Redirect to the index page with a success message
            header('location: index.php');
            exit();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="login.css">

    <style>
        /* Add CSS styles for the success message */
        .success-message {
            background-color: rgb(5, 5, 68);
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            position: fixed;
            top: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form method="post" action="Login.php">
            <?php include('error.php'); ?>
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="remember-forgot">
                <!-- <label><input type="checkbox">Remember me</label> -->
            </div>
            <button type="submit" class="btn" name="login_user">Login</button>
            <!-- <div class="register-link">
                <p>Don't have an account? 
                    <a href="register.php">Register</a>
                </p>
            </div> -->
        </form>
    </div>
    <script src="https://kit.fontawesome.com/edbade1029.js" crossorigin="anonymous"></script>
    <script>
        // Function to get URL query parameters
        function getQueryParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if the 'registration' query parameter is set to 'success'
        const registrationSuccess = getQueryParameter('registration');

        if (registrationSuccess === 'success') {
            // Create a success message element
            const successMessage = document.createElement('div');
            successMessage.textContent = 'Your account has been registered successfully!';
            successMessage.classList.add('success-message'); // Apply CSS styles

            document.body.appendChild(successMessage);

            // Set a timer to fade away the message after 10 seconds
            setTimeout(function() {
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500); // Fading time
            }, 5000); // 5 seconds (5000 milliseconds)
        }
    </script>
</body>
</html>
