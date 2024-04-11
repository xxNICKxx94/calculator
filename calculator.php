<?php

run($argc, $argv);

function run($argc, $argv): void
{
    $error_message = 'Usage:' . PHP_EOL . 'php calculator.php' . PHP_EOL . 'php calculator.php --complex_expression' . PHP_EOL;

    switch ($argc) {
        case 1:
            simple_expression();
            break;
        case 2:
            if ($argv[1] === '--complex-expression') {
                complex_expression();
                break;
            }
        default:
            echo $error_message;
    }
}

function simple_expression()
{
    $first_operand = readline('Please, type in the first operand:');
    $operator = readline('Please, type in the operator: ');
    $second_operand = readline('Please, type in the second operand: ');

    $is_valid_user_input = is_valid_user_input($first_operand, $operator, $second_operand);

    if ($is_valid_user_input) {
        echo $first_operand . $operator . $second_operand . '=' . calculate($first_operand, $operator, $second_operand) . PHP_EOL;
    }
}

function is_valid_user_input($first_operand, $operator, $second_operand): bool
{
    $is_valid = true;
    $error_message = 'INVALID INPUT:' . PHP_EOL;

    if (!is_numeric($first_operand)) {
        $is_valid = false;
        $error_message = $error_message . '- Expected first operand value to be a valid number, ' . $first_operand . ' given' . PHP_EOL; 
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
            $error_message = $error_message . '- Expected operator to be a valid math operator, ' . $operator . ' given' . PHP_EOL;
            $is_valid = false;
    }

    if (!is_numeric($second_operand)) {
        $is_valid = false;
        $error_message = $error_message . '- Expected second operand value to be a valid number ' . $second_operand . ' given' . PHP_EOL;
    }

    if (!$is_valid) {
        echo $error_message;
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
                for ($i = abs($second_operand); $i > 0; $i-- ) {
                    $result = $result * $first_operand;
                }

                $result = 1 / $result;
            }
            for ($i = $second_operand; $i > 0; $i-- ) {
                $result = $result * $first_operand;
            }

            return $result;
    }
}

function complex_expression()
{
    $user_input = readline('Please, type in the math expression: ');
    $math_expression = explode(' ', $user_input);
    $tips = '- Do not use a spacebar after last element' . PHP_EOL . '- The minimum possible number of elements is three' . PHP_EOL;

    if (is_valid_math_expression($math_expression)) {
        echo $user_input . ' = ' . calculate_complex_expression($math_expression) . PHP_EOL;
    } else {
        echo 'Check yout input: ' . $user_input . PHP_EOL . 'TIPs:' . PHP_EOL . $tips . PHP_EOL;
    }
}

function is_valid_math_expression($math_expression)
{
    $is_valid = true;
    $error_message = 'INVALID INPUT:' . PHP_EOL;
    $errors_operators = [];
    $errors_operands = [];

    if (count($math_expression) <= 2 || count($math_expression) % 2 === 0) {
        $error_message = $error_message . '- You have entered an even number of values or the number of values less than 3' . PHP_EOL;
        echo $error_message;
        $is_valid = false;
        return $is_valid;
    }
    
    if (!is_valid_expression($math_expression, $errors_operators, $errors_operands)) {
        if (!empty($errors_operands)) {
            $invalid_operands = implode(array_unique($errors_operands));
            $error_message = $error_message . '- Expected operands value to be a valid numbers, ' . $invalid_operands . ' given' . PHP_EOL;
            $is_valid = false;
        }

        if (!empty($errors_operators)) {
            $invalid_operators = implode($errors_operators);
            $error_message = $error_message . '- Expected operators to be a valid math operators, '. $invalid_operators . ' given' . PHP_EOL;
            $is_valid = false;
        }
    }

    if (!$is_valid) {
        echo $error_message;
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
            $errors_operands[] = '<' . $math_expression[$i - 1] . '>' . ' ';
            $is_valid = false;
        }

        if (!is_numeric($math_expression[$i + 1])) {
            $errors_operands[] = '<' . $math_expression[$i + 1] . '>' . ' ';
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
                $errors_operators[] = '<' . $math_expression[$i] . '>' . ' ';
        }
    }

    return $is_valid;
}

function calculate_complex_expression($math_expression): float
{
    $result = 0;
    //Цикл выполняет подсчет операций высшего приоритета. Результатом является массив с операциями низшего приоритета.
    for ($i = 1; $i < count($math_expression); $i = $i + 2) {
        if ($math_expression[$i] === '*'
            || $math_expression[$i] === ':'
            || $math_expression[$i] === '/') {
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
