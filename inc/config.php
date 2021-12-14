<?php
/* Настройки подключения к бд */
switch (getenv('REMOTE_ADDR')) {
default:
define('HOST', 'localhost'); // Хост
define('USER', 'USER'); // Пользователь
define('PASS', 'PASS'); // Пароль
define('BASE', 'BASE'); // Имя БД
break;
case 'localhost':
define('HOST', 'localhost'); // Хост
define('USER', 'USER'); // Пользователь
define('PASS', 'PASS'); // Пароль
define('BASE', 'BASE'); // Имя БД
break;
}

?>