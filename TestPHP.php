<?php

$nameFile=__FILE__;
$numberLine=__LINE__;

echo "Название текущего файла: " . basename("$nameFile$nameFile");
echo"\n";
echo "Номер текущей строки: " . $numberLine;
echo"\n";

echo <<<END
    a
   b
  c
d
\n
END;

$a='Рыба';
$b='человек';

echo "$a " . preg_replace('/Рыба/', 'рыбою', $a) . " сыта, а $b " . preg_replace('/ек/', 'еком', $b);
