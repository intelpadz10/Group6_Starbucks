<?php

interface iFood{
    public function getMenu(string $menu);
    public function setMenu(): string;
    public function setFoodSlice(int $slice);
    public function getFoodSlice():string;
}