<?php
// Запускаем сессию
session_start();

// Получаем количество посещений третьей страницы
$visit_count = isset($_SESSION['visit_count']) ? $_SESSION['visit_count'] : 0;

echo $visit_count. " - Мы на странице php4.php";