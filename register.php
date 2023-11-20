<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="wrapper">
        <form method="post" action="register.php">
            <?php include('error.php'); ?>
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                <i class="fa-regular fa-envelope"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password_1" placeholder="Password" required>
                <i class="fa-solid fa-unlock"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password_2" placeholder="Confirm Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <?php if (count($errors) > 0): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="sign-In-Link">
                <p>Already have an account? <a href="Login.php">Sign in</a></p>
            </div>

            <button type="submit" class="btn" name="reg_user">Register</button>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/edbade1029.js" crossorigin="anonymous"></script>
</body>
</html>
