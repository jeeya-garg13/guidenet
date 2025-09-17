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

// Check if name is passed via URL
if (isset($_GET['clicked_name'])) {
    $_SESSION['name'] = $_GET['clicked_name'];  // Store clicked name in session
}
$name = $_SESSION['name'];

// Fetch user details
$query = "SELECT * FROM stud_registration WHERE NAME = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (!empty($user['LANGUAGES'])) {
        $languages = htmlspecialchars($user["LANGUAGES"]);
    } else {
        $languages = '';
    }
    if (!empty($user['HOBBY'])) {
        $hobbies = htmlspecialchars($user["HOBBY"]);
    } else {
        $hobbies = '';
    }
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
    <title>Personal information</title>
    <link rel="stylesheet" href="style_personal.css">
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
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">                <!--<span class="status"></span>-->
            <div class="user-info">
                <h2><?= htmlspecialchars($user['NAME']); ?></h2>
                <p>Active</p>
            </div>
        </div>
        <a href="newdashboard.php"><b><h3>Home (Return)</h3></b></a>
        <a href="searchedprofile.php">Profile</a>
            <ul class="dropdown">
                <li><a href="searchedpersonal.php">Personal</a></li>
                <li><a href="searchedacademics.php">Academics</a></li>
                <li><a href="searchedadditional.php">Additional</a></li>
            </ul>
    </div>
    <div class="dashboard-container">
        <div class="profile-layout">
            <!-- Left Section -->
            <div class="profile">
            <?php
            $profilePicPath = !empty($user['PROFILEPICTURE']) ? "uploads/profile_pics/" . htmlspecialchars($user['PROFILEPICTURE']) : "uploads/profile_pics/default-profile.jpg";
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">                <div class="profilename"><?= htmlspecialchars($user['NAME']); ?></div>
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

                    <div class="advice">
                        <h2>Advice</h2>
                        <p><?= htmlspecialchars($user['ADVICE']); ?> 
                        </p>
                    </div>
                    <div class="DOB">
                        <h2>Date of Birth</h2>
                        <p class="date"><?= htmlspecialchars($user['DOB']); ?></p>
                    </div>
                    <div class="language">
                        <h2>Languages</h2>
                        <div class="languages-tags">
                        <?php
                        $langArray = explode(",", $languages); 
                        foreach ($langArray as $lang) {
                            echo '<span class="club-box">' . htmlspecialchars(trim($lang)) . '</span>';
                        }
                        ?>
                        </div>
                    </div>

                    <div class="language">
                        <h2>Hobbies</h2>
                        <div class="languages-tags">
                        <?php
                        $hArray = explode(",", $hobbies); 
                        foreach ($hArray as $h) {
                            echo '<span class="club-box">' . htmlspecialchars(trim($h)) . '</span>';
                        }
                        ?>
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