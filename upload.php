<?php
// Проверка, что форма была отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit();
}

// Проверка: если поле file_name пустое
if (empty($_POST['file_name']) || trim($_POST['file_name']) === '') {
    header('Location: index.html');
    exit();
}

// Проверка: если файл не был передан на сервер
if (!isset($_FILES['content']) || $_FILES['content']['error'] === UPLOAD_ERR_NO_FILE) {
    header('Location: index.html');
    exit();
}

// Проверка на ошибки при загрузке
if ($_FILES['content']['error'] !== UPLOAD_ERR_OK) {
    die("Ошибка при загрузке файла. Код ошибки: " . $_FILES['content']['error']);
}

// Получаем имя файла из формы
$fileName = trim($_POST['file_name']);

// Создаём каталог upload, если его нет
$uploadDir = 'upload/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Полный путь для сохранения файла
$uploadPath = $uploadDir . $fileName;

// Перемещаем загруженный файл в каталог upload
if (move_uploaded_file($_FILES['content']['tmp_name'], $uploadPath)) {
    // Получаем полный путь к файлу
    $fullPath = realpath($uploadPath);
    
    // Получаем размер файла
    $fileSize = filesize($uploadPath);
    
    // Форматируем размер для удобства
    $fileSizeFormatted = formatBytes($fileSize);
    
    // Выводим информацию
    echo "<!DOCTYPE html>";
    echo "<html lang='ru'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>Файл загружен</title>";
    echo "<style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 5px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='success'><h2>✓ Файл успешно загружен!</h2></div>";
    echo "<div class='info'>";
    echo "<p><strong>Полный путь к файлу:</strong><br>" . htmlspecialchars($fullPath) . "</p>";
    echo "<p><strong>Размер файла:</strong> " . $fileSizeFormatted . " (" . number_format($fileSize) . " байт)</p>";
    echo "</div>";
    echo "<a href='index.html'>← Загрузить ещё один файл</a>";
    echo "</body>";
    echo "</html>";
} else {
    die("Ошибка при сохранении файла на сервер.");
}

/**
 * Функция для форматирования размера файла
 */
function formatBytes($bytes, $precision = 2) {
    $units = ['Б', 'КБ', 'МБ', 'ГБ', 'ТБ'];
    
    for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}

