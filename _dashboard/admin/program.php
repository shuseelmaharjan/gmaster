<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

require '../../includes/config.php';

    if (isset($_POST['add-program'])) {
        $program_name = $_POST['program_name'];

        if (!empty($program_name)) {
            $query = "SELECT * FROM programs WHERE program_name = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $program_name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        
            if (mysqli_stmt_num_rows($stmt) == 0) {
                $insert_query = "INSERT INTO programs (program_name) VALUES (?)";
                $stmt = mysqli_prepare($conn, $insert_query);
                mysqli_stmt_bind_param($stmt, "s", $program_name);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('Program added successfully.'); window.location.href='program.php';</script>";
            } else {
                echo "<script>alert('Program name already exists in the database.')</script>";
            }
        } else {
            echo "<script>alert('The program field is empty.')</script>";
        }   
    }

        $displayProgramQuery = "SELECT * FROM programs";
        $programDisplayResult = mysqli_query($conn, $displayProgramQuery);


        // Delete Program
        if(isset($_GET['deleteCriteria'])){
            $id = $_GET['deleteCriteria'];

            $sql = "DELETE FROM programs
                    WHERE program_id = $id";

            mysqli_query($conn, $sql);
            echo "<script>alert('Program deleted successfully.')</script>";
            header("Location: program.php");
        }

        // Pagination variables
        $resultsPerPage = 8; // Number of results per page
        $currentPage = 1; // Default page number

        // Check the page number in the URL
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $currentPage = $_GET['page'];
        }

        // Calculate the limit clause in the SQL query
        $offset = ($currentPage - 1) * $resultsPerPage;

        // Query to get programs for the current page
        $displayProgramQuery = "SELECT * FROM programs LIMIT $offset, $resultsPerPage";
        $programDisplayResult = mysqli_query($conn, $displayProgramQuery);

        // Get total number of programs
        $totalProgramsQuery = "SELECT COUNT(*) AS total FROM programs";
        $totalProgramsResult = mysqli_query($conn, $totalProgramsQuery);
        $totalPrograms = mysqli_fetch_assoc($totalProgramsResult)['total'];

        // Calculate total number of pages
        $totalPages = ceil($totalPrograms / $resultsPerPage);

    require_once('header.php');
?>     
            <!-- Main -->
            <main class="main-container">   
                <div class="program-form">
                    <form method="post">
                        <div class="input-group">
                            <label for="program_name" class="program_name">Program Name:</label>
                            <input type="text" name="program_name" required>
                        </div>
                        <div>
                            <button type="submit" name="add-program">Add</button>
                        </div>
                    </form>
                </div>
                <div class="program-table">
                    <table>
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Program Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($programDisplayResult->num_rows > 0) {
                                $counter = ($currentPage - 1) * $resultsPerPage + 1; // Adjust the counter for each page
                                foreach ($programDisplayResult as $row) {
                            ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $row['program_name'] ?></td>
                                        <td>
                                            <a href="./updateProgram.php?editCriteria=<?= $row['program_id'] ?>">Edit</a>
                                            <a href="program.php?deleteCriteria=<?= $row['program_id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                        </td>
                                    </tr>
                            <?php
                                    $counter++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No programs found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    // Display pagination links
                    for ($page = 1; $page <= $totalPages; $page++) {
                        $active = ($page == $currentPage) ? "active" : "";
                        echo '<a href="program.php?page=' . $page . '" class="' . $active . '">' . $page . '</a>';
                    }
                    ?>
                </div>
            </main>
            <!-- End of Main -->
            
            <div class="footer">
                &copy; Copyright 2023 | All Right Reserved
            </div>
        </div>
    </div>
</div>
<!-- Hidden edit form that will appear as a pop-up -->
<div id="editForm" style="display: none;">
    <form method="post">
        <input type="hidden" name="edit_id" value="<?= $id ?>">
        <div>
            <label for="edit_program_name" class="program_name">Edit Program Name:</label>
            <input type="text" name="edit_program_name" value="<?= $editProgramName ?>" required>
        </div>
        <div>
            <button type="submit" name="update-program">Update</button>
            <button type="button" onclick="closeEditForm()">Cancel</button>
        </div>
    </form>
</div>
<script>
    function openEditForm() {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function closeEditForm() {
        document.getElementById('editForm').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    // Attach click event to the "Edit" link
    var editLinks = document.querySelectorAll('.edit-link');
    editLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            openEditForm();
        });
    });
</script>
</body>
</html>