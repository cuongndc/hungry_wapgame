<?php
/* Настройки подключения к бд */
switch (getenv('REMOTE_ADDR')) {
default:
define('HOST', 'localhost'); // Хост
define('USER', 'denikos'); // Пользователь
define('PASS', '123456a'); // Пароль
define('BASE', 'denikos'); // Имя БД
break;
case 'localhost':
define('HOST', 'localhost'); // Хост
define('USER', 'denikos'); // Пользователь
define('PASS', '123456a'); // Пароль
define('BASE', 'denikos'); // Имя БД
break;
}

?>