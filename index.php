<?php

session_start();

if (isset($_POST['submit'])) {

    include "./includes/config.php";

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $query = "SELECT u.user_id, u.email, r.name AS role
    FROM users u
    INNER JOIN roles r ON u.role_id = r.role_id
    WHERE u.email = '$email' 
      AND u.password = '$password'";
    
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role_name = $row['role'];
        $_SESSION['username'] = $email;

        if($role_name == 'admin') {
            header('location: _dashboard/admin/index.php');
        } else if ($role_name == 'teacher') {
            header('location: _dashboard/_teacher/index.php');
        }
    } else {
        header("Location: index.php?error=Incorrect Email or Password");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .popup-login{
            z-index: 999;
            position: fixed;
            background: #363949;
            opacity: 0.9;
            width: 100%;
            height: 100vh;
            /* display: none; */
            transition: 0.5s ease;

            display: grid;
            place-items: center;
        }

        .popup-login .popup{
            width: 30%;
            /* margin-left: 34%; */
            /* height: 380px; */
            background: #dadeea;
            /* border-radius: 25px; */
            /* margin-top: 15vh; */
            padding: 30px;
            display: block;
        }

        .error {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #ffcbcb;
            /* color: #0c0101; */
            padding: 10px;
            width: 95%;
            /* border-radius: 15px; */
            /* margin: 20px auto; */
            /* display: none; */
        }

        .popup-login .popup form {
            display: flex;
            flex-direction: column;
            gap: .6rem;
            margin-top: 1rem;
        }

        .popup-login .popup form input {
            padding: .8rem;
            border: none;
            /* border-radius: 25px; */
            margin-bottom: 1rem;
        }

        .popup-login .popup form button {
            padding: .8rem;
            border: none;
            /* border-radius: 25px; */
            margin: 1rem 0;
            background: rgb(71, 124, 238);
            color: white;
        }
    </style>
</head>
<body>

    <div class="popup-login" id="popup-login">
        <div class="popup">
            <h1>Log in</h1>
            <?php if (isset($_GET['error'])) { ?>
            <p class="error" id="error">
                <span class="material-symbols-sharp">
                    error
                </span>
                <?php echo $_GET['error']; ?>
            </p>
            <?php } ?>
            <form action="#" method="post">
                <label for="username">Email </label>
                <input type="text" placeholder="Email" name="email">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password">
                <button name="submit">Log in</button>
            </form>
        </div>
    </div>
    
    <script>

        function hideContent() {
            var contentDiv = document.getElementById('error');
            contentDiv.style.display = 'none';
        }
        setTimeout(hideContent, 3000);

    </script>
</body>
</html>