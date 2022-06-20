<?php

declare(strict_types=1);

class Food extends Consumable implements iFood{
    public $foodMenu;
    public $foodSlice;

    public function _construct(string $MenuName,float $ItemPrice,string $Ftype,int $sizePortion){
        $this->menuName=$MenuName;
        $this->itemPrice=$ItemPrice;
        $this->foodMenu=$menu;
        $this->foodSlice=$sliceChoice;
    }

    public function getFoodSlice():string{
        $foodSlice = "";

        if($this -> beverageCupSize == 1){
            $foodSlice = "1 Slice";
        }else if($this -> beverageCupSize == 2){
            $foodSlice = "2 Slices";
        }else if($this -> beverageCupSize == 3){
            $foodSlice = "3 Slices";
        }else if($this -> beverageCupSize == 4){
            $foodSlice = "4 Slices";
        }else if($this -> beverageCupSize == 5){
            $foodSlice = "1 Whole";
        }
        return $foodSlice;
    }

    public function setFoodSlice(){
        $this->foodSlice=$slice;
        return $this; 
    }

    public function getMenu(): string{
        return $this->foodMenu;
    }
    public function setMenu(string $menu){
        $this->foodMenu=$menu;
        return $this;
    }

}