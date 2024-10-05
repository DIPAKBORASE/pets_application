<?php
include_once 'C:\\xampp\\htdocs\\pets_application\\ltservcon.php';
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errorMsg = "Please enter both email and password.";
    } else {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $userdata->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                header("Location: index.php");
                
                exit();

            } else {

                $errorMsg = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login - PetsCare</title>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login to Your Account</h2>
            <p>Access your account to manage your pets and notifications.</p>

            <?php if (!empty($errorMsg)): ?>
                <div class="error-message">
                    <p><?php echo $errorMsg; ?></p>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="" method="post" class="login-form">
                <div class="form-row">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-row">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>

            <p class="signup-link">Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>
</body>

</html>