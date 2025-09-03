<?php
$host = 'localhost';
$username = 'testdb_pos';
$pass = 'pos';
$database = 'testdb';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $conn = new mysqli($host, $username, $pass, $database);
    $conn->set_charset('utf8mb4');
}
catch(mysqli_sql_exception $e){
    echo ''. $e->getMessage() .'';
    exit();
}
?>