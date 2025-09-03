<?php
include __DIR__ ."../../../../../auth/dbcon.php";
echo 'sent';
if(!$conn) {
    die("DB con failed");
}
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$username = trim($_POST['username'] ?? '');
$invCode = trim($_POST['invitationcode'] ?? '');
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Email already registered!";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

if (!$email || !$password || !$username || !$invCode) {
    echo "All fields are required.";
    exit;
}
if ($invCode !== 'ako') {
    echo "Invalid invitation code.";
    exit;
}$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
if (!$stmt) {
    echo 'statment err';
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
    
}
$stmt->bind_param("sss", $email, $hashed_password, $username);

if ($stmt->execute()) {
    echo "Registration success!";
} else {
    echo "Fail";
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>