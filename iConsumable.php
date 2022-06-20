<?php

interface IConsumable{
    public function getItemPrice(): float;
    public function setItemPrice(float $price);
    public function setMenuName(string $name);
    public function getMenuName():string;
}