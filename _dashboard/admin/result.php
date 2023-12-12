<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

require '../../includes/config.php';

if (isset($_POST['register-teacher'])) {

    // Retrieve form data
    $teacher_fname = $_POST['teacher_fname'];
    $teacher_lname = $_POST['teacher_lname'];

    // Handle file upload for profile image
    $targetDirectory = "../../uploads/";
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image
    if (getimagesize($_FILES["file"]["tmp_name"])) {
        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "<script>alert('Sorry, the file already exists.')</script>";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

                // Function to generate a unique username (you can implement your own logic)
                function generateUniqueUsername($fname, $lname) {
                    return strtolower($fname . $lname . rand(100, 999));
                }

                // Function to generate a random password (you can implement your own logic)
                function generateRandomPassword() {
                    return bin2hex(random_bytes(8)); // Generates an 8-character password
                }

                $username = generateUniqueUsername($teacher_fname, $teacher_lname);
                $password = generateRandomPassword();

                $roleRow = mysqli_query($conn, "SELECT role_id FROM roles WHERE role_name = 'teacher'");
                $roleData = $roleRow->fetch_assoc();
                $role_id = $roleData['role_id'];

                $insertUserSQL = "INSERT INTO users (username, pwd, role_id) VALUES ('$username', '$password', '$role_id')";
                mysqli_query($conn, $insertUserSQL);

                // Get the auto-generated user_id
                $user_id = mysqli_insert_id($conn);

                // Insert teacher information into the teachers table
                $insertTeacherSQL= "INSERT INTO teachers (user_id, first_name, last_name, profile_image) 
                                    VALUES ('$user_id', '$teacher_fname', '$teacher_lname', '$targetFile')";
                
                if (mysqli_query($conn, $insertTeacherSQL)) {
                    echo "<script>alert('Teacher registered successfully.')</script>";
                } else {
                    echo "Error registering the teacher: " . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        }
    } else {
        echo "<script>alert('File is not an image.')</script>";
    }
}

if (isset($_POST['assign-course'])) {

    // Retrieve form data
    $course_id = $_POST['to_be_assigned'];
    $teacher_id = $_POST['assign_to'];

    // Check if the course is already assigned to any teacher
    $checkExistingAssignmentSQL = "SELECT * FROM teachercourse WHERE course_id = $course_id";
    $existingResult = mysqli_query($conn, $checkExistingAssignmentSQL);

    if (mysqli_num_rows($existingResult) > 0) {
        while ($row = mysqli_fetch_assoc($existingResult)) {
            if ($row['teacher_id'] == $teacher_id) {
                echo "<script>alert('The course is already assigned to the selected teacher.');</script>";
            } else {
                echo "<script>alert('The course is already assigned to another teacher.');</script>";
            }
        }
    } else {
        // Insert the assignment into the course_teacher_assignment table
        $insertAssignmentSQL = "INSERT INTO teachercourse (course_id, teacher_id) 
                                VALUES ('$course_id', '$teacher_id')";
        if (mysqli_query($conn, $insertAssignmentSQL)) {
            echo "<script>alert('Course assigned successfully.');</script>";
        } else {
            echo "Error assigning the course: " . mysqli_error($conn);
        }
    }
}

$displaycourseQuery = "SELECT * FROM courses";
$courseDisplayResult = mysqli_query($conn, $displaycourseQuery);


$displayTeacherQuery = "SELECT * FROM teachercourse
                        JOIN teachers ON teachercourse.teacher_id = teachers.teacher_id
                        JOIN courses ON teachercourse.course_id = courses.course_id";
$TeacherDisplayResult = mysqli_query($conn, $displayTeacherQuery);

// Delete Program
if(isset($_GET['deleteCriteria'])){
    $teacher_id = $_GET['deleteCriteria'];

    // Fetch the profile image file path from the database
    $getImagePathSQL = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
    $result = mysqli_query($conn, $getImagePathSQL);
    $teacherRow = mysqli_fetch_assoc($result);

    // Delete the image file from the server
    if ($teacherRow && file_exists($teacherRow['profile_image'])) {
        unlink($teacherRow['profile_image']);
    }

    // Delete the teacher's record from the database
    $deleteTeacherSQL = "DELETE FROM teachers WHERE teacher_id = $teacher_id";
    mysqli_query($conn, $deleteTeacherSQL);

    // Delete the associated user record from the 'users' table
    $deleteUserSQL = "DELETE FROM users WHERE user_id = (SELECT user_id FROM teachers WHERE teacher_id = $teacher_id)";
    mysqli_query($conn, $deleteUserSQL);

    echo "<script>alert('Teacher and associated profile image deleted successfully.')</script>";
    header("Location: teacher.php");
}

// Edit Program
if(isset($_GET['editCriteria'])) {
    $id = $_GET['deleteCriteria'];

    // code
}
require_once('header.php');


?>
            <!-- Main -->
            <main class="main-container">   
                <div class="result-table">
                    <table>
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </main>
            <!-- End of Main -->
            
            <div class="footer">
                &copy; Copyright 2023 | All Right Reserved
            </div>
        </div>
    </div>
</div>
<script src="index.js"></script>
</body>
</html>