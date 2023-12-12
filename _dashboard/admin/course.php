<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

require '../../includes/config.php';
require_once('header.php');
?>
            <!-- Main -->
            <main class="main-container">   
                <div class="program-form">
                    <h2>Add Course</h2>
                    <form method="post">
                        <div class="input-group">
                            <label for="program_id">Program:</label>
                            <select name="program_id" id="">
                            <?php
                            if($programDisplayResult->num_rows > 0) {
                                foreach($programDisplayResult as $key=>$row) {
                                ?>
                                <option value="<?= $row['program_id'] ?>"><?= $row['program_name'] ?></option>
                                <?php
                                }
                            }
                            ?>
                            </select>
                        </div>
                        <div class>
                            <label for="semester_id">Semester:</label>
                            <select name="semester_id" id="">
                            <?php
                            if($semesterDisplayResult->num_rows > 0) {
                                foreach($semesterDisplayResult as $key=>$row) {
                                ?>
                                <option value="<?= $row['semester_id'] ?>"><?= $row['semester_name'] ?></option>
                                <?php
                                }
                            }
                            ?>
                            </select>
                        </div>
                        <div>
                            <label for="course_name">Course Name:</label>
                            <input type="text" name="course_name" required>
                        </div>
                        <div>
                            <label for="course_code">Course Code:</label>
                            <input type="text" name="course_code" required>
                        </div>
                        <div>
                            <label for="credit_hrs">Credit Hrs:</label>
                            <input type="number" name="credit_hrs" required>
                        </div>
                        <div>
                            <button type="submit" name="add-course">Add</button>
                        </div>
                    </form>
                </div>
                <div class="course-filter">
                    <form action="">
                        <select name="" id="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                        <button>Filter</button>
                    </form>
                </div>
                <!-- ... -->
<div class="course-table">
    <table>
        <thead>
            <tr>
                <th colspan="5">
                    <h2>Semester Name Here</h2><!-- You need to fetch the semester name -->
                </th>
            </tr>
            <tr>
                <th>S.N.</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Credit Hrs.</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courseDisplayResult->num_rows > 0) {
                foreach ($courseDisplayResult as $key => $row) {
            ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $row['course_code'] ?></td>
                        <td><?= $row['course_name'] ?></td>
                        <td><?= $row['credit_hrs'] ?></td>
                        <td>
                            <a href="course.php?editCriteria=<?= $row['course_id'] ?>" onclick="return confirm('Are you sure you want to edit this item?');">
                                Edit
                            </a>
                            <a href="course.php?deleteCriteria=<?= $row['course_id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                Delete
                            </a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                // Display a message if no courses are found
                echo '<tr><td colspan="5">No courses found.</td></tr>';
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