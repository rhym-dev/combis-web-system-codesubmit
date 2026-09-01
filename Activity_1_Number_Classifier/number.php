<!DOCTYPE html>
<html>

<head>
    <title>Number Checker</title>
</head>

<body>
    <form method="GET">
        <label>Enter a number:</label>
        <input type="number" name="num" required>

        <button type="submit">Check Number</button>
    </form>

    <?php

    if (isset($_GET['num'])) {

        $num = $_GET['num'];

        if ($num > 0) {

            echo "<p>The number $num is positive.</p>";


            if ($num % 2 == 0) {
                echo "<p>The number is Even.</p>";
            } else {
                echo "<p>The number is Odd.</p>";
            }
        } elseif ($num < 0) {

            echo "<p>The number $num is negative.</p>";
        } else {

            echo "<p>The number is zero.</p>";
        }
    }

    ?>

</body>

</html>