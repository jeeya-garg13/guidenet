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
        <form class="edit-form" action="edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
            <div class="image-upload">
                <div class="image-preview empty">
                    <img src="" alt="">
                </div>
                <label for="profileImage" class="image-upload-label">
                    Choose Profile Picture
                </label>
                <input type="file" id="profileImage" name="profileImage" accept="image/*">
                <div class="image-controls">
                    <button type="button" class="cancel-button">Remove</button>
                </div>
            </div>

            <div class="form-section">
                <h2>Basic Information</h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="state">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="dob" id="dob" name="dob">
                </div>
            </div>

            <div class="form-section">
                <h2>Education</h2>
                <div class="form-group">
                    <label for="university">University</label>
                    <input type="text" id="university" value="Chhapra University">
                </div>
                <div class="form-group">
                    <label for="course">Course</label>
                    <input type="text" id="course" name="course">
                </div>
                <div class="form-group">
                    <label for="branch">Branch</label>
                    <input type="text" id="branch" name="branch">
                </div>
                <!--<div class="form-group">
                    <label for="period">Period</label>
                    <input type="text" id="period" name="">
                </div>-->
                <div class="form-group">
                    <label for="cgpa">CGPA</label>
                    <input type="text" id="cgpa" name="cgpa">
                </div>
            </div>

            <div class="form-section">
                <h2>Languages</h2>
                <div class="form-group">
                    <label for="language">Languages (comma-separated)</label>
                    <input type="text" id="language" name="language">
                </div>
            </div>

            <div class="form-section">
                <h2>High School Education</h2>
                <div id="internshipsContainer">
                    <div class="internship-entry">
                        <div class="form-group">
                            <label for="internship-title-0">Institution</label>
                            <input type="text" id="internship-title-0" name="10_school">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Percentage</label>
                            <input type="text" id="internship-company-0" name="10_Percentage">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Year of Passing</label>
                            <input type="text" id="internship-period-0" name="10_year">
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
                            <input type="text" id="internship-title-0" name="12_school">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Percentage</label>
                            <input type="text" id="internship-company-0" name="12_Percentage">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Year of Passing</label>
                            <input type="text" id="internship-period-0" name="12_year">
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
                            <input type="text" id="internship-title-0" name="internship-tittle-0">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Company</label>
                            <input type="text" id="internship-company-0" name="">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Period</label>
                            <input type="text" id="internship-period-0" name="">
                        </div>
                    </div>
                </div>
                <button type="button" class="add-button">Add Internship</button>
            </div>

            <div class="form-section">
                <h2>Placements</h2>
                <div id="internshipsContainer">
                    <div class="internship-entry">
                        <div class="form-group">
                            <label for="internship-title-0">Title</label>
                            <input type="text" id="internship-title-0" name="placement-tittle-0">
                        </div>
                        <div class="form-group">
                            <label for="internship-company-0">Company</label>
                            <input type="text" id="internship-company-0" name="">
                        </div>
                        <div class="form-group">
                            <label for="internship-period-0">Period</label>
                            <input type="text" id="internship-period-0" name="">
                        </div>
                    </div>
                </div>
                <button type="button" class="add-button">Add Placement</button>
            </div>

            <!-- ✅ Resume Upload Section -->
            <div class="form-section">
                <h2>Resume</h2>
                <label for="resume">Upload Resume (Image Format Only)</label>
                <input type="file" id="resume" name="resume" accept="image/*" required>
            </div>

            <div class="form-section">
                <h2>Extra Curricular</h2>
                <div class="form-group">
                    <label for="workshops">Extra Curricular Activities(comma-separated)</label>
                    <input type="text" id="workshops" name="extra__curricular">
                </div>
            </div>

            <div class="form-section">
                <h2>Certificates</h2>
                <div class="form-group">
                    <label for="certificates">Certificates (comma-separated)</label>
                    <input type="text" id="certificates" name="">
                </div>
            </div>

            <div class="form-section">
                <h2>Clubs</h2>
                <div class="form-group">
                    <label for="certificates">Clubs(comma-separated)</label>
                    <input type="text" id="certificates" name="clubs">
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
        $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
        $course = mysqli_real_escape_string($conn, $_POST["course"]);
        $branch = mysqli_real_escape_string($conn, $_POST["branch"]);
        $cgpa = mysqli_real_escape_string($conn, $_POST["cgpa"]);
        $language = mysqli_real_escape_string($conn, $_POST["language"]);
        $internship = mysqli_real_escape_string($conn, $_POST["internship-tittle-0"]);
        $placement= mysqli_real_escape_string($conn, $_POST["placement-tittle-0"]);
        $tenth_school= mysqli_real_escape_string($conn, $_POST["10_school"]);
        $tenth_percentage= mysqli_real_escape_string($conn, $_POST["10_percentage"]);
        $tenth_year= mysqli_real_escape_string($conn, $_POST["10_year"]);
        $twelfth_school= mysqli_real_escape_string($conn, $_POST["12_school"]);
        $twelfth_percentage= mysqli_real_escape_string($conn, $_POST["12_percentage"]);
        $twelfth_year= mysqli_real_escape_string($conn, $_POST["12_year"]);
        $extra_curricular= mysqli_real_escape_string($conn, $_POST["extra_curricular"]);
        $clubs= mysqli_real_escape_string($conn, $_POST["clubs"]);
        $imageData="";
        if (!empty($_FILES["profileImage"]["tmp_name"])) {
            $imageData = addslashes(file_get_contents($_FILES["profileImage"]["tmp_name"]));
            $updateQuery = "UPDATE stud_registration SET NAME='$name', STATE='$state', ABOUT='$about', DOB='$dob', COURSE='$course', BRANCH='$branch', CGPA='$cgpa', LANGUAGES='$language', INTERNSHIP='$internship',PLACEMENT='$placement', TWELFTH='$twelfth_school', 12_RESULT='$twelfth_percentage', 12_YEAR='$twelfth_year', TENTH='$tenth_school', 10_RESULT='$tenth_percentage', 10_YEAR='$tenth_year', EXTRA_CURRICULAR='$extra_curricular', CLUBS='$clubs', PROFILEPICTURE=LOAD_FILE('$imageData') WHERE ID='$id'";
        } else {
           $updateQuery = "UPDATE stud_registration SET NAME='$name', STATE='$state', ABOUT='$about', DOB='$dob', COURSE='$course', BRANCH='$branch', CGPA='$cgpa', LANGUAGES='$language', INTERNSHIP='$internship' PLACEMENT='$placement', TWELFTH='$twelfth_school', 12_RESULT='$twelfth_percentage', 12_YEAR='$twelfth_year', TENTH='$tenth_school', 10_RESULT='$tenth_percentage', 10_YEAR='$tenth_year', EXTRA_CURRICULAR='$extra_curricular', CLUBS='$clubs' WHERE ID='$id'";
        }
   if ($conn->query($updateQuery) === TRUE) {
       echo "<script>alert('Profile Updated Successfully!'); window.location.href='newprofile.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
    ?>
</body>
</html>