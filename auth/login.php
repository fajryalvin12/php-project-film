<?php

    require '../config/db.php';
    require '../functions/auth.php';

    $message = "";

    if(isset($_POST["login"])) {
        $message = loginUser($conn, $_POST["username"], $_POST["password"]);
    }
    mysqli_close($conn)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        label {
            display: block;
        }
        p {
            color: red;
            font-weight: bold;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if (!empty($message)) : ?>
       <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <button type="submit" name="login">Login!</button>
            </li>
        </ul>
    </form>
</body>
</html>