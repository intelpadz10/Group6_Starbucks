<?php

declare(strict_types=1);

class Consumable implements IConsumable {

    public $itemPrice;
    public $menuName;

    public function setMenuName(string $name){
        $this->menuName=$name;
        return $this;   
    }

    public function getMenuName():string{
        return $this->menuName;   
    }

    public function getItemPrice():float{
        return $this->itemPrice;
    }

    public function setItemPrice(float $price){
        $this->itemPrice=$price;
        return $this;
    }
}


