<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

require '../../includes/config.php';


if (isset($_POST['register-student'])) {

    // Retrieve form data
    $student_fname = $_POST['student_fname'];
    $student_lname = $_POST['student_lname'];
    $program_id = $_POST['program'];
    $enroll_date = $_POST['batch'];
    $batch_year = substr($_POST['batch'], 0, 4); // Extracting the year part from the batch date

    // Check for data duplication in the program_batch table
    $checkDuplicateSQL = "SELECT program_batch_id FROM program_batch WHERE program_id = '$program_id'";
    $result = mysqli_query($conn, $checkDuplicateSQL);

    if ($result && mysqli_num_rows($result) > 0) {
        // The combination already exists, so just retrieve the batch_id
        $row = mysqli_fetch_assoc($result);
        $program_batch_id = $row['batch_id'];
    } else {
        // The combination does not exist, so insert it into the batches table
        $insertBatchSQL = "INSERT INTO batches (batch_name) VALUES ('$batch_year')";
        mysqli_query($conn, $insertBatchSQL);

        // Get the auto-generated batch_id
        $batch_id = mysqli_insert_id($conn);
    }

    // Insert student information into the students table, linking it to the batch_id
    $insertStudentSQL = "INSERT INTO students (first_name, last_name, batch_id) VALUES ('$student_fname', '$student_lname', $batch_id)";
    mysqli_query($conn, $insertStudentSQL);

    // Redirect or display a success message as needed
}

$displayProgramQuery = "SELECT * FROM programs";
$programDisplayResult = mysqli_query($conn, $displayProgramQuery);


$displayStudentQuery = "SELECT * FROM students
                        JOIN program_batch ON students.program_batch_id = program_batch.program_batch_id
                        JOIN programs ON programs.program_id = program_batch.program_id
                        JOIN batches ON batches.batch_id = program_batch.batch_id;";
$studentDisplayResult = mysqli_query($conn, $displayStudentQuery);

// Delete Program
if(isset($_GET['deleteCriteria'])){
    $id = $_GET['deleteCriteria'];

    $sql = "DELETE FROM students
            WHERE student_id = $id";

    mysqli_query($conn, $sql);
    echo "<script>alert('Student deleted successfully.')</script>";
    header("Location: student.php");
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
                <div class="student-form">
                    <h2>Student Registration</h2>
                    <form method="post">
                        <div>
                            <label for="student_fname">First Name:</label>
                            <input type="text" name="student_fname" required>
                        </div>
                        <div>
                            <label for="student_lname">Last Name:</label>
                            <input type="text" name="student_lname" required>
                        </div>
                        <div>
                            <label for="program">Program:</label>
                            <select name="program" id="">
                                <?php
                                if($programDisplayResult->num_rows > 0) {
                                    foreach($programDisplayResult as $key=>$row){
                                    ?>
                                    <option value="<?= $row['program_id'] ?>"><?= $row['program_name'] ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="batch">Batch:</label>
                            <input type="date" name="batch" min="2020-" required>
                        </div>
                        <div>
                            <button type="submit" name="register-student">Register</button>
                        </div>
                    </form>
                </div>
                <div class="student-table">
                    <h2>Student Table</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Student Name</th>
                                <th>Program Name</th>
                                <th>Batch</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($studentDisplayResult->num_rows > 0) {
                                foreach($studentDisplayResult as $key=>$row){
                                ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $row['first_name'] . $row['last_name'] ?></td>
                                    <td><?= $row['program_name'] ?></td>
                                    <td><?= $row['batch_name'] ?></td>
                                    <td>
                                        <a href="student.php?editCriteria=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                                        <a href="student.php?deleteCriteria=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            ?>
                        </tbody>
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