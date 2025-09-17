<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "guidenet";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_SESSION['id'];
//$id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 3;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;
// Debugging: Log received values
error_log("Received: page=$page, limit=$limit, offset=$offset, id=$id");
// Check if the values are correct
if ($limit <= 0 || $page <= 0) {
    die(json_encode(["error" => "Invalid pagination parameters"]));
}

$sql = "SELECT NAME, PROFILEPICTURE, BRANCH, STATE, ABOUT FROM stud_registration WHERE ID != ? ORDER BY ID LIMIT ? OFFSET ?";
//LIMIT $limit OFFSET $offset
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

//error_log("SQL Query: $sql"); // Debugging: Log query
//$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Debugging: Log how many users were fetched
error_log("Users Fetched: " . count($users));
echo json_encode($users);


$stmt->close();

/*
// Fetch face card details
$sql = "SELECT ID, NAME, BRANCH, STATE, PROFILEPICTURE, ABOUT FROM stud_registration WHERE ID != ?";
//$result = $conn->query($sql);

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$faceCards = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faceCards[] = [
            "id" => $row["ID"],
            "NAME" => $row["NAME"],
            "BRANCH" => $row["BRANCH"],
            "STATE" => $row["STATE"],
            "PROFILEPICTURE" => $row["PROFILEPICTURE"],
            "ABOUT" => $row["ABOUT"]
        ];
    }
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($faceCards);
*/



$conn->close();
?>


