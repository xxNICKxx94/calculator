<?php

require "../src/simple_expression.src.php";

if (!empty($_POST)) {
    $first_operand = $_POST['first_operand'];
    $operator = $_POST['operator'];
    $second_operand = $_POST['second_operand'];
    $error_message = [];
    $result_calculate = '';
    $result = '';
    if (!is_valid_user_input($first_operand, $operator, $second_operand, $error_message)) {
        $error_msg = 'INVALID INPUT:<br>' . implode($error_message);
    } else {
        calculate($first_operand, $operator, $second_operand, $result_calculate);
        $result = implode($_POST) . '=' . $result_calculate;
    }
}

require "../view/simple_expression.view.php";

?>
