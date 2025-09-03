<?php
include __DIR__ ."../../../../../auth/dbcon.php";
if(!$conn) {
    die("Con faild");
}
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
if(!$email) {
    die("Enter Valid Email");
}
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
if($res->num_rows > 0) {
    //echo'valid login';
    $user = $res->fetch_assoc();
    if(password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        echo 'successful';
    } else {
        echo 'Incorrect password';
    }
}
else{
    echo 'No User';
}
$stmt->close();
$conn->close();
?>