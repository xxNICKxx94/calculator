<?php require "html_parts/head.php"; ?>

<body>
    <form action="../contoller/complex_expression.cotroller.php" method="post">
        <label for="user_input_complex_expression"><b>Please, type in the math expression:</b></label>
        <center><input type="text" id="user_input_complex_expression" name="complex_expression" /></center><br>
        <button type="submit"><b>Submit</b></button>
    </form>
    <?php if (!empty($error_message)) : ?>
        <p><b>
                <?= "INVALID INPUT" ?><br>
                <?php foreach ($error_msg as $error) : ?>
                    <?= $error; ?><br>
                <?php endforeach ?>
                <?php foreach ($tips as $tip) : ?>
                    <?= $tip; ?><br>
                <?php endforeach ?>
        </p></b>
    <?php endif ?>
    <?php if (!empty($result)) : ?>
        <p><b>
                <?= $result; ?>
        </p></b>
    <?php endif ?>
</body>
