<?php
include __DIR__ . "/../../../auth/authenticator.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submitbt"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $rawPassword = $_POST["password"];

    // Validate inputs
    if (empty($username) || empty($email) || empty($rawPassword)) {
        header("Location: register.html?error=empty_fields");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.html?error=invalid_email");
        exit;
    }

    // Check for duplicates
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        header("Location: register.html?error=user_exists");
        exit;
    }

    $password = password_hash($rawPassword, PASSWORD_DEFAULT);

    $stm = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stm->bind_param("sss", $username, $email, $password);

    if ($stm->execute()) {
        header("Location: ../index.html?success=1");
        exit;
    } else {
        error_log("DB Error: " . $stm->error);
        header("Location: register.html?error=db_error");
        exit;
    }
}
?>
