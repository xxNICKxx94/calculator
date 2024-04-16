<?php

function is_valid_user_input($first_operand, $operator, $second_operand, &$error_message): bool
{
    $is_valid = true;
    $error_message = [];

    if (!is_numeric($first_operand)) {
        $is_valid = false;
        $error_message[] = '- Expected first operand value to be a valid number, ' . $first_operand . ' given';
    }

    switch ($operator) {
        case '+':
        case '-':
        case '/':
        case ':':
        case '*':
        case '^':
            break;
        default:
            $error_message[] = '- Expected operator to be a valid math operator, ' . $operator . ' given';
            $is_valid = false;
    }

    if (!is_numeric($second_operand)) {
        $is_valid = false;
        $error_message[] = '- Expected second operand value to be a valid number ' . $second_operand . ' given';
    }

    return $is_valid;
}

function calculate($first_operand, $operator, $second_operand): float
{
    $result = 1;

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
        case '^':
            if ($second_operand === 0) {
                $result;
            }

            if ($second_operand === 1) {
                $result = $first_operand;
            }

            if ($second_operand < 0) {
                for ($i = abs($second_operand); $i > 0; $i--) {
                    $result = $result * $first_operand;
                }

                $result = 1 / $result;
            }
            for ($i = $second_operand; $i > 0; $i--) {
                $result = $result * $first_operand;
            }

            return $result;
    }
}
