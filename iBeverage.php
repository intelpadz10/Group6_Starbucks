<?php

interface iBeverage{
    public function getCupSize():string;
    public function setCupSize(string $BeverageCupSize);
    public function getMenu(): string;
    public function setMenu(string $menu);
    
}