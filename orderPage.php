<?php

require_once 'init.php';
require_once 'Session.php';

use Sessions\Session;
Session::start();

//Session::remove('orderList');
$customerName = $_SESSION['customerName'];
// $CustomerOrderList = new OrderList();

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
        <img src="assets/logo.png" alt="Starbutts Logo" style="width: 120px; height: 120px; margin-left: 50px; margin-right: 50px; margin-top: 10px">
        <h2>Starbucks Philippines</h2> <br>
        <li><a href="orderPage.php">Menu</a></li>
        <li><a href="cartPage.php">Cart</a></li>
        <li><a href="launcher.php">Sign out</a></li>
    </div>

    <h1>Good Day, <?php echo $customerName; ?>! Want some coffee and snacks?</h1>

    <form action=<?php echo $_SERVER[
        'PHP_SELF'
    ]; ?> method="post" id="itemForm">

    <h3 id="h3">Menu</h3>
    <div class="beverages">
        <h4>Beverages</h4>
            <select name="consumable" id="consumable">
                <option value="placeholder" selected>Choose your beverage</option>
            </select>
    </div>

    <div class = "images">
        <img src="assets/bg1.jpg" alt="bg1" style="width: 50px; height: 50px;">
    </div>
    

    <div class="food">
        <h4>Food</h4>
            <select name="consumable" id="consumable">
                <option value="placeholder" selected>Select food</option>
            </select>
    </div>
    
    <button type="submit">Add To Your Cart</button>

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