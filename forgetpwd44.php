<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Database Connection
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "guidenet"; 

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a variable to control form display
$show_verification_form = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['id']);

    // Check if student ID exists
    $query = "SELECT email FROM studentlogin WHERE id = '$student_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Generate verification code
        $verification_code = rand(100000, 999999);
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['id'] = $student_id;
        $show_verification_form = true;  // Show verification form

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = ''; // Change to your Gmail
            $mail->Password = '';  // Use App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('', 'GuideNet'); // edit Sender details with email and title
            $mail->addAddress($email);

            $mail->Subject = "Password Reset Verification Code";
            $mail->Body = "Your verification code is: " . $verification_code;

            $mail->send();
            $message = "Verification code sent to your email.";
        } catch (Exception $e) {
            $message = "Email could not be sent. Error: " . $mail->ErrorInfo;
        }
    } else {
        $message = "User not registered.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['code'])) {
    $entered_code = $_POST['code'];

    if ($entered_code == $_SESSION['verification_code']) {
        header("Location: chngpwd.php"); // Redirect to password reset page
        exit();
    } else {
        $message = "Wrong verification code entered.";
        $show_verification_form = true; // Show verification form again
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
    </div>
    <div class="full-page">
        <div class="form-box">
            <div class="welcome"><h1>Welcome To GuideNet</h1></div>
            <br>
            <div class="welcome"><h2>Change Password</h2></div>

            <!-- Display messages -->
            <?php if (isset($message)): ?>
                <br>
                <p style="color: yellow;"><?php echo $message; ?></p>
            <?php endif; ?>

            <!-- Show Student ID form if verification hasn't started -->
            <?php if (!$show_verification_form): ?>
                <form id='id-form' class='input-group-login' action="" method="POST">
                    <input type='text' class='input-field' placeholder='Student ID' name="id" required>
                    <button type='submit' class='submit-btn' id='get-code-btn'>Get Verification Code</button>
                </form>
            <?php endif; ?>

            <!-- Show Verification Code form only if the student ID has been submitted -->
            <?php if ($show_verification_form): ?>
                <form action="" method="POST">
                    <input type='text' class='input-field' placeholder='Verification Code' name="code" required>
                    <button type='submit' class='submit-btn'>Continue</button>
                </form>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>

