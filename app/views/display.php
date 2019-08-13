<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Displaying data.</title>
</head>
<body>
    <?php
    foreach($data as $key => $value) {
        echo "data $key adalah $value";
        echo "<br>";
    }
    ?>
</body>
</html>