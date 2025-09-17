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
if (!isset($_SESSION['id'])) {
    die("Error: No user session found. Please log in again.");
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
    $name = htmlspecialchars($user["NAME"]);
    $state = htmlspecialchars($user["STATE"]);
    $about = htmlspecialchars($user["ABOUT"]);
    $advice = htmlspecialchars($user["ADVICE"]);
    $dob = htmlspecialchars($user["DOB"]);
    $course = htmlspecialchars($user["COURSE"]);
    $branch = htmlspecialchars($user["BRANCH"]);
    $cgpa = htmlspecialchars($user["CGPA"]);
    $language = htmlspecialchars($user["LANGUAGES"]);
    $internship = htmlspecialchars($user["INTERNSHIP"]);
    $intern_comp = htmlspecialchars($user["INTERN_COMP"]);
    $intern_period = htmlspecialchars($user["INTERN_PERIOD"]);
    $placement = htmlspecialchars($user["PLACEMENT"]);
    $place_comp = htmlspecialchars($user["PLACE_COMP"]);
    $place_period = htmlspecialchars($user["PLACE_PERIOD"]);
    $tenth = htmlspecialchars($user["TENTH"]);
    $year10 = htmlspecialchars($user["10_YEAR"]);
    $result10 = htmlspecialchars($user["10_RESULT"]);
    $twelfth = htmlspecialchars($user["TWELFTH"]);
    $year12 = htmlspecialchars($user["12_YEAR"]);
    $result12 = htmlspecialchars($user["12_RESULT"]);
    $extra_curricular = htmlspecialchars($user["EXTRA_CURRICULAR"]);
    $clubs = htmlspecialchars($user["CLUBS"]);
    $certificates = htmlspecialchars($user["CERTIFICATES"]);
    $skills = htmlspecialchars($user["SKILLS"]);
    $hobby = htmlspecialchars($user["HOBBY"]);

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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style_edit.css">
</head>
<body>
    
    <div class="edit-container">
        <h1>Edit Profile</h1>
        <form class="edit-form" action="edit-profile.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
            <div class="image-upload">
                <div class="image-preview empty">
                    <img src="" alt="">
                </div>
                <label for="profilePicture" class="image-upload-label">
                    Choose Profile Picture
                </label>
                <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
                <div class="image-controls">
                    <button type="button" class="cancel-button">Remove</button>
                </div>
            </div>

            <div class="form-section">
                <h2>Basic Information</h2>
                <div class="form-group">
                    <label for="name">Name <span style="color: red;">*</span> </label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">City/State</label>
                    <input type="text" id="location" name="state" value="<?php echo $state; ?>">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" rows="4"><?php echo $about; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="about">Advice</label>
                    <textarea name="advice" id="advice" rows="4"><?php echo $advice; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth <span style="color: red;">*</span></label>
                    <input type="date" id="dob" name="dob" min="1990-01-01" max="2008-12-31" value="<?php echo $dob; ?>">
                </div>
            </div>

            <div class="form-section">
                <h2>Education</h2>
                <div class="form-group">
                    <label for="course">Course</label>
                    <input type="text" id="course" name="course" value="<?php echo $course; ?>">
                </div>
                <div class="form-group">
                    <label for="branch">Branch</label>
                    <input type="text" id="branch" name="branch" value="<?php echo $branch; ?>">
                </div>
                <div class="form-group">
                    <label for="cgpa">CGPA</label>
                    <input type="decimal" id="cgpa" name="cgpa" value="<?php echo $cgpa; ?>">
                </div>
            </div>

            <div class="form-section">
                <h2>Language</h2>
                <div class="form-group">
                    <label for="language">Language (comma-separated)</label>
                    <input type="text" id="language" name="language" value="<?php echo $language; ?>">
                </div>
            </div>

            <div class="form-section">
                <h2>High School Education</h2>
                <div id="internshipsContainer">
                    <div class="internship-entry">
                        <div class="form-group">
                            <label for="internship-title-0">Institution</label>
                            <input type="text" id="internship-title-0" name="10_school" value="<?php echo $tenth; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Percentage</label>
                            <input type="text" id="internship-company-0" name="10_Percentage" value="<?php echo $result10; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Year of Passing</label>
                            <input type="text" id="internship-period-0" name="10_year" value="<?php echo $year10; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Intermediate Education</h2>
                <div id="internshipsContainer">
                    <div class="internship-entry">
                        <div class="form-group">
                            <label for="internship-title-0">Institution</label>
                            <input type="text" id="internship-title-0" name="12_school" value="<?php echo $twelfth; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Percentage</label>
                            <input type="text" id="internship-company-0" name="12_Percentage" value="<?php echo $result12; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Year of Passing</label>
                            <input type="text" id="internship-period-0" name="12_year" value="<?php echo $year12; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Internships</h2>
                <div id="internshipsContainer">
                    <div class="internship-entry">
                        <div class="form-group">
                            <label for="internship-title-0">Title</label>
                            <input type="text" id="internship-title-0" name="internship-tittle-0" value="<?php echo $internship; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Company</label>
                            <input type="text" id="internship-company-0" name="internship-company-0" value="<?php echo $intern_comp; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Period</label>
                            <input type="text" id="internship-period-0" name="internship-period-0" value="<?php echo $intern_period; ?>">
                        </div>
                    </div>
                </div>
                <!-- <button type="button" class="add-button">Add Internship</button> -->
            </div>

            <div class="form-section">
                <h2>Placements</h2>
                <div id="internshipsContainer">
                    <div class="internship-entry">
                        <div class="form-group">
                            <label for="internship-title-0">Title</label>
                            <input type="text" id="placement-title-0" name="placement-tittle-0" value="<?php echo $placement; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Company</label>
                            <input type="text" id="placement-company-0" name="placement-company-0" value="<?php echo $place_comp; ?>">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Period</label>
                            <input type="text" id="placement-period-0" name="placement-period-0" value="<?php echo $place_period; ?>">
                        </div>
                    </div>
                </div>
                <!-- <button type="button" class="add-button">Add Placement</button> -->
            </div>

            <div class="form-section">
                <h2>Hobbies</h2>
                <div class="form-group">
                    <label for="hobby">Hobbies (comma-separated)</label>
                    <input type="text" id="hobby" name="hobby" value="<?php echo $hobby; ?>">
                </div>
            </div>

            <div class="form-section">
                <h2>Extra Curricular</h2>
                <div class="form-group">
                    <label for="extra_curricular">Extra Curricular Activities (comma-separated)</label>
                    <input type="text" id="extra_curricular" name="extra_curricular" value="<?php echo $extra_curricular; ?>">
                </div>
            </div>

            <div class="form-section">
                <h2>Skills</h2>
                <div class="form-group">
                    <label for="skills">Skills (comma-separated)</label>
                    <input type="text" id="skills" name="skills" value="<?php echo $skills; ?>" >
                </div>
            </div>

            <div class="form-section">
                <h2>Certificates</h2>
                <div class="form-group">
                    <label for="certificates">Certificates (comma-separated)</label>
                    <input type="text" id="certificates" name="certificates" value="<?php echo $certificates; ?>" >
                </div>
            </div>

            <div class="form-section">
                <h2>Clubs</h2>
                <div class="form-group">
                    <label for="certificates">Clubs (comma-separated)</label>
                    <input type="text" id="certificates" name="clubs" value="<?php echo $clubs; ?>">
                </div>
            </div>

            <div class="form-actions">
                <a href="newprofile.php">
                <button type="button" class="cancel-button">Cancel</button>
                <button type="submit" class="save-button">Save Changes</button></a>
            </div>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $_SESSION["id"];
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $state = mysqli_real_escape_string($conn, $_POST["state"]);
        $about = mysqli_real_escape_string($conn, $_POST["about"]);
        $advice = mysqli_real_escape_string($conn, $_POST["advice"]);
        $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
        $course = mysqli_real_escape_string($conn, $_POST["course"]);
        $branch = mysqli_real_escape_string($conn, $_POST["branch"]);
        $cgpa = mysqli_real_escape_string($conn, $_POST["cgpa"]);
        $language = mysqli_real_escape_string($conn, $_POST["language"]);
        $skills = mysqli_real_escape_string($conn, $_POST["skills"]);
        $internship = mysqli_real_escape_string($conn, $_POST["internship-tittle-0"]);
        $intern_comp = mysqli_real_escape_string($conn, $_POST["internship-company-0"]);
        $intern_period = mysqli_real_escape_string($conn, $_POST["internship-period-0"]);
        $place_comp = mysqli_real_escape_string($conn, $_POST["placement-company-0"]);
        $place_period = mysqli_real_escape_string($conn, $_POST["placement-period-0"]);
        $placement= mysqli_real_escape_string($conn, $_POST["placement-tittle-0"]);
        $tenth_school = mysqli_real_escape_string($conn, $_POST["10_school"]);
        $tenth_percentage= mysqli_real_escape_string($conn, $_POST["10_Percentage"]);
        $tenth_year= mysqli_real_escape_string($conn, $_POST["10_year"]);
        $twelfth_school= mysqli_real_escape_string($conn, $_POST["12_school"]);
        $twelfth_percentage= mysqli_real_escape_string($conn, $_POST["12_Percentage"]);
        $twelfth_year= mysqli_real_escape_string($conn, $_POST["12_year"]);
        $extra_curricular= mysqli_real_escape_string($conn, $_POST["extra_curricular"]);
        $hobby = mysqli_real_escape_string($conn, $_POST["hobby"]);
        #$hobby = isset($_POST['hobby']) && $_POST['hobby'] !== '' ? $_POST['hobby'] : NULL;
        $certificates= mysqli_real_escape_string($conn, $_POST["certificates"]);
        $clubs= mysqli_real_escape_string($conn, $_POST["clubs"]);
        $imageData="";

        $upload_dir = "uploads/profile_pics/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

        if ($_FILES["profilePicture"]["error"] == 0) {
            $file_tmp = $_FILES["profilePicture"]["tmp_name"];
            $file_ext = pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION);
            $newFileName = "user_" . $id . "." . $file_ext; // Unique filename based on ID
            $upload_path = $upload_dir . $newFileName;

    // Delete old profile picture if it exists
            if (!empty($oldProfilePicture) && file_exists($upload_dir . $oldProfilePicture)) {
                unlink($upload_dir . $oldProfilePicture);
            }

    // Move new profile picture to the upload directory
            if (move_uploaded_file($file_tmp, $upload_path)) {
        // Update the database with the new profile picture filename
                $update_query = "UPDATE stud_registration SET PROFILEPICTURE = ? WHERE ID = ?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("ss", $newFileName, $id);
                $stmt->execute();

                $uploadPath = $upload_dir . basename($_FILES['profilePicture']['name']);
                //if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
                    //die("Failed to save uploaded file.");
                //}

            echo "Profile picture updated successfully!";
            } else {
                echo "Error uploading the profile picture.";
            }
        }
        $updateQuery = "UPDATE stud_registration SET NAME='$name', STATE='$state', ABOUT='$about', ADVICE='$advice', DOB='$dob',COURSE='$course', BRANCH='$branch', CGPA = '$cgpa',LANGUAGES='$language', INTERNSHIP='$internship', INTERN_COMP ='$intern_comp', INTERN_PERIOD='$intern_period', PLACEMENT='$placement', PLACE_COMP='$place_comp', PLACE_PERIOD='$place_period',  TWELFTH='$twelfth_school', 12_RESULT='$twelfth_percentage', 12_YEAR='$twelfth_year', TENTH='$tenth_school', 10_RESULT='$tenth_percentage', 10_YEAR='$tenth_year', EXTRA_CURRICULAR='$extra_curricular', SKILLS='$skills', HOBBY='$hobby', CERTIFICATES='$certificates', CLUBS='$clubs' WHERE ID='$id'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>alert('Profile Updated Successfully!'); window.location.href='newprofile.php';</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

