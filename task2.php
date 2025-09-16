<?php
//$variable=1;
//$variable='one';
//$variable=true;
//$variable=3.14;
//$variable=null;
//$variable=[];
$res;

if(is_int($variable)) {
    $res='int';
} elseif (is_bool($variable)) {
    $res='bool';
} elseif(is_float($variable)) {
    $res='float';
} elseif(is_string($variable)) {
    $res='string';
} elseif(is_null($variable)) {
    $res='null';
} elseif(is_array($variable)) {
    $res='other';
};
echo $res;

switch(gettype($variable)){
    case 'integer':
        echo 'int';
        break;
    case 'boolean':
        echo 'bool';
    break;
    case 'double':
        echo 'float';
    break;
    case 'string':
        echo 'string';
    break;
    case 'NULL':
        echo 'null';
    break;
    case 'array':
        echo 'other';
    break;
    default:
        echo'тип данных не определен';
}