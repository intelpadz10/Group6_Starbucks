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
    
    <link rel="stylesheet" href="orderPage.css">
    <link rel="icon" href="assets/logo.png" />

    <title>Starbucks Philippines</title>
    <script src="axios.js" type="text/javascript"></script>
</head>
<body>
    <div class = "navBar">
        <img src="assets/logo.png" alt="Starbutts Logo" style="width: 60px; height: 60px;">
        <h5>Starbucks Philippines</h5> <br>
        <li><a href="launcher.php">Home</a></li>
        <li><a href="orderPage.php">Cart</a></li>
    </div>

    <h1 class= "customer">Good Day, <?php echo $customerName; ?>!. What would you like to have today?</h1>

    <form action=<?php echo $_SERVER[
        'PHP_SELF'
    ]; ?> method="post" id="itemForm">
        <h2>Food & Beverages</h2>
        <select name="consumable" id="consumable">
            <option value="placeholder" selected>   Select type of consumable   </option>
        </select>

        <hr>

        <h2>Menu</h2>
        <div id="menu">
        </div>
        
        <button type="submit" name="addOrder" style="margin-top: 2em;">Add To Your Order</button>
        <?php if ($_REQUEST) {
            if (isset($_REQUEST['addOrder'])) {
                if (
                    isset($_REQUEST['menuItem']) &&
                    $_REQUEST['selection'] != 'placeholder'
                ) {
                    $itemData = explode('.', $_REQUEST['menuItem']);
                    $CustomerOrderList->addOrder(
                        $itemData[0],
                        floatval($itemData[1]),
                        $itemData[2],
                        $_REQUEST['option']
                    );
                }
            }
        } ?>

        <hr>
        <div class="container">
        <h2 class="yourOrders">Your Orders</h2>
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
    </form>
        </div>
</body>
<script>
    window.addEventListener("load", getConsumables);
    document.getElementById("consumable").addEventListener("change", getMenu);


    function getConsumables(){  
        axios
            .get("query.php", {
                params: {
                    consumable: true,
                },
            })
            .then((response) => showAll(response))
            .catch((error) => {
                console.error(error);
            });
    }

    function showAll(response){
        var result = response;
        for(i in result.data){
            var option = document.createElement("option");
            option.value = result.data[i].ID_con;
            option.text = result.data[i].con_name;
            var select = document.getElementById("consumable");
            select.appendChild(option);
        }
    }

    function getMenu(){
        var menuID = document.getElementById("selection").value;
        axios
            .get("query.php", {
                params: {
                    products: prod_id,
                },
            })
            .then((response) => showMenu(response))
            .catch((error) => {
                console.error(error);
            });
    }

    function showMenu(response){
        var result = response;
        var menu = document.getElementById("menu");
        layout = ``;
        for(i in result.data){
            layout += `
            <input type="radio" id="${result.data[i].prodID}" name="menuItem" value="${result.data[i].prodName}.${result.data[i].prodBasePrice}.${result.data[i].conID}">
            `;
            
            layout +=
            "<label for=" + 
            result.data[i].prodID +
            "> " +
            result.data[i].prodName +
            " </label><br>";
        }

        if(result.data[0].conID >= 4){
            layout += `
                <br>
                <div id="menuOptions">
                    <select name="option" id="option" >
                        <option value=1 selected>One Portion</option>
                        <option value=2>Two Portion</option>
                        <option value=3>Three Portion</option>
                    </select>
                </div>
                <br>

            `
        } else {
            layout += `
                <br>
                    <div id="menuOptions">
                    <select name="option" id="option">
                        <option value=1 selected>Tall</option>
                        <option value=2>Grande</option>
                        <option value=3>Venti</option>
                    </select>
                </div>
                <br>
            `
        }
        menu.innerHTML = layout;
    }

</script>
</html>