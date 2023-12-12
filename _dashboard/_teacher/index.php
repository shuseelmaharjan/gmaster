<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

require '../../includes/config.php';

$user = $_SESSION['username'];

$sql = "SELECT course_id
        FROM teachercourse
        JOIN teachers
        JOIN users
        ON teachers.user_id = users.user_id
        WHERE username='$user'";

$courseRes = mysqli_query($conn, $sql);

while ($courseRow = $courseRes->fetch_assoc()) {
    $course_id = $courseRow['course_id'];
}

if(isset($_POST['submit'])) {

    $id = $_POST['id'];
    $theory = $_POST['theory'];
    $practical = $_POST['practical'];
    $marks = $theory + $practical;

    // Check for duplication
    $checkQuery = "SELECT * FROM grades WHERE course_id = '$course_id' AND student_id = '$id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if(mysqli_num_rows($checkResult) == 0) {
        $query = "INSERT INTO grades(course_id, student_id, marks) VALUES('$course_id', '$id', '$marks')";
        $res = mysqli_query($conn, $query);
    }

}

if(isset($_GET['criteria'])){
    $id = $_GET['criteria'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp">
    <link rel="stylesheet" href="./style.css">
    <!-- <link rel="stylesheet" href="./result.css"> -->
    <title>My Result</title>
    <link rel="icon" type="image/jpg" href="images/logo.jpg"/>
    <style>
        .whiteBox {
            background: var(--color-white);
            padding: var(--card-padding);
            box-shadow: 0 0 2rem 0 var(--color-light);
            transition: all 300ms ease;
        }

        main form input,
        main form select {
            border: 1px solid var(--color-dark-variant);
            padding: .8rem;
            background: var(--color-white);
            width: 10rem;
        }
        main form label {
            font-weight: 600;
        }
        main form button {
            padding: .8rem;
            background: var(--color-primary);
            width: 10rem;
            color: var(--color-white);
            cursor: pointer;
            font-size: larger;
        }
        main table th {
            text-align: left;
        }
        .terminal {
            width: 100%;
            text-align: center;
            background: var(--color-button);
            padding: 10px 0;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="images/logo.jpg">
                    <h2>grade<span class="success">master</span></h2>
                </div>
            </div>

            <div class="sidebar">
                <!-- <a href="index.php" >
                    <span class="material-icons-sharp">
                        grid_view
                    </span>
                    <h3>Dashboard</h3>
                </a> -->
                <!-- <a href="profile.php">
                    <span class="material-symbols-sharp">
                        account_circle
                    </span>
                    <h3>My Profile</h3>
                </a> -->
                <a href="index.php" class="active">
                    <span class="material-symbols-sharp">
                        group
                    </span>
                    <h3>My Students</h3>
                </a>
                <!-- <a href="result.php">
                    <span class="material-icons-sharp">
                        assignment
                    </span>
                    <h3>Result</h3>
                </a> -->
                <a href="../../logout.php" style="color: var(--color-danger);">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>

        </aside>
        <!-- End of Sidebar -->

        <!-- Main -->
    <div class="wrapper-box">
        <div class="wrapper">
            <div class="top">
                <div class="left">
                    <h1>Add Grade</h1>
                </div>
                <div class="profile">
                    <div class="info">
                        <div class="txt">
                            <p>Hey, <b>
                                <?php
                                    foreach(mysqli_query($conn,"SELECT *
                                                                FROM teachers
                                                                JOIN users
                                                                ON teachers.user_id = users.user_id
                                                                WHERE users.username = '$user'") as $key=> $row) {
                                        echo $row['teacher_name'];
                                    };
                                ?>
                            </b></p>
                            <small class="text-muted">Teacher</small>
                        </div>
                        <img src="images/profile-3.jpg">
                    </div>
                </div>
            </div>
            <main>
                <form method="post" class="whiteBox" style="display:flex; align-items:center; gap:.5rem;">
                    <label for="id">Student ID:</label>
                    <select name="id">
                        <?php
                        $sql = "SELECT * FROM students";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value= "<?= $row['student_id'] ?>"><?= $row['student_id'] ?> | <?= $row['student_name'] ?></option>
                        <?php
                        }}
                        ?>
                    </select>
                    <br>
                    <label for="theory">Theory:</label>
                    <input type="number" min="0" max="60" name="theory" required>
                    <br>
                    <label for="practical">Practical:</label>
                    <input type="number" min="0" max="40" name="practical" required>
                    <br>
                    <button type="submit" name="submit">Add</button>
                </form>
                <br>
                <div class="terminal">
                        <h2 style="color: var(--color-white);">Terminal Result</h2>
                </div>
                <table class="whiteBox" width="100%">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Marks</th>
                            <th>Grade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql = "SELECT * FROM grades
                                JOIN students ON students.student_id = grades.student_id
                                JOIN courses ON courses.course_id = grades.course_id
                                WHERE grades.course_id=(SELECT course_id
                                                        FROM teachers
                                                        JOIN users
                                                        ON teachers.user_id = users.user_id
                                                        WHERE users.username = '$user')";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            foreach($result as $key=>$row) {
                        ?>
                        <tr>
                            <td><?= ++$key; ?></td>
                            <td><?= $row['student_id'] ?></td>
                            <td><?= $row['student_name'] ?></td>
                            <td><?= $row['marks'] ?></td>
                            <td>
                                <?= grade($row['marks']) ?>
                            </td>
                            <td>
                                <a href="index.php?criteria=<?= $row['grade_id'] ?>" style="color: var(--color-primary); text-decoration: none;" onclick="return confirm('Do you want to update this item?');">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        <?php
                        }}
                        ?>
                    </tbody>
                </table>
            </main> 
            <div class="footer">
                <p>&copy; Copyright 2023 | All Right Reserved</p>
            </div> 
            <!-- End of Main -->

        </div>
    </div>
    </div>
</body>
</html>

<?php

?>