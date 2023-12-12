<?php

session_start();

if (isset($_SESSION['username'])) {

$user = $_SESSION['username'];

require '../../includes/config.php';

$sql = "SELECT * FROM users
        JOIN teachers
        ON teachers.user_id = users.user_id
        WHERE username = 'wifi@mailinator.com'";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp">
    <link rel="stylesheet" href="./style.css">
    <title>My Profile</title>
    <link rel="icon" type="image/jpg" href="images/logo.jpg"/>
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

            <!--Start of aside-->
            <div class="sidebar">
                <a href="index.php">
                    <span class="material-icons-sharp">
                        grid_view
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="profile.php" class="active">
                    <span class="material-symbols-sharp">
                        account_circle
                    </span>
                    <h3>My Profile</h3>
                </a>
                <a href="add-result.php">
                    <span class="material-symbols-sharp">
                        group
                    </span>
                    <h3>My Students</h3>
                </a>
                <a href="result.php">
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
    <div class="wrapper-box">
        <div class="wrapper">
            <div class="top">
                <div class="left">
                    <h1>My Profile</h1>
                </div>
                <div class="profile">
                    <div class="info">
                        <div class="txt">
                            <p>Hey, <b>John</b></p>
                            <small class="text-muted">Teacher</small>
                        </div>
                        <img src="images/profile-3.jpg">
                    </div>
                </div>
            </div>
            <!-- Main -->
            <main> 
                <?php
                if($result) {
                    foreach ($result as $key => $row) {
                ?>
                <div class="profile-discription">
                    <div class="profile-picture">
                        <?php
                        if($row['profile_image'] == NULL){
                        ?>
                            <img src="./images/default.png" alt="Photo">
                        <?php } else { ?>
                            <img src="<?= $row['profile_image'] ?>" alt="Photo">
                        <?php } ?>
                    </div>
                    <div class="profile-detail">
                        <div class="row">
                            <h4>Name</h4>
                            <h3><?= $row['teacher_name'] ?></h3>
                        </div>
                        <div class="row">
                            <h4>Email</h4>
                            <h3><?= $row['username'] ?></h3>
                        </div>
                        <div class="row">
                            <h4>Gender</h4>
                            <h3><?= $row['gender'] ?></h3>
                        </div>
                        <div class="row">
                            <h4>Phone</h4>
                            <h3><?= $row['phone'] ?></h3>
                        </div>
                        <div class="row">
                            <h4>Address</h4>
                            <h3><?= $row['address'] ?></h3>
                        </div>
                    </div>
                    <?php }} ?>
                    <a href="profile_update.php" class="btn">
                        <button>Edit Profile</button>
                        <!-- <button>Edit Profile</button> -->
                    </a>
                </div>

            </main>
            <!-- End of Main -->
            <div class="footer">
                <p>&copy; Copyright 2023 | All Right Reserved</p>
            </div> 
        </div>
    </div>
</div>

    <script src="index.js"></script>
</body>
</html>

<?php
}
?>