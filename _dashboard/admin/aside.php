<!-- Sidebar Section -->
<aside>
    <div class="toggle">
        <div class="logo">
            <img src="images/logo.jpg">
            <h2>grade<span class="success">master</span></h2>
        </div>
    </div>

    <div class="sidebar">
        <a href="index.php" class="<?= ($pageTitle === 'Dashboard') ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                grid_view
            </span>
            <h3>Dashboard</h3>
        </a>
        <a href="program.php" class="<?= ($pageTitle === 'Program') ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                library_books
            </span>
            <h3>Program</h3>
        </a>
        <a href="course.php" class="<?= ($pageTitle === 'Course') ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                subject
            </span>
            <h3>Course</h3>
        </a>

        <a href="student.php" class="<?= ($pageTitle === 'Student') ? 'active' : ''; ?>">
            <span class="material-symbols-sharp">
                groups
            </span>
            <h3>Student</h3>
        </a>
            <a href="teacher.php" class="<?= ($pageTitle === 'Teacher') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">
                    group
                </span>
                <h3>Teacher</h3>
            </a>
            <a href= "result.php" class="<?= ($pageTitle === 'Result') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">
                    assignment
                </span>
                <h3>Result</h3>
            </a>
            <a href="../../logout.php">
                <span class="material-icons-sharp">
                    logout
                </span>
                <h3>Logout</h3>
            </a>
        </div>

    </aside>
    <!-- End of Sidebar -->