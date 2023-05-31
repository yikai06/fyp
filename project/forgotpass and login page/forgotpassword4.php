<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or any other page
    header("Location: dashboard.php");
    exit;
}

// Database connection
$host = "localhost";
$dbname = "car_rental";
$username = "root";
$password = "";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Reset password process
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $dbh->prepare("SELECT * FROM customer WHERE cus_email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a unique token and save it in the database
        $token = bin2hex(random_bytes(32));
        $stmt = $dbh->prepare("UPDATE tblusers SET reset_token = :token WHERE cus_email = :email");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Send password reset link to the user's email
        $resetLink = "http://your-website.com/reset_password.php?email=" . urlencode($email) . "&token=" . urlencode($token);
        // Replace "your-website.com" with your actual website domain

        // Send the email with the reset link (implement your email sending code here)
        // For example, you can use the PHPMailer library

        // Show a success message to the user
        echo "An email with the password reset link has been sent to your email address.";
    } else {
        // Email not found in the database
        echo "Email address not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>
    <form method="post" action="">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <input type="submit" value="Reset Password">
        </div>
    </form>
</body>
</html>
