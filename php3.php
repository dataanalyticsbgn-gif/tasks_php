<?php
// Запускаем сессию
session_start();

// Инициализируем счетчик, если его нет
if (!isset($_SESSION['visit_count'])) {
    $_SESSION['visit_count'] = 0;
}

// Увеличиваем счетчик посещений
$_SESSION['visit_count']++;

// Получаем текущее значение
$count = $_SESSION['visit_count'];
echo $count . ' - Мы на странице php3.php';
// Проверяем, кратно ли 3
if ($count % 3 == 0) {
    // Редирект на четвертую страницу
    header('Location: php4.php');

    exit(); // Останавливаем выполнение скрипта
}