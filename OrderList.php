<?php

require_once 'init.php';

use Sessions\Session;

class OrderList {
    public function addOrder(string $itemName, float $basePrice, string $type, int $option){
        $postPrice = 0;
        if($option == 3){
            $postPrice = $basePrice + 30;
        } else if ($option == 2){
            $postPrice = $basePrice + 15;
        } else {
            $postPrice = $basePrice;
        }


        if($type == '1' || $type == '2' || $type == '3'){
            $beverageItem = new Beverage($itemName, $postPrice, $type, $option);
            if(!Session::has('orderList')){
                $_SESSION['orderList'][0] = $beverageItem;
            } else {
                $temp = Session::get('orderList');
                array_push($temp,$beverageItem);
                Session::add('orderList', $temp); 
            }
        } else {
            $foodItem = new Food($itemName, $postPrice, $type, $option);
            if(!Session::has('orderList')){
                $_SESSION['orderList'][0] = $foodItem;
            } else {
                $temp = Session::get('orderList');
                array_push($temp,$foodItem);
                Session::add('orderList', $temp); 
            }
        }
    }

    public function removeOrder(int $position){
        Session::removeSpecificElement('orderList', $position);
    }

    

}