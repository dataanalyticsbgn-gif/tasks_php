<?php

//функция для проверки корректности параметров 
function readString($parameterRequest,int $f, $month = 1): int
{
    //задаем формат для переменных год и месяц
    $formatYear = '/^20\d{2}$/';
    $monthFormat = '/^(0?[1-9]|1[0-2])$/';
    
    echo $parameterRequest;
    $parameterNumber = trim(fgets(STDIN));
    switch ($f)
        {
            case 1:
            if(!preg_match($formatYear,$parameterNumber))
                {
                fwrite(STDERR, "Введите номер года числом 20..");
                }
            $intReturn = $parameterNumber;
            break;
            case 2: 
            if(!preg_match($monthFormat,$parameterNumber))
                    {
                    fwrite(STDERR, "Введите номер месяца");
                    }
            $intReturn = $parameterNumber;
            break;
            case 3:
            if (($month - $parameterNumber) <= 0) 
            {
                fwrite(STDERR, "Введите корректное количество месяцев до конца года");
            }
            $intReturn = $parameterNumber;
            break;
            }
    return $intReturn;
}

function stringFormation (int $parY, int $parM, int $numM):string
{

//$parY - номер года
//$parM - номер месяца
//$numM - количество месяцев

// Создаём строку для хранения графика
$calendar = "График работы: ";

// Переменная для отслеживания: 0 - рабочий, 1 - первый выходной, 2 - второй выходной
$workCalendar = 0;
for ($numM; $numM>0;$numM--)
{
    $numberDay = cal_days_in_month(CAL_GREGORIAN, $parM, $parY); //узнаем количество дней месяца
    $calendar .=  date('F', mktime(0, 0, 0, $parM, 1, $parY)) . PHP_EOL;// записываем в строку название месяца
    for ($day=1; $day<=$numberDay; $day++)
    {
        $dayOfWeek = date('N', strtotime("$parY-$parM-$day")); // Получаем день недели (1 = понедельник, 7 = воскресенье)
        // Проверяем, является ли день субботой или воскресеньем
    if ($dayOfWeek == 6 || $dayOfWeek == 7) {
        $calendar .= "$day - выходной (суббота/воскресенье)"  . PHP_EOL;
        $workCalendar = 0;
    } else {
        if ($workCalendar === 0) {
            // Рабочий день
            $calendar .= "$day - рабочий день"  . PHP_EOL;
            $workCalendar = 1; // переходим к первому выходному
        } else {
            // Выходной по графику
            $calendar .= "$day - выходной"  . PHP_EOL;
            $workCalendar++;
            if ($workCalendar === 3) {
                $workCalendar = 0; // возвращаемся к рабочему дню
            }
        }
            }
    }
    //месяц закончился
    $parM +=1;//меняем номер месяца
}
return $calendar;
}

//получаем исходные данные (номер года, номер месяца, количество месяцев)
$yearNumber = readString("Введите номер года числом: ", $f = 1);
$monthNumber = readString("Введите номер месяца числом: ", $f = 2);
$numberMonths = readString("Введите количество месяцев для календаря числом: ", $f = 3, $monthNumber);

$calendarW = stringFormation($yearNumber, $monthNumber, $numberMonths);

echo $calendarW;