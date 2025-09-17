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
    $clubs = htmlspecialchars($user["CLUBS"]);
    $extra_curricular = htmlspecialchars($user["EXTRA_CURRICULAR"]);
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
    <title>Academics information</title>
    <link rel="stylesheet" href="style_academics.css">
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
            <!-- <img src=< ?= htmlspecialchars($user['PROFILEPICTURE']); ?> alt="User Profile Picture">-->
            <?php
            $profilePicPath = !empty($user['PROFILEPICTURE']) ? "uploads/profile_pics/" . htmlspecialchars($user['PROFILEPICTURE']) : "uploads/profile_pics/default-profile.jpg";
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">
                <!--<span class="status"></span>-->
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
                <!-- <img src=< ?= htmlspecialchars($user['PROFILEPICTURE']); ?> alt="Profile image" class="profileimg">-->
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

                    <div class="Academic">
                        <h2>Academics</h2>
                        <div class="academic-item">
                            <div class="academic">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                <span>Bachelors</span>
                            </div>
                            <p class="board"><?= htmlspecialchars($user['COURSE']); ?> in <?= htmlspecialchars($user['BRANCH']); ?></p>
                            <p class="school">Banasthali Vidyapith</p>
                            <p class="year">2022-2026</p>
                        </div>
                        
                        <div class="academic-item">
                            <div class="academic">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                                    <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                                    <path d="M2 2l7.586 7.586"></path>
                                    <circle cx="11" cy="11" r="2"></circle>
                                </svg>
                                <span>Class 12th</span>
                            </div>
                            <p class="school"><?= htmlspecialchars($user['TWELFTH']); ?></p>
                            <p class="year"><?= htmlspecialchars($user['12_YEAR']); ?></p>
                            <p class="board"><?= htmlspecialchars($user['12_RESULT']); ?></p>
                        </div>

                        <div class="academic-item">
                            <div class="academic">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                <span>Class 10th</span>
                            </div>
                            <p class="school"><?= htmlspecialchars($user['TENTH']); ?></p>
                            <p class="year"><?= htmlspecialchars($user['10_YEAR']); ?></p>
                            <p class="board"><?= htmlspecialchars($user['10_RESULT']); ?></p>
                        </div>
                    </div>


                    <div class="club">
                        <h2>Extra-Curricular</h2>
                        <div class="club-tags">
                        <?php
                        $extraArray = explode(",", $extra_curricular); 
                        foreach ($extraArray as $extra) {
                            echo '<span class="club-box">' . htmlspecialchars(trim($extra)) . '</span>';
                        }
                        ?>
                        </div>
                    </div>


                    <div class="club">
                        <h2>Clubs</h2>
                        <div class="club-tags">
                        <?php
                        $clubsArray = explode(",", $clubs); 
                        foreach ($clubsArray as $club) {
                            echo '<span class="club-box">' . htmlspecialchars(trim($club)) . '</span>';
                        }
                        ?>
                        </div>
                    </div>
<!--
                    <div class="club">
                        <h2>Resume</h2>
                        <img src=< ?= htmlspecialchars($user['RESUME']); ?> alt="Resume" class="profileimg">
                        </div>
                    </div>-->
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