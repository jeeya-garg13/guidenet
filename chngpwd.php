<?php
session_start();

// Database Connection
$host = "localhost"; // Change if using a remote DB
$user = "root"; // Your DB username
$password = ""; // Your DB password
$database = "guidenet"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user has completed verification
if (!isset($_SESSION['id'])) {
    echo "Unauthorized access!";
    exit();
}
$student_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate that both passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='chngpwd.php';</script>";
        exit();
    }

    // Hash the new password for security
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $query = "UPDATE studentlogin SET password='$hashed_password' WHERE id='$student_id'";
    if ($conn->query($query) === TRUE) {
        // Destroy session and redirect to login
        session_destroy();
        echo "<script>alert('Password changed successfully!'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome To GuideNet</title>
    <link rel="stylesheet" href="style_sign-log.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="logo.png" width="50px" height="50px"> GuideNet
            </a>
        </div>
        <!--<div class="icons"></div>-->
    </div>
    <div class="full-page">
        <div class="form-box">
            <div class="welcome"><h1>Welcome To GuideNet</h1></div>
            <br><div class="welcome"><h2>Change Password</h2></div>
    <form id='login' class='input-group-login' action="" method="POST">
        <input type='password'class='input-field' placeholder='New Password' name="password" required >
        <input type='password'class='input-field' placeholder='Confirm New Password' name="confirm_password" required >
        <button type='submit'class='submit-btn' id='login-btn'>Save</button>
    </form>
        </div>
    </div>
</body>
</html>