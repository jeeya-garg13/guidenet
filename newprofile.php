<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "guidenet";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
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
    if (!empty($user['SKILLS'])) {
        $skills = htmlspecialchars($user["SKILLS"]);
    } else {
        $skills = '';
    }
    $internship = htmlspecialchars($user["INTERNSHIP"]);
    $placement = htmlspecialchars($user["PLACEMENT"]);
    $profile_picture = htmlspecialchars($user['PROFILEPICTURE']);
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
    <title>GuideNet User Profile</title>
    <link rel="stylesheet" href="style_profile.css">
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
            <!--LEFT SECTION-->
            <div class="profile">
                <!--
                <img src=< ?= htmlspecialchars($user['PROFILEPICTURE']); ?> alt="Profile image" class="profileimg"> 
                <img src="< ?= !empty($user['PROFILEPICTURE']) ? htmlspecialchars($user['PROFILEPICTURE']) : 'profile_pics/default-profile.jpg'; ?>" alt="Profile Picture" class="profileimg"> -->

                <?php
            $profilePicPath = !empty($user['PROFILEPICTURE']) ? "uploads/profile_pics/" . htmlspecialchars($user['PROFILEPICTURE']) : "uploads/profile_pics/default-profile.jpg";
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">

                <div class="profilename"><?= htmlspecialchars($user['NAME']); ?></div>
                <div class="profiletitle">
                    <i class="material-icons">school</i> A student of Banasthali Vidyapith</div>
                    
                <a href="edit-profile.php">
                <button><i class="material-icons">edit</i> Edit Profile</button></a>
                
            </div>
            <!--RIGHT SECTION-->
            <div class="profilecontentsection">
                <section class="card">
                    <h3>About</h3>
                    <p><?= htmlspecialchars($user['ABOUT']); ?></p>
                </section>

                <section class="card">
                    <h3>Current Education</h3>
                    <div class="education-item">
                        <div class="education-details">
                            <h4>Banasthali University</h4>
                            <p><?= htmlspecialchars($user['COURSE']); ?> <?= htmlspecialchars($user['BRANCH']); ?></p>
                            <p>CGPA: <?= $user['CGPA']; ?></p>
                        </div>
                    </div>
                </section>
                <!-- Skills Section -->
                <section class="card">
                    <h3>Skills</h3>
                        <div class="skill-tags">
                        <?php
                        $skillArray = explode(",", $skills); 
                        foreach ($skillArray as $skill) {
                            echo '<span class="club-box">' . htmlspecialchars(trim($skill)) . '</span>';
                        }
                        ?>
                        </div>
                </section>

                <!-- Experience Section -->
                <section class="card">
                    <h3>Experience</h3>
                    <div class="experience-item">
                        <div class="skill-tags">
                        <?php
                        if (!empty($internship)) {
                            $iArray = explode(",", $internship); 
                            foreach ($iArray as $i) {
                                echo '<span class="club-box">' . htmlspecialchars(trim($i)) . '</span>';
                            }
                        }
                        
                        if (!empty($placement)) {
                            $pArray = explode(",", $placement); 
                            foreach ($pArray as $p) {
                                echo '<span class="club-box">' . htmlspecialchars(trim($p)) . '</span>';
                            }
                        }
                        ?>
                        </div>
                    </div>
                </section>

            </div>
        </div> 
    </div>

    <script src="script_search.js"></script>
</body>
</html>