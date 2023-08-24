<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once 'connect.php';
session_start();

$login = $_POST['login'] ?? null;
$pass = md5($_POST['pass']) ?? null;

$sql = $pdo->prepare("SELECT id, login FROM user WHERE login=:login AND pass=:pass");
$sql->execute(array('login' => $login, 'pass' => $pass));
$array = $sql->fetch(PDO::FETCH_ASSOC);

if ( $array["id"] > 0 ) {
    $_SESSION["login"] = $array["login"];
    header('Location: ../panel.php');
} else {
    header('Location: ../');
}

?>