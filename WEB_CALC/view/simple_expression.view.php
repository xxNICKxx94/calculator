<?php require "html_parts/head.php"; ?>

<body>
    <form action="../contoller/simple_expression.controller.php" method="post">
        <label for="user_input_first_operand"><b>Please, type in the fisrt operand</b></label>
        <center><input type="text" id="user_input_first_operand" name="first_operand" /></center><br>
        <label for="user_input_operator"><b>Please, type in the operator</b></label>
        <center><input type="text" id="user_input_operator" name="operator" /></center><br>
        <label for="user_input_second_operand"><b>Please, type in the second operand</b></label>
        <center><input type="text" id="user_input_second_operand" name="second_operand" /></center><br>
        <button type="submit"><b>Submit</b></button>
    </form>
    <?php if (!empty($error_message)) : ?>
        <p>
            <b><?php echo $error_msg; ?></b>
        </p>
    <?php endif ?>
    <?php if (!empty($result)) : ?>
        <p>
            <b><?= $result; ?></b>
        </p>
    <?php endif ?>
</body>
