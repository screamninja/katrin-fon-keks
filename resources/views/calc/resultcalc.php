<?php
$result = require __DIR__ . '/calc.calc.php';
?>
<html>
<head>
    <title>Калькулятор</title>
</head>
<body>
<b>Результат вычислений:</b>
<br>
<?= $result ?>
</body>
</html>