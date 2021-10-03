<?php
session_start();

if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if (!empty($_SESSION['auth'])): ?>
    <!DOCTYPE html>
    <html>
    <head>

    </head>
    <body>
    <p>текст только для авторизованного пользователя</p>
    </body>
    </html>
<?php else: ?>
    <p>пожалуйста, авторизуйтесь</p>
<?php endif; ?>

<a href="page2.php">logout</a>
