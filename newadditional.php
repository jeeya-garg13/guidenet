<?php //include 'user_details.php'; ?>
<?php
session_start();

// Database Connection
$host = "localhost";
$username = "root";
$password = "";
$database = "guidenet";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*
// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}*/
if (isset($_SESSION['id'])) {
    echo json_encode(["id" => $_SESSION['id']]);
} else {
    echo json_encode(["id" => null]);
}
$id = $_SESSION['id'];

// Fetch user details
$query = "SELECT * FROM stud_registration WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $certificates = htmlspecialchars($user["CERTIFICATES"]);

} else {
    echo "User details not found!";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Information</title>
    <link rel="stylesheet" href="style_additional.css">
    <link rel="stylesheet" href="search.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <div class="task-bar">
            <img src="logo.png" alt="GuideNet Logo">
            <h1>GuideNet</h1>
    </div>
    
    <div class="nav-bar">
        <div class="face-card">
        <?php
            $profilePicPath = !empty($user['PROFILEPICTURE']) ? "uploads/profile_pics/" . htmlspecialchars($user['PROFILEPICTURE']) : "uploads/profile_pics/default-profile.jpg";
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">
            <div class="user-info">
                <h2><?= htmlspecialchars($user['NAME']); ?></h2>
                <p>Active</p>
            </div>
        </div>
        <a href="newdashboard.php">Home</a>
        <a href="newprofile.php">Profile</a>
            <ul class="dropdown">
                <li><a href="newpersonal.php">Personal</a></li>
                <li><a href="newacademics.php">Academics</a></li>
                <li><a href="newadditional.php">Additional</a></li>
            </ul>
        <a href="message.php">Message</a>

        <a href="#" onclick="openModal('search.php')" id="searchButton">Search</a>
        <!-- Modal Container -->
        <div id="overlay">
            <div class="modal">
                <span class="close-btn" onclick="closeModal()">×</span>
                <iframe id="modalFrame" src=""></iframe>
            </div>
        </div>  
        <a href="logout.php">Logout</a>
    </div>
    <div class="dashboard-container">
        <div class="profile-layout">
            <!-- Left Section 
            <div class="profile-image-section">
                <div class="profile-image">
                    <img src=< ?= htmlspecialchars($user['PROFILEPICTURE']); ?> alt="Profile">
                </div>
            </div>-->

            <!--LEFT SECTION-->
            <div class="profile">
            <?php
            $profilePicPath = !empty($user['PROFILEPICTURE']) ? "uploads/profile_pics/" . htmlspecialchars($user['PROFILEPICTURE']) : "uploads/profile_pics/default-profile.jpg";
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">
                <div class="profilename"><?= htmlspecialchars($user['NAME']); ?></div>
                <div class="profiletitle">
                    <i class="material-icons">school</i> A student of Banasthali Vidyapith</div>
                
            </div>

            <!-- Right Section -->
            <div class="profile-content-section">
                <div class="profile-details">
                    <div class="header">
                        <h1><?= htmlspecialchars($user['NAME']); ?></h1>
                        <p class="title">Pursuing <?= htmlspecialchars($user['COURSE']); ?> in <?= htmlspecialchars($user['BRANCH']); ?></p>
                        <p class="location">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <?= htmlspecialchars($user['STATE']); ?>
                        </p>
                    </div>

                    <div class="Projects">
                        <h2>Internships</h2>
                        <div class="button-tags">
                            <span><?= htmlspecialchars($user['INTERNSHIP']); ?></span>
                        </div>
                    
                    </div>
                    <div class="button">
                        <h2>Certificates</h2>
                        <div class="button-tags">

                            <?php
                            if (!empty($certificates)) {
                            $iArray = explode(",", $certificates); 
                            foreach ($iArray as $i) {
                                echo '<span class="club-box">' . htmlspecialchars(trim($i)) . '</span>';
                            }
                            }?>
                        </div>
                    </div>
                    <br><br>

                    <div class="contact">
                        <a href="#" class="contact-button">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <?= htmlspecialchars($user['CONTACT']); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script_search.js"></script>

</body>
</html>