<?php

function readInteger($prompt) {
    while (true) {
        echo $prompt;
        $input = trim(fgets(STDIN));
        
        // Проверяем, является ли введенное значение целым числом
        if (filter_var($input, FILTER_VALIDATE_INT) !== false) {
            return (int)$input;
        } else {
            fwrite(STDERR, "Введите, пожалуйста, число\n");
        }
    }
}

// Получаем первое число
$firstNumber = readInteger("Введите первое число: ");

// Получаем второе число
$secondNumber = readInteger("Введите второе число: ");

// Проверяем деление на ноль
if ($secondNumber == 0) {
    fwrite(STDERR, "Делить на 0 нельзя\n");
    exit(1);
}

// Выполняем деление и выводим результат
$result = $firstNumber / $secondNumber;
echo $result . "\n";

?>

