<?php
$message = "\n\nИмя: ".$_POST['name']."\r\nТелефон: ".$_POST['phone']."\r\nE-mail: ".$_POST['email'];

// На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Отправляем
mail('art.sandin@yandex.ru', 'Feedback Form', $message);
?>