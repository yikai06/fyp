<?php
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO customer (cus_name, cus_username, cus_email, cus_password)
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["name"],
                  $_POST["username"],
                  $_POST["email"],
                  $_POST["password"]);

if ($stmt->execute()) { ?>
    <script>
        alert("Register successful");
    </script><?php
    header("Location: reg&login.php");
    exit;

} 