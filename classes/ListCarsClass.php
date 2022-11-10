<?php

class ListCars{
 protected int $startingprice;
 protected string $startdate;
 protected string $enddate;
 protected int $sellingprice;
 protected int $id_cars;

 public function __construct(int $startingprice, string $startdate, string $enddate,int $sellingprice,int $id_cars)
 {
    $this->startingprice=$startingprice;
    $this->startdate=$startdate;
    $this->enddate=$enddate;
    $this->sellingprice=$sellingprice;

    $this->id_cars=$id_cars;

 }

 public function save($pdo){

        
   
   $query6 = $pdo->prepare("INSERT INTO `listcars`(`startingprice`, `startdate`, `enddate`, `sellingprice`,`id_cars`) VALUES (:startingprice,:startdate,:enddate,:sellingprice,:id_cars)");
   $query6->bindValue(":startingprice", $this->startingprice, PDO::PARAM_INT);
   $query6->bindValue(":startdate", $this->startdate, PDO::PARAM_STR);
   $query6->bindValue(":enddate",$this->enddate, PDO::PARAM_STR);
   $query6->bindValue(":sellingprice", $this->sellingprice, PDO::PARAM_INT);
   $query6->bindValue(":id_cars", $this->id_cars,PDO::PARAM_INT);
   
   return $query6->execute();
}

}

?>