<?php
// Проверяем, есть ли параметр text в GET-запросе
if (!isset($_GET['text'])) {
    die('Ошибка: параметр text не передан');
}

// Получаем текст из GET-параметра
$text = $_GET['text'];

// Устанавливаем заголовки для скачивания файла
header('Content-Type: text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename="file.txt"');

// Выводим текст (он попадёт в файл)
echo $text;

// Завершаем скрипт
exit;
?>