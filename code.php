<form action="" method="POST">
    <input name="login">
    <input name="password" type="password">
    <input type="submit">
</form>

<?php

$host = 'localhost'; // имя хоста
$user = 'root';      // имя пользователя
$pass = '';          // пароль
$port = 3308;
$name = 'mydb';      // имя базы данных

$link = mysqli_connect($host, $user, $pass, $name, $port);


session_start();

if (!empty($_POST['password']) and !empty($_POST['login'])) {
//    $login = $_POST['login'];
//    $password = md5($_POST['password']); // преобразуем пароль в его хеш
//
//    $query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
//    $result = mysqli_query($link, $query);
//    $user = mysqli_fetch_assoc($result);

    $login = $_POST['login'];

    $query = "SELECT * FROM users WHERE login='$login'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {
        $salt = $user['salt']; // соль из БД
        $hash = $user['password']; // соленый пароль из БД

        $password = md5($salt, $_POST['password']); // соленый пароль от юзера

        // Сравниваем соленые хеши
        if ($password == $hash) {
            session_start();
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            header('Location: page1.php');
        } else {
             echo 'пароль не подошел, выведем сообщение';
        }
    } else {
         echo 'пользователя с таким логином нет, выведем сообщение';
    }

    if (!empty($user)) {

    } else {
        echo "Access denied";
    }
}


