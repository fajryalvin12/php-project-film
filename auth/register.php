<?php
    require '../config/db.php';
    require '../functions/auth.php';

    if (isset($_POST["register"])) {
        $message = registerUser($conn, $_POST["username"], $_POST["password"], $_POST["password2"]);
    }
    mysqli_close($conn)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
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
    <h1>Registrasi User</h1>

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
                <label for="password2">Confirm Password</label>
                <input type="password" id="password2" name="password2">
            </li>
            <li>
                <button type="submit" name="register">Register!</button>
            </li>
        </ul>
    </form>
</body>
</html>