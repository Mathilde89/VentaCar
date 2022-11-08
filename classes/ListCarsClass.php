<?php

class ListCars{
 protected float $startingprice;
 protected string $startdate;
 protected string $enddate;
 protected float $sellingprice;

 protected function __construct(float $startingprice, string $startdate, string $enddate, float $sellingprice)
 {
    $this->sellingprice=$startingprice;
    $this->startdate=$startdate;
    $this->enddate=$enddate;
    $this->sellingprice=$sellingprice;
 }
}

?>