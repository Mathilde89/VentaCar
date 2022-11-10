<?php

class Auctions{

   protected int $auctionprice;
   protected string $auctiondate;
   protected int $listcars_id;
   protected int $users_id;


    public function __construct(int $auctionprice, string $auctiondate, int $listcars_id, int $users_id)
    {
        $this->auctionprice=$auctionprice;
        $this->auctiondate=$auctiondate;
        $this->listcars_id= $listcars_id;
        $this->users_id= $users_id;
    }

    public function save($pdo){

        


        $query3 = $pdo->prepare("INSERT INTO `auctions` (`auctionprice`, `auctiondate`,`listcars_id`,`users_id` ) VALUES (:auctionprice, :auctiondate, :listcars_id, :users_id)");
        $query3->bindValue(":auctionprice", $this->auctionprice,PDO::PARAM_INT);
        $query3->bindValue(":auctiondate", $this->auctiondate,PDO::PARAM_STR);
        $query3->bindValue(":listcars_id", $this->listcars_id,PDO::PARAM_INT);
        $query3->bindValue(":users_id", $this->users_id,PDO::PARAM_INT);
        return $query3->execute();
        

    }

}

?>