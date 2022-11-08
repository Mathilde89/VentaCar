<?php

class ListCars{
 protected int $startingprice;
 protected string $startdate;
 protected string $enddate;
 protected int $sellingprice;

 protected function __construct(int $startingprice, string $startdate, string $enddate, int $sellingprice)
 {
    $this->sellingprice=$startingprice;
    $this->startdate=$startdate;
    $this->enddate=$enddate;
    $this->sellingprice=$sellingprice;
 }
}

?>