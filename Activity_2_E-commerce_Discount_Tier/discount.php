<!DOCTYPE html>
<html>

<head>
    <title>STORE DISCOUNT</title>
</head>

<body>
    <?php

    $total = $_GET['total'];

    // Determine the discount
    if ($total < 50) {
        $discountRate = 0;
    } elseif ($total < 100) {
        $discountRate = 0.10;
    } elseif ($total < 200) {
        $discountRate = 0.15;
    } else {
        $discountRate = 0.20;
    }

    $discountAmount = $total * $discountRate;

    $finalPrice = $total - $discountAmount;

    echo "Original Price: ₱" . number_format($total, 2) . "<br>";
    echo "Discount Amount: ₱" . number_format($discountAmount, 2) . "<br>";
    echo "Final Price: ₱" . number_format($finalPrice, 2);

    ?>

</body>

</html>