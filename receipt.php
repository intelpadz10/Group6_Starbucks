<?php

require_once "init.php";
use Sessions\Session;
Session::start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="cssFiles\receipt.css">

    <link rel="icon" href="assets/starbucks_logo.png" />

    <title>Starbucks.com</title>

   <style type = "text/css">

        body{
            background-image: url('assets/rr-abrot-pNIgH0y3upM-unsplash.jpg');
            background-size: cover;
        }

    </style>
</head>
<body>

    <center>

    <img src="assets/starbucks_logo.png" alt="Starbutts Logo">

        <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
            <h2>Thank you for purchasing, <?php echo $_SESSION['customerName']?>!</h2>
            <hr>
            <?php
                foreach($_SESSION['orderList'] as $key=>$order){
                    echo '<label>'.$order->getName().'   ₱'.$order->getPrice().'</label><br>';
                }
            ?>
            <hr>
            <h3>Total Amount: ₱<?php 
                $totalAmount = 0;
                foreach($_SESSION['orderList'] as $key=>$order){
                    $totalAmount += $order->getPrice();
                }
                echo $totalAmount;
            ?></h3>

            <button type="submit" name="orderAgain">Order Again</button>
            <?php
                if($_REQUEST){
                    if(isset($_REQUEST['orderAgain'])){
                        header('Location: launcher.php');
                    }
                }
            ?>
        </form>
    </center>
</body>
</html>