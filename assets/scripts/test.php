<?php
include __DIR__ ."../../../../../auth/dbcon.php";
if(!$conn){
    echo 'no good';
    exit();
}
echo 'good';
?>