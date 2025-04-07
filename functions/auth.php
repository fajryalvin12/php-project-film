<?php
function loginUser($conn, $username, $password) {
    $message = "";

    $username = strtolower(htmlspecialchars(trim($username)));

    if (empty($username) || empty($password)) {
        return "Silakan isi data pada form";
    }

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $message = "Username tidak terdaftar";
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            header("Location: ../index.php");
            exit;
        } else {
            $message = "Password Salah";
        }
    }

    $stmt->close();
    return $message;
}
function registerUser ($conn, $username, $password, $confirm) {
    $message = "";

    $username = strtolower(trim(htmlspecialchars($_POST["username"])));
    $password = $_POST["password"];
    $confirm = $_POST["password2"];

    if (empty($username) || empty($password) || empty($confirm)) {
        $message = "Semua field harus diisi";
    } else if ($password !== $confirm) {
        $message = "sesuaikan password terlebih dahulu";
    } else {
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt_check = $conn->prepare($sql);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows() > 0) {
        $message = "Username sudah terdaftar";
    } else {
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO user (username, password) VALUES(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_pass);

        if ($stmt->execute()) {
            $message = "Registrasi berhasil";
        } else {
            $message = "Error" . $stmt->error;
        }
        $stmt->close();
    }
    $stmt_check->close();            
    }
    return $message;
}
?>
