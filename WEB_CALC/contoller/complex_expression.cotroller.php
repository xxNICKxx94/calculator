<?php

require "../src/complex_expression.src.php";

if (!empty($_POST)) {
    $math_expression = explode(' ', $_POST['complex_expression']);
    $error_message = [];
    $error_msg = [];
    $result = '';
    $tips[] = 'Check your input: ' . implode($_POST);
    $tips[] = '- Do not use a spacebar after last element';
    $tips[] = '- The minimum possible number of elements is three';
    
    if (!is_valid_math_expression($math_expression, $error_message)) {
        $error_msg = $error_message;
    } else {
        $result = implode($_POST) . ' = ' . calculate_complex_expression($math_expression);
    }
}

require "../view/complex_expression.view.php";
