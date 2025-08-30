<?php
include __DIR__ ."../../../auth/authenticator.php";
if ($_SERVER["REUEST_METHOD"] == "POST" && isset($_POST["submitbt"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"]);
    $email = $_POST["email"];
    echo"success";
    $stm = $conn->prepare("INSERT INTO users (usernmae, email, password) VALUES(?, ?, ?)");
    $stm ->bind_param("sss", $username,$email, $password);
    if ($stm -> execute()) {
        header("Location: index.html?succes=1");
    }
}
?>