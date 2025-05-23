<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payement</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
        <?php include "./php/header.php"; ?>
    <div style = "
                    display:flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    height: 80vh;
                    font-size:60px;
    ">

<?php
session_start();
include "./php/connection.php";
$link = connect_connect();

$userID = $_SESSION['userID'] ?? 0;
if ($userID === 0) {
    die("Utilisateur non connecté.");
}

//CODE TO STORE HISTORYY
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payMethod = $_POST['payMethod'] ?? '';
    $totalPrice = floatval($_POST['productID'] ?? 0);

    $stmt = $link->prepare("INSERT INTO payments (userID, total_price, payment_method, payment_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ids", $userID, $totalPrice, $payMethod);

    //empty the basket
    if ($stmt->execute()) {
        $link->query("DELETE FROM basket WHERE userID = $userID");

        header("Location: payment.php?success=1&amount=$totalPrice&method=" . urlencode($payMethod));
        exit();
    } else {
        echo "<p>Erreur lors du paiement : " . $stmt->error . "</p>";
    }
}

//pour affichage!
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $amount = number_format(floatval($_GET['amount']), 2);
    $method = htmlspecialchars($_GET['method']);

    echo "<h2>Paiement effectué avec succès</h2>";
    echo "<p>Montant payé : $amount DH</p>";
    echo "<p>Méthode de paiement : $method</p>";
} else {
    echo "<p>Aucun paiement détecté.</p>";
}
?>
</div>
    <?php include "./php/footer.php"; ?>
</body>
</html>