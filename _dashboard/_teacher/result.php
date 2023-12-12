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
                <a href="index.php" >
                    <span class="material-icons-sharp">
                        grid_view
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="profile.php">
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
                <a href="result.php" class="active">
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

        <!-- Main -->
    <div class="wrapper-box">
        <div class="wrapper">
            <div class="top">
                <div class="left">
                    <h1>Grade Sheet</h1>
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
            <div class="filter">
                <form action="">
                    <span>Select Semester :</span>
                    <select>
                    <option value="1">Option1</option>
                        <option value="2">Option2</option>
                        <option value="3">Option3</option>
                        <option value="4">Option4</option>
                        <option value="5">Option5</option>
                    </select>
                    <span>Terminal :</span>
                    <select name="" id="">
                        <option value="1">Option1</option>
                        <option value="2">Option2</option>
                        <option value="3">Option3</option>
                        <option value="4">Option4</option>
                        <option value="5">Option5</option>
                    </select>
                    <input type="button" name="filter" value="Search">
                </form>
            </div>
            <!-- End of Right Section -->
            <main>

                <div class="list">
                    <div class="terminal">
                        <p>First Terminal Examination 2080</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="num">S.No.</th>
                                <th>Subject</th>
                                <th class="num">Theory Grade</th>
                                <th class="num">Practical Grade</th>
                                <th class="num">Final  Grade</th>
                                <th class="num"> Grade Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="num">1</td>
                                <td>Numerical Method</td>
                                <td class="num">85</td>
                                <td class="num">90</td>
                                <td class="num">88.5</td>
                                <td class="num">88.5</td>
                            </tr>
                            <tr>
                                <td class="num">2</td>
                                <td>Software Engineering</td>
                                <td class="num">92</td>
                                <td class="num">88</td>
                                <td class="num">90</td>
                                <td class="num">88.5</td>
                            </tr>
                            <tr>
                                <td class="num">3</td>
                                <td>Database Management System</td>
                                <td class="num">78</td>
                                <td class="num">85</td>
                                <td class="num">81.5</td>
                                <td class="num">88.5</td>
                            </tr>
                            <tr>
                                <td class="num">4</td>
                                <td>Operating System</td>
                                <td class="num">78</td>
                                <td class="num">85</td>
                                <td class="num">81.5</td>
                                <td class="num">88.5</td>
                            </tr>
                            <tr>
                                <td class="num">5</td>
                                <td>Scripting Language </td>
                                <td class="num">78</td>
                                <td class="num">85</td>
                                <td class="num">81.5</td>
                                <td class="num">88.5</td>
                            </tr>
                            <tr>
                                <td colspan="4" id="gpa">Grade Point Average (GPA) :</td>
                                <td class="num">A</td>
                                <td class="num">3.11</td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
                 
            </main> 
            <div class="footer">
                <p>&copy; Copyright 2023 | All Right Reserved</p>
            </div> 


            <!-- End of Main -->

          
        </div>

</div>
    </div>

    <script src="index.js"></script>
</body>
</html>