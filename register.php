<form action="" method="POST">
    <input name="login">
    <input type="password" name="password">
    <input type="password" name="confirm">
    <input type="submit">
</form>

<?php

$host = 'localhost'; // имя хоста
$user = 'root';      // имя пользователя
$pass = '';          // пароль
$port = 3308;
$name = 'mydb';      // имя базы данных

$link = mysqli_connect($host, $user, $pass, $name, $port);


//	if (!empty($_POST['login']) and !empty($_POST['password'])) {
//		$login = $_POST['login'];
//		$password = $_POST['password'];

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login='$login'";
    $user = mysqli_fetch_assoc(mysqli_query($link, $query));

    if (empty($user)) {
        $login = $_POST['login'];
        $salt = generateSalt();
        $password = md5($salt . $_POST['password']);

        $query = "INSERT INTO users SET login='$login', password='$password'";
        mysqli_query($link, $query);

        $_SESSION['auth'] = true;

    } else {
       echo 'логин занят, выведем сообщение об этом';
    }
}

	if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirm'])) {
		if ($_POST['password'] == $_POST['confirm']) {
			$login = $_POST['login'];
		$password = $_POST['password'];
		} else {
			echo 'Denied';
		}

		$query = "INSERT INTO users SET login='$login', password='$password'";
		mysqli_query($link, $query);

		session_start();
		$_SESSION['auth'] = true; // пометка об авторизации
        $id = mysqli_insert_id($link);
        $_SESSION['id'] = $id;
	}

function generateSalt()
{
    $salt = '';
    $saltLength = 8; // длина соли

    for($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33, 126)); // символ из ASCII-table
    }

    return $salt;
}
?>
