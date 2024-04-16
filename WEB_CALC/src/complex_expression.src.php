<?php

require "simple_expression.src.php";

function is_valid_math_expression($math_expression, &$error_message): bool
{
    $is_valid = true;
    $errors_operators = [];
    $errors_operands = [];

    if (count($math_expression) <= 2 || count($math_expression) % 2 === 0) {
        $error_message[] = '- You have entered an even number of values or the number of values less than 3';
        $is_valid = false;
        return $is_valid;
    }

    if (!is_valid_expression($math_expression, $errors_operators, $errors_operands)) {
        if (!empty($errors_operands)) {
            $invalid_operands = implode(array_unique($errors_operands));
            $error_message[] = '- Expected operands value to be a valid numbers, ' . $invalid_operands . ' given';
            $is_valid = false;
        }

        if (!empty($errors_operators)) {
            $invalid_operators = implode($errors_operators);
            $error_message[] = '- Expected operators to be a valid math operators, ' . $invalid_operators . ' given';
            $is_valid = false;
        }
    }

    if (!$is_valid) {
        return $is_valid;
    }

    return $is_valid;
}

function is_valid_expression($math_expression, &$errors_operators, &$errors_operands)
{
    $first_operator_index = 1;
    $iteration_loop = 2;
    $is_valid = true;

    for ($i = $first_operator_index; $i < count($math_expression); $i = $i + $iteration_loop) {
        if (!is_numeric($math_expression[$i - 1])) {
            $errors_operands[] = $math_expression[$i - 1] . ' ';
            $is_valid = false;
        }

        if (!is_numeric($math_expression[$i + 1])) {
            $errors_operands[] = $math_expression[$i + 1] . ' ';
            $is_valid = false;
        }

        switch ($math_expression[$i]) {
            case '+':
            case '-':
            case '/':
            case ':':
            case '*':
                break;
            default:
                $is_valid = false;
                $errors_operators[] = $math_expression[$i] . ' ';
        }
    }

    return $is_valid;
}

function calculate_complex_expression($math_expression): float
{
    $result = 0;
    //Цикл выполняет подсчет операций высшего приоритета. Результатом является массив с операциями низшего приоритета.
    for ($i = 1; $i < count($math_expression); $i = $i + 2) {
        if (
            $math_expression[$i] === '*'
            || $math_expression[$i] === ':'
            || $math_expression[$i] === '/'
        ) {
            $math_expression[$i] = calculate($math_expression[$i - 1], $math_expression[$i], $math_expression[$i + 1]);
            unset($math_expression[$i - 1]);
            unset($math_expression[$i + 1]);
            $math_expression = recount_index($math_expression);
            $i = -1;

            if (count($math_expression) === 1) {
                $result = $math_expression[0];
                return $result;
            }
        }
    }
    // Цикл выполняет подсчет оперций низшего приоритета
    for ($i = 1; $i < count($math_expression); $i = $i + 2) {
        $math_expression[$i] = calculate($math_expression[$i - 1], $math_expression[$i], $math_expression[$i + 1]);
        unset($math_expression[$i - 1]);
        unset($math_expression[$i + 1]);
        $math_expression = recount_index($math_expression);
        $i = -1;

        if (count($math_expression) === 1) {
            $result = $math_expression[0];
            return $result;
        }
    }
}

function recount_index($old_order)
{
    $new_order = array_values($old_order);
    return $new_order;
}