// Update database with the new profile picture filename
        #$updateQuery = "UPDATE stud_registration SET NAME='$name', STATE='$state', ABOUT='$about', ADVICE='$advice', DOB='$dob',COURSE='$course', BRANCH='$branch', CGPA = '$cgpa',LANGUAGES='$language', INTERNSHIP='$internship', INTERN_COMP ='$intern_comp', INTERN_PERIOD='$intern_period', PLACEMENT='$placement', PLACE_COMP='$place_comp', PLACE_PERIOD='$place_period',  TWELFTH='$twelfth_school', 12_RESULT='$twelfth_percentage', 12_YEAR='$twelfth_year', TENTH='$tenth_school', 10_RESULT='$tenth_percentage', 10_YEAR='$tenth_year', EXTRA_CURRICULAR='$extra_curricular', SKILLS='$skills', HOBBY='$hobby', CERTIFICATES='$certificates', CLUBS='$clubs' WHERE ID='$id'";

       # if ($conn->query($updateQuery) === TRUE) {
        #   echo "<script>alert('Profile Updated Successfully!'); window.location.href='newprofile.php';</script>";
       # } else {
       #     echo "Error updating record: " . $conn->error;
       # }
    


    $conn->close();
    ?>

</body>
</html>
<!--
, PROFILEPICTURE='$newProfilePicture'

RESUME='$resume',
-->