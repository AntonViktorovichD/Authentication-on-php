<form method="GET">
    <input name="num1">
    <input name="num2">
    <input type="submit">
<?php
session_start();
if (!empty($_GET)) {
    $_SESSION['nums'] = $_GET;
}
?>