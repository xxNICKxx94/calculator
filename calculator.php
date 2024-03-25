<?php

function run(): void
{
    $first_operand = readline('Please, type in the first operand:');  
    $operator = readline('Please, type in the operator: ');
    $second_operand = readline('Please, type in the second operand: ');
    $result = 0;

    $is_valid_user_input = is_valid_user_input($first_operand, $operator, $second_operand);

    if ($is_valid_user_input) {
        echo $first_operand . $operator . $second_operand . '=' . calculate($first_operand, $operator, $second_operand) . PHP_EOL;
    }
}

function is_valid_user_input($first_operand, $operator, $second_operand): bool
{
    $error = true;
    $error_message = 'INVALID INPUT:' . PHP_EOL;

    if (!is_numeric($first_operand)) {
        $error = false;
        $error_message = $error_message . '- Expected first operand value to be a valid number, ' . $first_operand . ' given' . PHP_EOL; 
    }

    switch ($operator) {
        case '+':
        case '-':
        case '/':
        case ':':
        case '*':
            break;
        default:
            $error_message = $error_message . '- Expected operator to be a valid math operator, ' . $operator . ' given' . PHP_EOL;
            $error = false;
    }

    if (!is_numeric($second_operand)) {
        $error = false;
        $error_message = $error_message . '- Expected second operand value to be a valid number ' . $second_operand . ' given' . PHP_EOL;   
    }
     
    if (!$error) {
        echo $error_message;
    }
           
    return $error;
}

function calculate($first_operand, $operator, $second_operand): float
{
    switch ($operator) {
        case '+':
            $result = $first_operand + $second_operand;
            return $result;
        case '-':
            $result = $first_operand - $second_operand;
            return $result;
        case '*':
            $result = $first_operand * $second_operand;
            return $result;
        case '*':
            $result = $first_operand * $second_operand;
            return $result;
        case '/':
            $result = $first_operand / $second_operand;
            return $result;
        case ':':
            $result = $first_operand / $second_operand;
            return $result;
    }
}

run();

















