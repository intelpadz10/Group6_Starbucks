<?php

declare(strict_types=1);

class Beverage extends Consumable implements InterfaceBeverage{
    public $beverageMenu;
    public $beverageCupSize;

    public function _construct(string $MenuName,float $ItemPrice,string $menu,int $sizeChoice){
        $this->menuName=$MenuName;
        $this->itemPrice=$ItemPrice;
        $this->beverageMenu=$menu;
        $this->beverageCupSize=$sizeChoice;
    }

    public function getCupSize(): string{
        $sizeName = " ";

        if($this -> beverageCupSize == 1){
            $sizeName = "Demi (3 oz.)";
        }else if($this -> beverageCupSize == 2){
            $sizeName = "Short (8 oz.)";
        }else if($this -> beverageCupSize == 3){
            $sizeName = "Tall (12 oz.)";
        }else if($this -> beverageCupSize == 4){
            $sizeName = "Grande (16 oz.)";
        }else if($this -> beverageCupSize == 5){
            $sizeName = "Venti (20 oz.)";
        }else if($this -> beverageCupSize == 6){
            $sizeName = "Trenta (31 oz.)";
        }

        return $sizeName;
    }

    public function setCupSize(string $BeverageCupSize){
        $this->beverageCupSize=$BeverageCupSize;
        return $this;
    }

    public function getMenu():string{
        return $this->beverageMenu;
    }

    public function setMenu(string $menu){
     $this->beverageMenu=$menu;
     return $this;
    }

}