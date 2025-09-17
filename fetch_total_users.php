<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "guidenet";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$sql = "SELECT COUNT(*) as total FROM stud_registration WHERE ID != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode(["totalUsers" => $row["total"]]);

$conn->close();
?>
