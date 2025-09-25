<?php

function readString($checkingTheString) {
    while (true) {
        echo $checkingTheString;
        $parName = trim(fgets(STDIN));

        // Проверяем, является ли введенное значение пустой строкой
        if (empty($parName)) {
            fwrite(STDERR, "Введите, пожалуйста, не пустое значение\n");
        } elseif (substr_count($parName, ' ') > 0) {
            fwrite(STDERR, "Введите, пожалуйста, одно слово без пробелов\n");
        } else {
            break;
        }
    }
    return $parName;
}

// Функция для нормализации строки (первая буква заглавная, остальные строчные)
function normalizeName($param) {
    return mb_strtoupper(mb_substr($param, 0, 1)) . mb_strtolower(mb_substr($param, 1));
}

// Получаем ФИО
$surname = readString("Введите фамилию: ");
$firstname = readString("Ваше имя? ");
$patronymic = readString("Ваше отчество? ");

// Формируем полное имя
$fullname = normalizeName($surname) . ' ' . normalizeName($firstname) . ' ' . normalizeName($patronymic);
 
// Формируем фамилию с инициалами
$surnameAndInitials = normalizeName($surname) . ' ' . mb_strtoupper(mb_substr($firstname, 0, 1)) . '.' . mb_strtoupper(mb_substr($patronymic, 0, 1)) . '.';

// Формируем аббревиатуру ФИО
$fio = mb_strtoupper(mb_substr($surname, 0, 1) . mb_substr($firstname, 0, 1) . mb_substr($patronymic, 0, 1));

// Вывод на экран
echo "Полное имя: " . $fullname . "\n";
echo "Фамилия и инициалы: " . $surnameAndInitials . "\n";
echo "Аббревиатура: " . $fio;