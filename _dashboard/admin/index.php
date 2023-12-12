<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

require '../../includes/config.php';



$studentCountQuery = "SELECT COUNT(*) FROM students";
$studentCountResult = mysqli_query($conn, $studentCountQuery);

$programCountQuery = "SELECT COUNT(*) FROM programs";
$programCountResult = mysqli_query($conn, $programCountQuery);

$courseCountQuery = "SELECT COUNT(*) FROM courses";
$courseCountResult = mysqli_query($conn, $courseCountQuery);

$teacherCountQuery = "SELECT COUNT(*) FROM teachers";
$teacherCountResult = mysqli_query($conn, $teacherCountQuery);

require_once('header.php');
?>
            <!-- Main -->
            <main class="main-container">   
                <div class="main-cardss">
                        <div class="card">
                            <div class="card-inner">
                                <h3>STUDENTS</h3>
                                <span class="material-symbols-outlined">groups</span>
                            </div>
                            <?php
                            if ($studentCountResult) {
                                $row = mysqli_fetch_assoc($studentCountResult);
                                $totalStudents = $row['COUNT(*)'];

                                echo "<h1>$totalStudents</h1>";
                            }
                            ?>
                        </div>
                        
                        <div class="card">
                            <div class="card-inner">
                                <h3>TEACHERS</h3>
                                <span class="material-symbols-outlined">group</span>
                            </div>
                            <?php
                            if ($teacherCountResult) {
                                $row = mysqli_fetch_assoc($teacherCountResult);
                                $totalTeachers = $row['COUNT(*)'];

                                echo "<h1>$totalTeachers</h1>";
                            }
                            ?>
                        </div>

                        <div class="card">
                            <div class="card-inner">
                                <h3>PROGRAMS</h3>
                                <span class="material-symbols-outlined">library_books</span>
                            </div>
                            <?php
                            if ($programCountResult) {
                                $row = mysqli_fetch_assoc($programCountResult);
                                $totalPrograms = $row['COUNT(*)'];

                                echo "<h1>$totalPrograms</h1>";
                            }
                            ?>
                        </div>

                        <div class="card">
                            <div class="card-inner">
                                <h3>COURSES</h3>
                                <span class="material-symbols-outlined">subject</span>
                            </div>
                            <?php
                            if ($courseCountResult) {
                                $row = mysqli_fetch_assoc($courseCountResult);
                                $totalCourses = $row['COUNT(*)'];

                                echo "<h1>$totalCourses</h1>";
                            }
                            ?>
                        </div>

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