<?php
include_once 'C:\\xampp\\htdocs\\pets_application\\ltservcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :password)";
        $stmt = $userdata->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Registration failed! Please try again.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Sign Up - PetsCare</title>
</head>

<body>
    <div class="signup-container">
        <div class="signup-box">
            <h2>Create Your Account</h2>
            <p>Sign up to manage your pets and receive updates.</p>

            <!-- Google Sign-Up Button (Google OAuth integration needed) -->
            <div class="google-signup">
                <button class="google-btn">
                    <i class="fab fa-google"></i> Sign up with Google
                </button>
            </div>

            <div class="divider">
                <span>or</span>
            </div>

            <!-- Sign-Up Form -->
            <form action="" method="post" class="signup-form">
                <div class="form-row">
                    <input type="text" id="first-name" name="first-name" required>
                    <label for="first-name">First Name</label>
                </div>
                <div class="form-row">
                    <input type="text" id="last-name" name="last-name" required>
                    <label for="last-name">Last Name</label>
                </div>
                <div class="form-row">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-row">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="signup-btn">Sign Up</button>
            </form>

            <p class="login-link">Already have an account? <a href="login.php">Log in</a></p>
        </div>
    </div>
</body>

</html>