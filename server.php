<?php
// session_start();

// Initializing variables
$username = "";
$email = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'test');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // Receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Form Validation: Ensure that the form is correctly filled...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Passwords do not match");
    }

    // Check the database to make sure a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // Register the user if there are no errors in the form
    if (count($errors) == 0) {
        // Hash the password before saving it in the database
        $password = password_hash($password_1, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now registered and logged in";

        // Redirect to login.php with a success message
        header('location: Login.php?registration=success');
        exit(); // Important to prevent further script execution
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    // Handle login logic
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
            // Password is correct
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";

            // Redirect to the index with a success message
            header('location: index.php'); // or header('location: HomePage.html');
            exit(); // Important to prevent further script execution
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
