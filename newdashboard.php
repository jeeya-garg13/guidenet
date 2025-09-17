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
} else {
    echo "User details not found!";
    exit();
}

// Fetch total number of users excluding the logged-in user
$countQuery = "SELECT COUNT(*) as total FROM stud_registration WHERE ID != ?";
$stmtCount = $conn->prepare($countQuery);
$stmtCount->bind_param("s", $id);
$stmtCount->execute();
$countResult = $stmtCount->get_result();
$totalRecords = ($countResult->num_rows > 0) ? $countResult->fetch_assoc()['total'] : 0;

// Set number of records per page
$recordsPerPage = 6;  
$totalPages = ($totalRecords > 0) ? ceil($totalRecords / $recordsPerPage) : 1;

// Get current page from URL (default to 1)
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);  // Ensure page is at least 1

$offset = ($page - 1) * $recordsPerPage;

// Fetch users for the current page
$userQuery = "SELECT * FROM stud_registration WHERE ID != ? LIMIT ?, ?";
$stmtUsers = $conn->prepare($userQuery);
$stmtUsers->bind_param("sii", $id, $offset, $recordsPerPage);
$stmtUsers->execute();
$userResult = $stmtUsers->get_result();

$users = [];
while ($row = $userResult->fetch_assoc()) {
    $users[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style_dashboard.css">
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
        <div class="faceCard">
<!--        <img src=< ?= htmlspecialchars($user['PROFILEPICTURE']); ?> alt="Profile image" class="profileimg">-->
        <?php
            $profilePicPath = !empty($user['PROFILEPICTURE']) ? "uploads/profile_pics/" . htmlspecialchars($user['PROFILEPICTURE']) : "uploads/profile_pics/default-profile.jpg";
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="profileimg">

            <div class="user-info">
                <h2><?= htmlspecialchars($user['NAME']); ?></h2>
                <p>Active</p>
            </div>
        </div>
        
        <a href="newprofile.php">Profile</a>
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
        <!-- Main Content -->
        <div class="main-content">
            <div class="dashboard-header">
                <h1>Welcome to Your Dashboard</h1>
                <p class="page-indicator">Page <span id="current-page"></span> of <span id="total-pages"></span></p>
            </div>

            <div id="face-card-container" class="facecards-container">
            <!-- Facecards will be loaded dynamically with JavaScript -->
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination-container">
            <!-- Pagination will be generated with JavaScript -->
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1; ?>">Previous</a>
            <?php endif; ?>

            <span>Page <?= $page; ?> of <?= $totalPages; ?></span>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1; ?>">Next</a>
            <?php endif; ?>
            
        </div>
    </div>

    <script src="script_dashboard.js"></script>
    <script src="script_search.js"></script>

</body>
</html>
