<?php

require_once 'init.php';
require_once 'Session.php';

use Sessions\Session;
Session::start();

//Session::remove('orderList');
$customerName = $_SESSION['customerName'];
$CustomerOrderList = new OrderList();

if ($_REQUEST) {
    if (isset($_REQUEST['delete'])) {
        $CustomerOrderList->removeOrder($_REQUEST['delete']);
    }
}
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
    
    <link rel="stylesheet" href="cartPage.css">
    <link rel="icon" href="assets/logo.png" />

    <title>Starbucks Philippines</title>
    <script src="axios.js" type="text/javascript"></script>
</head>
<body>
<div class = "navBar">
        <img src="assets/logo.png" alt="Starbutts Logo" style="width: 120px; height: 120px; margin-left: 50px; margin-right: 50px; margin-top: 10px">
        <h2>Starbucks Philippines</h2> <br>
        <li><a href="orderPage.php">Menu</a></li>
        <li><a href="cartPage.php">Cart</a></li>
        <li><a href="launcher.php">Sign out</a></li>
    </div>
<div class="container">
        <h3 class="yourOrders">Your Orders</h3>
        <div id="orders">
            <?php if ($_REQUEST) {
                foreach ($_SESSION['orderList'] as $key => $order) {
                    echo '<label style = "padding-right: 2em; text-align: right; font-size: 16px;">' .
                        $order->getName() .
                        '   ₱' .
                        $order->getPrice() .
                        '</label>';
                    echo '<button type="submit" name="delete" value="' .
                        $key .
                        '" style = "padding: 5px; font-size: 7px; height: 20px; width: 20px;
                        margin-top: 1.5em;">x</button><br>';
                }
            } ?>
        </div>
        <button type="submit" name="placeOrder" style="margin-top: 2em;">Place your Order</button>
        
        <?php if ($_REQUEST) {
            if (isset($_REQUEST['placeOrder'])) {
                if (!empty($_SESSION['orderList'])) {
                    header('Location: receipt.php');
                } else {
                    echo '<br><p style="font-size:12px; color: #939393; font-weight: 450; padding-top:1em;">Please select an item<p>';
                }
            }
        } ?>
</body>
